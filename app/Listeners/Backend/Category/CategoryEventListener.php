<?php

namespace App\Listeners\Backend\Category;

/**
 * Class CategoryEventListener.
 */
class CategoryEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info($event->doer.' Created Category "'.$event->category.'"');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info($event->doer.' Updated Category "'.$event->category.'"');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info($event->doer.' Deleted Category "'.$event->category.'"');
    }

    /**
     * @param $event
     */
    public function onDeletedPermanently($event)
    {
        \Log::info($event->doer.' Permanently Deleted Category "'.$event->category.'"');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info($event->doer.' Restored Category "'.$event->category.'"');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Category\CategoryCreated::class,
            'App\Listeners\Backend\Category\CategoryEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Category\CategoryUpdated::class,
            'App\Listeners\Backend\Category\CategoryEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Category\CategoryDeleted::class,
            'App\Listeners\Backend\Category\CategoryEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Category\CategoryDeletedPermanently::class,
            'App\Listeners\Backend\Category\CategoryEventListener@onDeletedPermanently'
        );

        $events->listen(
            \App\Events\Backend\Category\CategoryRestored::class,
            'App\Listeners\Backend\Category\CategoryEventListener@onRestored'
        );
    }
}
