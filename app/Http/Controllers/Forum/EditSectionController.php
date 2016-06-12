<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Http\Requests;
use Forum\Models\Section;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\Forum\Section\EditSectionFormRequest;
use Forum\Http\Requests\Forum\Section\CreateSectionFormRequest;

class EditSectionController extends Controller
{
    /**
     * Get the view to edit an existing section.
     * @param  integer  $id       Section identifier.
     * @param  Section  $section  Section model identifier.
     * @return \Illuminate\Http\Response
     */
    public function index($id, Section $section)
    {
        $edit = $section->findOrFail($id);

        return view('forum.section.edit', [
            'section' => $edit,    
        ]);
    }

    /**
     * Post section edit.
     * @param  integer  $id       Section identifier.
     * @param  Section  $section  Section model identifier.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, EditSectionFormRequest $request, Section $section)
    {
        $current = $section->findOrFail($id);

        $current->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
        ]);

        notify()->flash('Success', 'success', [
            'text' => 'Section has been updated.',
            'timer' => 2000,
        ]);

        return redirect()->route('home');
    }
}
