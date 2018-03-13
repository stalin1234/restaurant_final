<?php

namespace Modules\Categorias\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Categorias\Events\Handlers\RegisterCategoriasSidebar;

class CategoriasServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterCategoriasSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('news', array_dot(trans('categorias::news')));
            $event->load('categories', array_dot(trans('categorias::categories')));
            // append translations


        });
    }

    public function boot()
    {
        $this->publishConfig('categorias', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Categorias\Repositories\NewsRepository',
            function () {
                $repository = new \Modules\Categorias\Repositories\Eloquent\EloquentNewsRepository(new \Modules\Categorias\Entities\News());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Categorias\Repositories\Cache\CacheNewsDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Categorias\Repositories\CategoryRepository',
            function () {
                $repository = new \Modules\Categorias\Repositories\Eloquent\EloquentCategoryRepository(new \Modules\Categorias\Entities\Category());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Categorias\Repositories\Cache\CacheCategoryDecorator($repository);
            }
        );
// add bindings


    }
}
