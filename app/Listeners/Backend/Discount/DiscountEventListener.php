<?php

namespace App\Listeners\Backend\Discount;

/**
 * Class DiscountEventListener.
 */
class DiscountEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info($event->doer.' Created Discount "'.$event->discount.'"');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info($event->doer.' Updated Discount "'.$event->discount.'"');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info($event->doer.' Deleted Discount "'.$event->discount.'"');
    }

    /**
     * @param $event
     */
    public function onDeletedPermanently($event)
    {
        \Log::info($event->doer.' Permanently Deleted Discount "'.$event->discount.'"');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info($event->doer.' Restored Discount "'.$event->discount.'"');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Discount\DiscountCreated::class,
            'App\Listeners\Backend\Discount\DiscountEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Discount\DiscountUpdated::class,
            'App\Listeners\Backend\Discount\DiscountEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Discount\DiscountDeleted::class,
            'App\Listeners\Backend\Discount\DiscountEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Discount\DiscountDeletedPermanently::class,
            'App\Listeners\Backend\Discount\DiscountEventListener@onDeletedPermanently'
        );

        $events->listen(
            \App\Events\Backend\Discount\DiscountRestored::class,
            'App\Listeners\Backend\Discount\DiscountEventListener@onRestored'
        );

        $events->listen(
            \App\Events\Backend\Discount\DiscountAssigned::class,
            'App\Listeners\Backend\Discount\DiscountEventListener@onAssigned'
        );
    }
}
