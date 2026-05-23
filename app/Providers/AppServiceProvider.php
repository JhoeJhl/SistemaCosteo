<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\HtmlString;
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
        // Inyección de estilos específicos para robustecer la interfaz superior
    FilamentView::registerRenderHook(
        PanelsRenderHook::HEAD_END,
        fn (): HtmlString => new HtmlString('
            <style>
                /* espaciado del nabvar */
                .fi-topbar {
                    height: 5rem !important;
                    border-bottom: 1px solid rgba(229, 231, 235, 0.5);
                    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
                }
                
                /* centrado del contenido */
                .fi-topbar > div {
                    height: 100% !important;
                }

                /* Agranda el avatar o icono del menú de usuario de forma limpia */
                .fi-user-menu button img,
                .fi-user-menu button svg,
                .fi-avatar {
                    width: 2.8rem !important;
                    height: 2.8rem !important;
                    border-radius: 50% !important;
                    transition: transform 0.2s ease;
                }

                .fi-user-menu button:hover img {
                    transform: scale(1.05);
                }

                /* Espaciado extra para los ítems de navegación del Navbar */
                .fi-topbar-nav-items {
                    gap: 1.5rem !important;
                }
            </style>
        '),
    );
    }
}
