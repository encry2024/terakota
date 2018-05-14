<?php

namespace App\Listeners\Backend\Dining;

/**
 * Class DiningEventListener.
 */
class DiningEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info($event->doer.' Created Dining "'.$event->dining.'"');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info($event->doer.' Updated Dining "'.$event->dining.'"');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info($event->doer.' Deleted Dining "'.$event->dining.'"');
    }

    /**
     * @param $event
     */
    public function onDeletedPermanently($event)
    {
        \Log::info($event->doer.' Permanently Deleted Dining "'.$event->dining.'"');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info($event->doer.' Restored Dining "'.$event->dining.'"');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Dining\DiningCreated::class,
            'App\Listeners\Backend\Dining\DiningEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Dining\DiningUpdated::class,
            'App\Listeners\Backend\Dining\DiningEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Dining\DiningDeleted::class,
            'App\Listeners\Backend\Dining\DiningEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Dining\DiningDeletedPermanently::class,
            'App\Listeners\Backend\Dining\DiningEventListener@onDeletedPermanently'
        );

        $events->listen(
            \App\Events\Backend\Dining\DiningRestored::class,
            'App\Listeners\Backend\Dining\DiningEventListener@onRestored'
        );

        $events->listen(
            \App\Events\Backend\Dining\DiningAssigned::class,
            'App\Listeners\Backend\Dining\DiningEventListener@onAssigned'
        );
    }
}
