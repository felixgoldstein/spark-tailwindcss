# Laravel Spark 9.0+ Frontend preset for Tailwind CSS

A Laravel Spark front-end scaffolding preset for [Tailwind CSS](https://tailwindcss.com) - a Utility-First CSS Framework for Rapid UI Development.

## 1. Usage with Laravel 6.0

1. Fresh install Laravel >= 6.0 and Spark >= 9.0 and `cd` to your app.
2. Install this preset via `composer require centrality-labs/spark-tailwindcss:1.0.0 --dev`. Laravel will automatically discover this package. No need to register the service provider
3. Use `php artisan preset spark-tailwindcss` for the basic Tailwind CSS preset
4. `npm install && npm run dev`
5. `php artisan serve` (or equivalent) to run server and test preset.

## 1. Usage with Laravel 7.0

1. Fresh install Laravel >= 7.0 and Spark >= 9.0 and `cd` to your app.
2. Install this preset via `composer require centrality-labs/spark-tailwindcss --dev`. Laravel will automatically discover this package. No need to register the service provider
3. Use `php artisan ui spark-tailwindcss` for the basic Tailwind CSS preset
4. `npm install && npm run dev`
5. `php artisan serve` (or equivalent) to run server and test preset.

### Config

The default `tailwind.config.js` configuration file included by this package simply uses the config from the Tailwind vendor files. Should you wish to make changes, you should remove the file and run `node_modules/.bin/tailwind init`, which will generate a fresh configuration file for you, which you are free to change to suit your needs.

Add a new i18n string in the `resources/lang/XX/pagination.php` file for each language that your app uses:
```php
'previous' => '&laquo; Previous',
'next' => 'Next &raquo;',
'goto_page' => 'Goto page #:page', // Add this line
```
This should help with accessibility
```html
<li>
    <a href="URL?page=2" class="..." 
       aria-label="Goto page #2"
    >
        2
    </a>
</li>
```
