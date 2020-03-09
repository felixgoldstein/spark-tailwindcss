<?php

namespace CentralityLabs\SparkTailwindCssPreset;

use Illuminate\Support\Arr;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset;
use Laravel\Ui\Presets\Preset;

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
            'postcss-import' => '^12.0.1',
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
    }

    protected static function updateViews()
    {
        if ((new Filesystem)->isDirectory(resource_path('views/vendor/spark'))) {
          (new Filesystem)->deleteDirectory(resource_path('views/vendor/spark'));
        }

        (new Filesystem)->copyDirectory(__DIR__.'/spark-tailwindcss-stubs/resources/views/auth', resource_path('views/vendor/spark/auth'));
        (new Filesystem)->copyDirectory(__DIR__.'/spark-tailwindcss-stubs/resources/views/kiosk', resource_path('views/vendor/spark/kiosk'));
        (new Filesystem)->copyDirectory(__DIR__.'/spark-tailwindcss-stubs/resources/views/nav', resource_path('views/vendor/spark/nav'));
        (new Filesystem)->copyDirectory(__DIR__.'/spark-tailwindcss-stubs/resources/views/shared', resource_path('views/vendor/spark/shared'));
        (new Filesystem)->copyDirectory(__DIR__.'/spark-tailwindcss-stubs/resources/views/modals', resource_path('views/vendor/spark/modals'));
        (new Filesystem)->copyDirectory(__DIR__.'/spark-tailwindcss-stubs/resources/views/layouts', resource_path('views/vendor/spark/layouts'));

        copy(__DIR__.'/spark-tailwindcss-stubs/resources/views/kiosk.blade.php', resource_path('views/vendor/spark/kiosk.blade.php'));
        copy(__DIR__.'/spark-tailwindcss-stubs/resources/views/missing-team.blade.php', resource_path('views/vendor/spark/missing-team.blade.php'));
        copy(__DIR__.'/spark-tailwindcss-stubs/resources/views/settings.blade.php', resource_path('views/vendor/spark/settings.blade.php'));
        copy(__DIR__.'/spark-tailwindcss-stubs/resources/views/terms.blade.php', resource_path('views/vendor/spark/terms.blade.php'));
    }

    protected static function updatePagination()
    {
        (new Filesystem)->delete(resource_path('views/vendor/paginate'));
        (new Filesystem)->copyDirectory(__DIR__.'/spark-tailwindcss-stubs/resources/views/vendor/pagination', resource_path('views/vendor/pagination'));
    }
}
