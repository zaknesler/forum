<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Models\Topic;
use Forum\Http\Requests;
use Forum\Models\Section;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Events\Forum\Section\SectionWasCreated;
use Forum\Events\Forum\Section\SectionWasDeleted;
use Forum\Http\Requests\Forum\Section\EditSectionFormRequest;
use Forum\Http\Requests\Forum\Section\CreateSectionFormRequest;

class SectionController extends Controller
{
    /**
     * Get the view to show all sections.
     *
     * @param  Forum\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function all(Section $section)
    {
        $sections = $section->paginate(10);

        return view('forum.section.all')
            ->with('sections', $sections);
    }

    /**
     * Get the view to show all topics under a specific section.
     *
     * @param  string                   $slug
     * @param  integer                  $id
     * @param  Illuminate\Http\Request  $request
     * @param  Forum\Models\Section     $section
     * @param  Forum\Models\Topic       $topic
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id, Request $request, Section $section, Topic $topic)
    {
        $section = $section->findOrFail($id);

        if ($request->search) {
            $topics = $section->topics()
                    ->whereIn('id', collect($topic->search($request->search)['hits'])
                    ->lists('id')
                    ->all())
                    ->with('user')
                    ->latestLast()
                    ->isVisible()
                    ->paginate(25);
        } else {
            $topics = $section->topics()
                    ->with('user')
                    ->latestLast()
                    ->isVisible()
                    ->paginate(25);
        }

        return view('forum.section.show')
            ->with('section', $section)
            ->with('topics', $topics);
    }

    /**
     * Get the view to create a new section.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.section.create');
    }

    /**
     * Create new section.
     *
     * @param  CreateSectionFormRequest  $request
     * @param  Forum\Models\Section      $section
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSectionFormRequest $request, Section $section)
    {
        $section->create([
            'name' => $request->input('name'),
            'slug' => str_slug($request->input('name')),
            'description' => $request->input('description'),
        ]);

        notify()->flash('Success', 'success', [
            'text' => 'Section has been created.',
            'timer' => 2000,
        ]);

        event(new SectionWasCreated($section, $request->user()));

        return redirect()->route('home');
    }

    /**
     * Mark section as deleted.
     *
     * @param  integer                  $id
     * @param  Illuminate\Http\Request  $request
     * @param  Forum\Models\Section     $section
     * @param  Forum\Models\Topic       $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Request $request, Section $section, Topic $topic)
    {
        $section = $section->findOrFail($id);

        $section->delete();

        notify()->flash('Success', 'success', [
            'text' => 'Section has been deleted.',
            'timer' => 2000,
        ]);

        event(new SectionWasDeleted($section, $topic, $request->user()));

        return redirect()->route('home');
    }
}
