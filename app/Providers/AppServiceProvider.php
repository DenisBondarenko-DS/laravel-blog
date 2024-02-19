<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFour();

        view()->composer('layouts.sidebar', function ($view) {
            if (Cache::has('categories')) {
                $categories = Cache::get('categories');
            } else {
                $categories = Category::query()->withCount('posts')->orderBy('posts_count', 'desc')->get();
                Cache::put('categories', $categories, 60);
            }

            $view->with('popular_posts', Post::query()->orderBy('views', 'desc')->limit(3)->get());

            $view->with('categories', $categories);
        });

        view()->composer('layouts.footer', function ($view) {
            if (Cache::has('categories')) {
                $categories = Cache::get('categories');
            } else {
                $categories = Category::query()->withCount('posts')->orderBy('posts_count', 'desc')->limit(5)->get();
                Cache::put('categories', $categories, 60);
            }

            $view->with('recent_posts', Post::query()->latest()->limit(3)->get());

            $view->with('popular_posts', Post::query()->orderBy('views', 'desc')->limit(3)->get());

            $view->with('categories', $categories);
        });
    }
}
