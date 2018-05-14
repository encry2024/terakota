<?php

namespace App\Listeners\Backend\Product;

/**
 * Class ProductEventListener.
 */
class ProductEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info($event->doer.' Created Product "'.$event->product.'"');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info($event->doer.' Updated Product "'.$event->product.'"');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info($event->doer.' Deleted Product "'.$event->product.'"');
    }

    /**
     * @param $event
     */
    public function onDeletedPermanently($event)
    {
        \Log::info($event->doer.' Permanently Deleted Product "'.$event->product.'"');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info($event->doer.' Restored Product "'.$event->product.'"');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Product\ProductCreated::class,
            'App\Listeners\Backend\Product\ProductEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Product\ProductUpdated::class,
            'App\Listeners\Backend\Product\ProductEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Product\ProductDeleted::class,
            'App\Listeners\Backend\Product\ProductEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Product\ProductDeletedPermanently::class,
            'App\Listeners\Backend\Product\ProductEventListener@onDeletedPermanently'
        );

        $events->listen(
            \App\Events\Backend\Product\ProductRestored::class,
            'App\Listeners\Backend\Product\ProductEventListener@onRestored'
        );
    }
}
