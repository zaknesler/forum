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
        'Forum\Events\Forum\Section\SectionWasDeleted' => [
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
        ],

        /**
         * Topics
         */
        'Forum\Events\Forum\Topic\TopicWasCreated' => [
            'Forum\Listeners\Forum\Section\IncrementTopicsCount',
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
        ],
        'Forum\Events\Forum\Topic\TopicWasEdited' => [
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
        ],
        'Forum\Events\Forum\Topic\TopicWasDeleted' => [
            'Forum\Listeners\Forum\Section\DecrementTopicsCount',
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
        ],
        'Forum\Events\Forum\Topic\TopicWasReported' => [
            'Forum\Listeners\Forum\Topic\IncrementReportsCount',
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
        ],
        'Forum\Events\Forum\Topic\TopicReportsWereCleared' => [
            'Forum\Listeners\Forum\Topic\ClearReportsCount',
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
        ],

        /**
         * Posts
         */
        'Forum\Events\Forum\Post\PostWasCreated' => [
            'Forum\Listeners\Forum\Topic\IncrementRepliesCount',
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
        ],
        'Forum\Events\Forum\Post\PostWasDeleted' => [
            'Forum\Listeners\Forum\Topic\DecrementRepliesCount',
            'Forum\Listeners\Forum\Topic\ReindexWithAlgolia',
        ],
        'Forum\Events\Forum\Post\PostWasReported' => [
            'Forum\Listeners\Forum\Post\IncrementReportsCount',
        ],
        'Forum\Events\Forum\Post\PostReportsWereCleared' => [
            'Forum\Listeners\Forum\Post\ClearReportsCount',
        ],

        /**
         * User
         */
        'Illuminate\Auth\Events\Login' => [
            'Forum\Listeners\User\UpdateUserLastLoggedInAt',
        ],
        'Forum\Events\User\UserWasCreated' => [
            'Forum\Listeners\User\ReindexWithAlgolia',
        ],
        'Forum\Events\User\UserWasEdited' => [
            'Forum\Listeners\User\ReindexWithAlgolia',
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
