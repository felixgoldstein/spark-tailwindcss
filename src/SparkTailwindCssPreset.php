<?php

namespace CentralityLabs\SparkTailwindCssPreset;

use Illuminate\Support\Arr;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset;

class SparkTailwindCssPreset extends Preset
{
    public static function install()
    {
        static::updatePackages();
        static::updateStyles();
        static::updateBootstrapping();
        static::updateViews();
        static::updatePagination();
        static::removeNodeModules();
    }

    protected static function updatePackageArray(array $packages)
    {
        return array_merge([
            'laravel-mix' => '^4.0.14',
            'laravel-mix-purgecss' => '^4.1',
            'laravel-mix-tailwind' => '^0.1.0',
            'tailwindcss' => '^1.0',
        ], Arr::except($packages, [
            'bootstrap',
            'bootstrap-sass',
            'popper.js',
            'laravel-mix',
            'jquery',
        ]));
    }

    protected static function updateStyles()
    {
        tap(new Filesystem, function ($filesystem) {
            $filesystem->deleteDirectory(resource_path('sass'));
            $filesystem->delete(public_path('js/app.js'));
            $filesystem->delete(public_path('css/app.css'));

            if (! $filesystem->isDirectory($directory = resource_path('css'))) {
                $filesystem->makeDirectory($directory, 0755, true);
            }
        });

        copy(__DIR__.'/spark-tailwindcss-stubs/resources/css/app.css', resource_path('css/app.css'));
    }

    protected static function updateBootstrapping()
    {
        copy(__DIR__.'/spark-tailwindcss-stubs/tailwind.config.js', base_path('tailwind.config.js'));
        copy(__DIR__.'/spark-tailwindcss-stubs/webpack.mix.js', base_path('webpack.mix.js'));
        copy(__DIR__.'/spark-tailwindcss-stubs/resources/js/bootstrap.js', resource_path('js/bootstrap.js'));
    }

    protected static function updateViews()
    {
        if ((new Filesystem)->isDirectory(resource_path('views/auth')) {
          (new Filesystem)->deleteDirectory(resource_path('views/auth'));
          (new Filesystem)->copyDirectory(__DIR__.'/spark-tailwindcss-stubs/resources/views/auth', resource_path('views/auth'));
        }
        if ((new Filesystem)->isDirectory(resource_path('views/kiosk')) {
          (new Filesystem)->deleteDirectory(resource_path('views/kiosk'));
          (new Filesystem)->copyDirectory(__DIR__.'/spark-tailwindcss-stubs/resources/views/kiosk', resource_path('views/kiosk'));
        }

        if ((new Filesystem)->isDirectory(resource_path('views/nav')) {
          (new Filesystem)->deleteDirectory(resource_path('views/nav'));
          (new Filesystem)->copyDirectory(__DIR__.'/spark-tailwindcss-stubs/resources/views/nav', resource_path('views/nav'));
        }

        if ((new Filesystem)->isDirectory(resource_path('views/shared')) {
          (new Filesystem)->deleteDirectory(resource_path('views/shared'));
          (new Filesystem)->copyDirectory(__DIR__.'/spark-tailwindcss-stubs/resources/views/shared', resource_path('views/shared'));
        }

        if ((new Filesystem)->isDirectory(resource_path('views/modals')) {
          (new Filesystem)->deleteDirectory(resource_path('views/modals'));
          (new Filesystem)->copyDirectory(__DIR__.'/spark-tailwindcss-stubs/resources/views/modals', resource_path('views/modals'));
        }

        if ((new Filesystem)->isDirectory(resource_path('views/layouts')) {
          (new Filesystem)->deleteDirectory(resource_path('views/layputs'));
          (new Filesystem)->copyDirectory(__DIR__.'/spark-tailwindcss-stubs/resources/views/layouts', resource_path('views/layouts'));
        }

        copy(__DIR__.'/spark-tailwindcss-stubs/resources/views/kiosk.blade.php', resource_path('views/kiosk.blade.php'));
        copy(__DIR__.'/spark-tailwindcss-stubs/resources/views/missing-team.blade.php', resource_path('views/missing-team.blade.php'));
        copy(__DIR__.'/spark-tailwindcss-stubs/resources/views/settings.blade.php', resource_path('views/settings.blade.php'));
        copy(__DIR__.'/spark-tailwindcss-stubs/resources/views/teams.blade.php', resource_path('views/teams.blade.php'));
    }

    protected static function updatePagination()
    {
        (new Filesystem)->delete(resource_path('views/vendor/paginate'));
        (new Filesystem)->copyDirectory(__DIR__.'/spark-tailwindcss-stubs/resources/views/vendor/pagination', resource_path('views/vendor/pagination'));
    }
}
