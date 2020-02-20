<?php

namespace Nejcc\TailwindPrepare;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Laravel\Ui\Presets\Preset as LaravelUI;

class TailwindPrepare extends LaravelUI
{
    public function installTailwind()
    {
        $this->prepare();
    }

    public function installTailwindWithVue()
    {
        $this->prepare();
    }

    public function installTailwindWithVueAndAuth()
    {
        $this->prepare();
        $this->scaffoldAuth();
    }

    public function prepare()
    {
        static::ensureComponentDirectoryExists();
        static::updatePackages();

        $this->updateMix();
        $this->updateScripts();
        $this->updateStyles();
        $this->updateSass();

        $this->updateTailwindConfig();
        $this->updateComponent();
    }

    protected function scaffoldAuth()
    {
        //Auth
        $this->pushView('views/auth/login.blade.php', 'auth/login.blade.php');
        $this->pushView('views/auth/register.blade.php', 'auth/register.blade.php');
        $this->pushView('views/auth/verify.blade.php', 'auth/verify.blade.php');
        $this->pushView('views/auth/email.blade.php', 'auth/email.blade.php');
        $this->pushView('views/auth/reset.blade.php', 'auth/reset.blade.php');

        //Layouts
        $this->pushView('layouts/auth.blade.php', 'layouts/auth.blade.php');
        $this->pushView('layouts/app.blade.php', 'layouts/app.blade.php');

        //App
        $this->pushView('welcome.blade.php', 'welcome.blade.php');
        $this->pushView('home.blade.php', 'home.blade.php');
    }

    public function updateMix()
    {
        $this->push('webpack.mix.js', 'webpack.mix.js');
    }

    public function updateScripts()
    {
        $this->pushResource('js/app.js', 'js/app.js');
        $this->pushResource('js/bootstrap.js', 'js/bootstrap.js');
    }

    public function updateTailwindConfig()
    {
        $this->push('tailwind.config.js', 'tailwind.config.js');
    }

    protected function updateComponent()
    {
        (new Filesystem)->delete(resource_path('js/components/Example.js'));
        $this->pushResource('js/components/ExampleComponent.vue', 'js/components/ExampleComponent.vue');
    }

    protected function updateSass()
    {
        $this->pushResource('scss/app.scss', 'sass/app.scss');
    }

    public function updateStyles()
    {
        File::cleanDirectory(resource_path('sass'));
        File::put(resource_path('sass/app.scss'), '');
    }

    public static function updatePackageArray($packages)
    {
        return array_merge(
            [
                'laravel-mix'           => '^5.x',
                'laravel-mix-purgecss'  => '^4.x',
                'laravel-mix-tailwind'  => '^0.1.x',
                'tailwindcss'           => '^1.x',
                'resolve-url-loader'    => '2.3.1',
                'sass'                  => '^1.20.1',
                'sass-loader'           => '7.*',
                'vue'                   => '^2.5.17',
                'vue-template-compiler' => '^2.6.10',
            ],
            Arr::except($packages, [
                'popper.js',
                'lodash',
                'jquery',
                'bootstrap',
            ])
        );
    }


    private function pushResource($tempPath, $newPath)
    {
        return copy(__DIR__ . '/Temp/' . $tempPath, resource_path('/' . $newPath));
    }

    private function pushView($tempPath, $newPath)
    {
        return copy(__DIR__ . '/Temp/' . $tempPath, resource_path('/views/' . $newPath));
    }

    private function push($tempPath, $newPath)
    {
        return copy(__DIR__ . '/Temp/' . $tempPath, base_path('/' . $newPath));
    }

}
