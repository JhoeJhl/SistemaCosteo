<?php

namespace App\Filament\Pages\Auth;

use Filament\Actions\Action;
use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Schemas\Schema; // <-- OBLIGATORIO para que coincida con la clase base
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Validation\ValidationException;


class LoginPersonalizado extends BaseLogin
{
    protected static string $view = 'filament.pages.auth.split-login';
    public function getHeading(): string|Htmlable
    {
        return 'Acceder Al sistema';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Planta de Transformación de Asaí';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                // Eliminamos el Label superior para un look más limpio y simétrico
                TextInput::make('login')
                    ->hiddenLabel()
                    ->placeholder('Usuario o Correo')
                    ->prefixIcon('heroicon-m-user')
                    ->required()
                    ->autofocus()
                    ->extraInputAttributes(['tabindex' => 1]),

                TextInput::make('password')
                    ->hiddenLabel()
                    ->placeholder('Contraseña')
                    ->password()
                    ->revealable()
                    ->prefixIcon('heroicon-m-lock-closed')
                    ->required()
                    ->extraInputAttributes(['tabindex' => 2]),

                Checkbox::make('remember')
                    ->label('Mantener sesión activa')
                    ->extraInputAttributes(['tabindex' => 3]),
            ])
            ->statePath('data');
    }

    // 2. Botón minimalista de un solo peso visual
    protected function getAuthenticateFormAction(): Action
    {
        return Action::make('authenticate')
            ->label('Ingresar')
            ->submit('authenticate');
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        $tipoDeAcceso = filter_var($data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        return [
            $tipoDeAcceso => $data['login'],
            'password'  => $data['password'],
        ];
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.login' => __('Credenciales incorrectas.'), // Mensaje corto y discreto
        ]);
    }
}
