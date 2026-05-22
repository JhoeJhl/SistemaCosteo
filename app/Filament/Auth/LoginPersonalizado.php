<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Login;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;

class LoginPersonalizado extends Login
{
    protected string $view = 'filament.auth.login-personalizado';

    protected function getEmailFormComponent(): TextInput
    {
        return TextInput::make('email')
            ->label('Correo electrónico o Usuario')
            ->placeholder('Ingresa tu correo electrónico o Usuario')
            //->email()
            ->required()
            ->autocomplete();

    }

    protected function getPasswordFormComponent(): TextInput
    {
        return TextInput::make('password')
            ->label('Contraseña')
            ->placeholder('Ingresa tu contraseña')
            ->password()
            ->revealable()
            ->required();
    }

    protected function getRememberFormComponent(): Checkbox
    {
        return Checkbox::make('remember')
            ->label('Recordar sesión');
    }
}