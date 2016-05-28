<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Http\Requests;
use Forum\Models\Section;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\Forum\Section\EditSectionFormRequest;
use Forum\Http\Requests\Forum\Section\CreateSectionFormRequest;

class SectionController extends Controller
{
    /**
     * Get the view to show all sections.
     * @param  Section  $section  Section model injection.
     * @return \Illuminate\Http\Response
     */
    public function all(Section $section)
    {
        $sections = $section->paginate(10);

        return view('forum.section.all')->withSections($sections);
    }

    /**
     * Get the view to show all topics under a specific section.
     * @param  string   $slug     Section slug.
     * @param  integer  $id       Section identifier.
     * @param  Section  $section  Section model injection.
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Section $section)
    {
        $show = $section->where('slug', $slug)->firstOrFail();

        return view('forum.section.show', [
            'section' => $show,
            'topics' => $show->topics()->with('user')->paginate(10),
        ]);
    }

    /**
     * Get the view to create a new section.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.section.create');
    }

    /**
     * Get the view to edit an existing section.
     * @param  integer  $id       Section identifier.
     * @param  Section  $section  Section model identifier.
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id, Section $section)
    {
        $edit = $section->findOrFail($id);

        return view('forum.section.edit')->withSection($edit);
    }

    /**
     * Post section edit.
     * @param  integer  $id       Section identifier.
     * @param  Section  $section  Section model identifier.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($id, EditSectionFormRequest $request, Section $section)
    {
        $current = $section->findOrFail($id);

        $current->update([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
        ]);

        notify()->flash('Success', 'success', [
            'text' => 'Section has been updated.',
            'timer' => 2000,
        ]);

        return redirect()->route('home');
    }

    /**
     * Create new section.
     * @param  CreateSectionFormRequest  $request  Form request for validation
     * @param  Section                   $section  Section model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSectionFormRequest $request, Section $section)
    {
        $section->create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
        ]);

        notify()->flash('Success', 'success', [
            'text' => 'Section has been created.',
            'timer' => 2000,
        ]);

        return redirect()->route('home');
    }

    /**
     * Mark section as deleted.
     * @param  integer  $id       Section identifier.
     * @param  Section  $section  Section model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Section $section)
    {
        $destroy = $section->findOrFail($id);

        $destroy->delete();

        notify()->flash('Success', 'success', [
            'text' => 'Section has been deleted.',
            'timer' => 2000,
        ]);

        return redirect()->route('home');
    }
}
