<?php

namespace Forum\Http\Controllers\Moderation;

use Forum\Http\Requests;
use Forum\Models\Section;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\Forum\CreateSectionFormRequest;

class SectionController extends Controller
{
    /**
     * Get the view to create a new section.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('moderation.section.create');
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
     * Mark section as deleted (using soft deletes).
     * @param  integer  $id       Section identifier.
     * @param  Section  $section  Section model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Section $section)
    {
        $destroy = $section->findOrFail($id);

        $destroy->delete();

        return redirect()->back();
    }
}
