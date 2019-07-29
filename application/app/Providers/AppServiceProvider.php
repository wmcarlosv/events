<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);

        $events->Listen(BuildingMenu::class, function(BuildingMenu $event){
            $event->menu->add('MAIN MENU');

            $event->menu->add(
                [
                    'text' => 'Escritorio',
                    'route' => 'home',
                    'icon' => 'dashboard'
                ],
                [
                    'text' => 'Perfil',
                    'route' => 'profile',
                    'icon' => 'user'
                ],
                [
                    'text' => 'Eventos',
                    'route' => 'events.index',
                    'icon' => 'calendar'
                ]
            );

            $role = Auth::user()->role;

            if($role == 'administrator'){
                $event->menu->add([
                    'text' => 'Usuarios',
                    'route' => 'users.index',
                    'icon' => 'users'
                ]);
            }

        });
    }
}
