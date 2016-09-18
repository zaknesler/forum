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
     * Report a model with an optional user argument.
     *
     * If no user was passed, use the currently authenticated user.
     *
     * @param  Forum\User|null  $user
     * @return null
     */
    public function report(User $user = null)
    {
        $user = $user ?? Auth::user();

        if ($this->isReportedBy($user)) {
            return;
        }

        $this->reports()->save(
            new Report([
                'user_id' => $user->id
            ])
        );
    }

    /**
     * Unreport a model with an optional user argument.
     *
     * If no user was passed, use the currently authenticated user.
     *
     * @param  Forum\User|null  $user
     * @return null
     */
    public function unreport(User $user = null)
    {
        $user = $user ?? Auth::user();

        if (!$this->isReportedBy($user)) {
            return;
        }

        $this->reports()->where('user_id', $user->id)->delete();
    }

    /**
     * Toggle the report on the model.
     *
     * If it is reported, unreport it.
     * If it is not reported, report it.
     *
     * @param  Forum\User|null  $user
     * @return null
     */
    public function toggleReport(User $user = null)
    {
        $user = $user ?? Auth::user();

        if (!$this->isReportedBy($user)) {
            $this->report($user);

            return;
        }

        $this->unreport($user);
    }

    /**
     * Get the current report status.
     *
     * If the model is reported, return 'reported.'
     * If it is not reported, return 'unreported.'
     *
     * @param  Forum\User|null  $user
     * @return string
     */
    public function reportStatus(User $user = null)
    {
        $user = $user ?? Auth::user();

        $status = $this->isReportedBy($user);

        return $status ? 'reported' : 'unreported';
    }
}
