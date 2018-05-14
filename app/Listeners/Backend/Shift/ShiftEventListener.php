<?php

namespace App\Listeners\Backend\Shift;

/**
 * Class ShiftEventListener.
 */
class ShiftEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info($event->doer.' Created Shift "'.$event->shift.'"');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info($event->doer.' Updated Shift "'.$event->shift.'"');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info($event->doer.' Deleted Shift "'.$event->shift.'"');
    }

    /**
     * @param $event
     */
    public function onDeletedPermanently($event)
    {
        \Log::info($event->doer.' Permanently Deleted Shift "'.$event->shift.'"');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info($event->doer.' Restored Shift "'.$event->shift.'"');
    }

    /**
     * @param $event
     */
    public function onAssigned($event)
    {
        \Log::info($event->doer.' Assigned User "'. $event->employee .'" Shift "'.$event->shift.'"');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Shift\ShiftCreated::class,
            'App\Listeners\Backend\Shift\ShiftEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Shift\ShiftUpdated::class,
            'App\Listeners\Backend\Shift\ShiftEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Shift\ShiftDeleted::class,
            'App\Listeners\Backend\Shift\ShiftEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Shift\ShiftDeletedPermanently::class,
            'App\Listeners\Backend\Shift\ShiftEventListener@onDeletedPermanently'
        );

        $events->listen(
            \App\Events\Backend\Shift\ShiftRestored::class,
            'App\Listeners\Backend\Shift\ShiftEventListener@onRestored'
        );

        $events->listen(
            \App\Events\Backend\Shift\ShiftAssigned::class,
            'App\Listeners\Backend\Shift\ShiftEventListener@onAssigned'
        );
    }
}
