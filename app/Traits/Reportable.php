<?php

namespace Forum\Traits;

use Auth;
use Forum\User;
use Forum\Report;

trait Reportable
{
    /**
     * A model with the reportable trait morphs to many reports.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    /**
     * Scope to determine if model was reported by a specific user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  Forum\User  $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReportedBy($query, User $user)
    {
        return $query->whereHas('reports', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }

    /**
     * Method to determine if model was reported by a spefific user.
     *
     * @param  Forum\User  $user
     * @return boolean
     */
    public function isReportedBy(User $user)
    {
        return $this->reports()
            ->where('user_id', $user->id)
            ->exists();
    }

    /**
     * Report using the authenticated user.
     *
     * @return null
     */
    public function report()
    {
        $this->reports()->save(
            new Report(['user_id' => Auth::id()])
        );
    }
}
