<div class="minimal-login-page">

    <style>
        /* =========================================================
           1. RESET DE CONTENEDORES FILAMENT
        ========================================================= */
        .fi-simple-layout,
        .fi-simple-main {
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            background: transparent !important;
        }

        body {
            margin: 0;
            background-color: #050505;
            font-family: Arial, Helvetica, sans-serif;
            -webkit-font-smoothing: antialiased;
            color: #e5e5e5;
        }

        /*Layout*/
        .minimal-login-page,
        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 100vh;
            position: relative;
        }

        /* Fondo inmersivo (Imagen) - MEJORADA */
        .login-image-panel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            overflow: hidden;
        }

        .login-image-panel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.15;
            filter: grayscale(100%) blur(2px);
            transition: transform 8s ease-out, opacity 2s ease;
            animation: slowZoom 25s infinite alternate;
        }

        .login-image-panel::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 100%);
            pointer-events: none;
        }

        /* Panel Central (Formulario) */
        .login-form-panel {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 460px;
            background: rgba(10, 10, 10, 0.85);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            padding: 56px 48px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 4px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.8), inset 0 1px 0 rgba(255, 255, 255, 0.05);
            margin: 20px;
            animation: fadeIn 0.8s ease-out;
        }

        .login-form-content {
            width: 100%;
        }

        /* =========================================================
           3. TIPOGRAFÍA Y MARCA - TEXTOS MÁS GRANDES
        ========================================================= */
        .logo-section {
            margin-bottom: 42px;
            text-align: center;
        }

        .logo-badge {
            font-size: 13px;
            letter-spacing: 5px;
            text-transform: uppercase;
            color: #b0b0b0;
            font-weight: 600;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
            display: inline-block;
        }

        .login-heading {
            margin-bottom: 48px;
            text-align: center;
        }

        .login-heading h1 {
            font-size: 36px;
            font-weight: 400;
            color: #ffffff;
            margin: 0 0 12px 0;
            letter-spacing: -0.02em;
        }

        .login-heading p {
            font-size: 16px;
            color: #8a8a8a;
            margin: 0;
            line-height: 1.5;
        }

        /* Overlay inferior */
        .image-overlay {
            position: absolute;
            bottom: 28px;
            left: 0;
            width: 100%;
            text-align: center;
            z-index: 5;
        }

        .image-overlay p {
            font-size: 12px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin: 0;
            color: rgba(255, 255, 255, 0.35);
        }

        .image-overlay .credit {
            font-size: 11px;
            margin-top: 6px;
            color: rgba(255, 255, 255, 0.18);
        }

        /* =========================================================
           4. ESTILOS DE FILAMENT - TEXTOS MÁS GRANDES
        ========================================================= */
        .login-form .fi-field {
            margin-bottom: 28px !important;
        }

        .login-form .fi-input-wrp {
            border-radius: 0px !important;
            background: rgba(0, 0, 0, 0.5) !important;
            box-shadow: none !important;
        }

        .login-form .fi-input-wrp input,
        .login-form .fi-input-wrp .fi-input {
            border: 1px solid #2a2a2a !important;
            border-radius: 0px !important;
            padding: 16px 18px !important;
            font-size: 15px !important;
            color: #ffffff !important;
            width: 100% !important;
            background: transparent !important;
            transition: border-color 0.3s ease !important;
        }

        .login-form .fi-input-wrp input::placeholder {
            color: #5a5a5a !important;
            font-size: 14px !important;
        }

        .login-form .fi-input-wrp input:focus {
            border-color: #e0e0e0 !important;
            box-shadow: none !important;
            outline: none !important;
        }

        /* Labels más grandes */
        .login-form [class*="field-wrp-label"],
        .login-form [class*="FieldLabel"],
        .login-form [class*="label"] {
            display: block !important;
            color: #d4d4d4 !important;
            font-weight: 500 !important;
            font-size: 13px !important;
            letter-spacing: 0.5px !important;
            margin-bottom: 10px !important;
        }

        /* Detalles menores */
        .login-form .fi-error-message {
            color: #ef4444 !important;
            font-size: 12px !important;
            margin-top: 8px !important;
        }

        .login-form .fi-field-hint {
            color: #737373 !important;
            font-size: 12px !important;
            margin-top: 6px !important;
        }

        .login-form .fi-input-icon {
            color: #525252 !important;
        }

        .login-form .fi-input-wrp:focus-within .fi-input-icon {
            color: #d4d4d4 !important;
        }

        /* Separador */
        .form-divider {
            height: 1px;
            background: #262626;
            margin: 36px 0 28px 0;
        }

        /* Botón Principal - MÁS GRANDE */
        .minimal-login-btn {
            width: 100% !important;
            background: #ffffff !important;
            color: #000000 !important;
            border-radius: 0px !important;
            height: 54px !important;
            font-weight: 600 !important;
            font-size: 15px !important;
            letter-spacing: 1.5px !important;
            text-transform: uppercase !important;
            transition: all 0.3s ease !important;
            border: none !important;
            cursor: pointer !important;
            margin-top: 12px !important;
        }

        .minimal-login-btn:hover {
            background: #e0e0e0 !important;
            transform: translateY(-1px);
        }

        /* =========================================================
           5. CHECKBOX - CENTRADO CON TEXTO AL LADO
        ========================================================= */

        /* Contenedor del campo checkbox - centrado horizontal */
        .login-form .fi-field:has(input[type="checkbox"]) {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-direction: row !important;
            gap: 10px !important;
            margin: 20px 0 0 0 !important;
            width: 100% !important;
        }

        /* Fuerza a que el cuadro y el texto estén en la misma línea */
        .login-form .fi-field:has(input[type="checkbox"]),
        .login-form label.fi-checkbox-label,
        .login-form label[for*="remember"] {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            gap: 10px !important;
            margin-bottom: 0 !important;
            justify-content: center !important;
        }

        /* Checkbox visible - TAMAÑO MÁS GRANDE */
        .login-form input[type="checkbox"] {
            width: 20px !important;
            height: 20px !important;
            min-width: 20px !important;
            min-height: 20px !important;
            opacity: 1 !important;
            position: relative !important;
            display: inline-block !important;
            visibility: visible !important;
            margin: 0 !important;
            padding: 0 !important;
            cursor: pointer !important;
            background: white !important;
            border: 2px solid #2d6a4f !important;
            border-radius: 4px !important;
            appearance: checkbox !important;
            -webkit-appearance: checkbox !important;
            -moz-appearance: checkbox !important;
            accent-color: #2d6a4f !important;
            flex-shrink: 0 !important;
        }

        /* Hover del checkbox */
        .login-form input[type="checkbox"]:hover {
            transform: scale(1.05);
            border-color: #3d8b68 !important;
        }

        /* Label del checkbox - al lado derecho */
        .login-form .fi-field:has(input[type="checkbox"]) .fi-field-wrp-label,
        .login-form .fi-field:has(input[type="checkbox"]) label,
        .login-form label[for*="remember"] {
            display: inline-block !important;
            margin: 0 !important;
            padding: 0 !important;
            color: #b0b0b0 !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            cursor: pointer !important;
            line-height: 20px !important;
            margin-left: 18px !important;
        }

        /* Texto específico del label */
        .login-form label.fi-checkbox-label span,
        .login-form label[for*="remember"] span {
            display: inline-block !important;
            color: #b0b0b0 !important;
            font-weight: 500 !important;
            font-size: 14px !important;
            margin-bottom: 0 !important;
            line-height: 20px !important;
            margin-left: 10px !important;
        }

        /* Ocultar contenedores extra */
        .login-form .fi-field-checkbox,
        .login-form [class*="checkbox-wrapper"] {
            display: contents !important;
        }

        /* =========================================================
           6. ANIMACIONES Y RESPONSIVE
        ========================================================= */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slowZoom {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.08);
            }
        }

        @media (max-width: 480px) {
            .login-form-panel {
                padding: 36px 28px;
                max-width: 90%;
                background: rgba(10, 10, 10, 0.95);
            }

            .login-heading h1 {
                font-size: 28px;
            }

            .login-heading p {
                font-size: 14px;
            }

            .login-form .fi-input-wrp input {
                padding: 14px 16px !important;
            }

            .image-overlay {
                display: none;
            }

            .logo-badge {
                font-size: 11px;
                letter-spacing: 3px;
            }
        }

        @media (min-width: 481px) and (max-width: 768px) {
            .login-form-panel {
                max-width: 420px;
            }

            .login-heading h1 {
                font-size: 32px;
            }
        }
    </style>

    <div class="login-container">

        {{-- PANEL DERECHO CONVERTIDO EN FONDO ABSOLUTO --}}
        <div class="login-image-panel">
            <img src="{{ asset('images/login-plant.jpg') }}" alt="Planta Transformadora" loading="lazy">
        </div>

        {{-- TARJETA CENTRAL --}}
        <div class="login-form-panel">
            <div class="login-form-content">

                <div class="logo-section">
                    <span class="logo-badge">ASAÍ</span>
                </div>

                <div class="login-heading">
                    <h1>Acceder</h1>
                    <p>Ingresa tus credenciales para continuar</p>
                </div>
                
                <div class="login-form">
                    <form wire:submit="authenticate">

                        {{ $this->form }}
        
                            <x-filament::button type="submit" size="lg" class="minimal-login-btn">
                                Iniciar sesión
                            </x-filament::button>

                        <div class="form-divider"></div>


                    </form>
                </div>

            </div>
        </div>

        {{-- TEXTO DE CRÉDITOS --}}
        <div class="image-overlay">
            <p>Sistema de Costeo</p>
            <p class="credit">Planta de Transformación de Asaí</p>
        </div>

    </div>

</div>
