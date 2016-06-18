<?php

namespace Forum\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /**
         * Sections
         */
        'Forum\Events\Forum\Section\SectionWasCreated' => [
            'Forum\Listeners\Forum\Section\ReindexWithAlgolia',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],
        'Forum\Events\Forum\Section\SectionWasDeleted' => [
            'Forum\Listeners\Forum\Section\ReindexWithAlgolia',
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],
        'Forum\Events\Forum\Section\SectionWasEdited' => [
            'Forum\Listeners\Forum\Section\ReindexWithAlgolia',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],

        /**
         * Topics
         */
        'Forum\Events\Forum\Topic\TopicWasCreated' => [
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
            'Forum\Listeners\Forum\Section\ReindexWithAlgolia',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],
        'Forum\Events\Forum\Topic\TopicWasEdited' => [
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],
        'Forum\Events\Forum\Topic\TopicWasHidden' => [
            'Forum\Listeners\Forum\Section\ReindexWithAlgolia',
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],
        'Forum\Events\Forum\Topic\TopicWasUnhidden' => [
            'Forum\Listeners\Forum\Section\ReindexWithAlgolia',
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],
        'Forum\Events\Forum\Topic\TopicWasLocked' => [
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],
        'Forum\Events\Forum\Topic\TopicWasUnlocked' => [
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],
        'Forum\Events\Forum\Topic\TopicWasDeleted' => [
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],
        'Forum\Events\Forum\Topic\TopicWasReported' => [
            'Forum\Listeners\Forum\Topic\IncrementReportsCount',
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],
        'Forum\Events\Forum\Topic\TopicReportsWereCleared' => [
            'Forum\Listeners\Forum\Topic\ClearReportsCount',
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],

        /**
         * Posts
         */
        'Forum\Events\Forum\Post\PostWasCreated' => [
            'Forum\Listeners\Forum\Topic\UpdateLastPostAt',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],
        'Forum\Events\Forum\Post\PostWasDeleted' => [
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],
        'Forum\Events\Forum\Post\PostWasReported' => [
            'Forum\Listeners\Forum\Post\IncrementReportsCount',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],
        'Forum\Events\Forum\Post\PostReportsWereCleared' => [
            'Forum\Listeners\Forum\Post\ClearReportsCount',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],

        /**
         * User
         */
        'Illuminate\Auth\Events\Login' => [
            'Forum\Listeners\User\UpdateLastLoggedInAt',
        ],
        'Forum\Events\User\UserWasCreated' => [
            'Forum\Listeners\User\ReindexWithAlgolia',
        ],
        'Forum\Events\User\UserWasEdited' => [
            'Forum\Listeners\User\ReindexWithAlgolia',
            'Forum\Listeners\User\UpdateLastActiveAt',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
