<?php

namespace Nejcc\TailwindPrepare\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Ui\UiCommand;
use Nejcc\TailwindPrepare\TailwindPrepare;

class TailwindPrepareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        UiCommand::macro('tailwind-vue', function (UiCommand $command) {
            $prepare = new TailwindPrepare();
            $prepare->installTailwindWithVue();
            $command->info('Laravel UI Tailwind CSS & Vue Frameworks deployed');
        });

        UiCommand::macro('tailwind-vue-auth', function (UiCommand $command) {
            $prepare = new TailwindPrepare();
            $prepare->installTailwindWithVueAndAuth();
            $command->info('Laravel UI Tailwind CSS & Vue Frameworks with Auth deployed');
        });

        UiCommand::macro('tailwind', function (UiCommand $command) {
            $prepare = new TailwindPrepare();
            $prepare->installTailwind();
            $command->info('Laravel UI Tailwind CSS deployed');
        });
    }
}
