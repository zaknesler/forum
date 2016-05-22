<?php

namespace Forum\Http\Controllers\Moderation;

use Forum\Models\Topic;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

class TopicController extends Controller
{
    /**
     * Mark topic as deleted (using soft deletes).
     * @param  integer  $id    Topic identifier.
     * @param  Topic   $topic  Topic model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Topic $topic)
    {
        $destroy = $topic->findOrFail($id);

        /**
         * When the database is migrated, the tables
         * are inter-connected with an option to
         * 'cascade' when deleted. This means that if
         * we delete the parent row value, Eloquent will
         * go through and delete all of its children automatically.
         */
        $destroy->delete();

        return redirect()->back();
    }
}
