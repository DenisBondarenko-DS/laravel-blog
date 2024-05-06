<?php

namespace App\Providers;

use App\Models\Category;
use App\Services\Post\CachedPostService;
use App\Services\Post\Interfaces\PostServiceInterface;
use App\Services\Post\PostService;
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
        $this->app->bind(PostServiceInterface::class, CachedPostService::class);

        $this->app->when(CachedPostService::class)
            ->needs(PostServiceInterface::class)
            ->give(PostService::class);

        $this->app->when(AppServiceProvider::class)
            ->needs(PostServiceInterface::class)
            ->give(CachedPostService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(PostServiceInterface $postService): void
    {
        Paginator::useBootstrapFour();

        view()->composer('layouts.sidebar', function ($view) use ($postService) {
            if (Cache::has('categories')) {
                $categories = Cache::get('categories');
            } else {
                $categories = Category::query()->withCount('posts')->orderBy('posts_count', 'desc')->get();
                Cache::put('categories', $categories, 60);
            }

            $view->with('popular_posts', $postService->getTopPosts());

            $view->with('categories', $categories);
        });

        view()->composer('layouts.footer', function ($view) use ($postService) {
            if (Cache::has('categories')) {
                $categories = Cache::get('categories');
            } else {
                $categories = Category::query()->withCount('posts')->orderBy('posts_count', 'desc')->limit(5)->get();
                Cache::put('categories', $categories, 60);
            }

            $view->with('recent_posts', $postService->getRecentPosts());

            $view->with('popular_posts', $postService->getTopPosts());

            $view->with('categories', $categories);
        });
    }
}
