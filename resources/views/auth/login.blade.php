<x-guest-layout>
    <style>
        .contenedor-login {
            display: flex;
            flex-direction: row;
            min-height: 80vh; /* Más alto que antes */
            width: 100%;
            max-width: 900px; /* Ancho mayor */
            margin: 4rem auto;
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
            border-radius: 0.5rem;
            overflow: hidden;
            background-color: white;
        }

        .login-imagen {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
        }

        .login-imagen img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login-formulario {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        @media (max-width: 768px) {
            .contenedor-login {
                flex-direction: column;
                max-width: 100%;
                min-height: auto;
                height: auto;
            }
            .login-imagen,
            .login-formulario {
                width: 100%;
                height: auto;
            }
            .login-imagen img {
                height: 200px;
                object-fit: cover;
            }
        }
    </style>

    <div class="contenedor-login">
        <!-- Imagen -->
        <div class="login-imagen">
            <img src="{{ asset('imagenes/gatoo1.jpg') }}" alt="PATITAS A LA OBRA">
        </div>

        <!-- Formulario -->
        <div class="login-formulario">
            <div class="w-full max-w-md">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h4 class="text-2xl font-bold mb-6 text-center">PATITAS A LA OBRA</h4>


                    <!-- Correo -->
                    <div>
                        <x-input-label for="email" :value="'Correo electrónico'" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Contraseña -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="'Contraseña'" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Recordarme -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                        </label>
                    </div>

                    <!-- Acciones -->
                    <div class="flex items-center justify-between mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif

                        <x-primary-button class="ml-3">
                            Iniciar sesión
                        </x-primary-button>
                    </div>

                    <!-- Registro -->
                    <div class="mt-4 text-center">
                        <p class="text-sm text-gray-600">
                            ¿No tienes una cuenta?
                            <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Regístrate aquí</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
