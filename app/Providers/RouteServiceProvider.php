<?php

namespace App\Providers;

use App\Models\Auth\User;
use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Models\Shift\Shift;
use App\Models\Dining\Dining;
use App\Models\Discount\Discount;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class RouteServiceProvider.
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        /*
        * Register route model bindings
        */

        /*
         * Allow this to select all users regardless of status
         */
        $this->bind('user', function ($value) {
            $user = new User;

            return User::withTrashed()->where($user->getRouteKeyName(), $value)->first();
        });

        /*
         * Allow this to select all products regardless of status
         */
        $this->bind('product', function ($value) {
            $product = new Product;

            return Product::withTrashed()->where($product->getRouteKeyName(), $value)->first();
        });

        /*
         * Allow this to select all categories regardless of status
         */
        $this->bind('category', function ($value) {
            $category = new Category;

            return Category::withTrashed()->where($category->getRouteKeyName(), $value)->first();
        });

        /*
         * Allow this to select all shifts regardless of status
         */
        $this->bind('shift', function ($value) {
            $shift = new Shift;

            return Shift::withTrashed()->where($shift->getRouteKeyName(), $value)->first();
        });

        /*
         * Allow this to select all dinings regardless of status
         */
        $this->bind('dining', function ($value) {
            $dining = new Dining;

            return Dining::withTrashed()->where($dining->getRouteKeyName(), $value)->first();
        });

        /*
         * Allow this to select all discounts regardless of status
         */
        $this->bind('discount', function ($value) {
            $discount = new Discount;

            return Discount::withTrashed()->where($discount->getRouteKeyName(), $value)->first();
        });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
