@extends('layouts.blank')

@section('title', 'Inicio')

@section('content')
<section class="flex-1 flex flex-col items-center justify-center gap-10">
    <a href="/" class="text-4xl text-primary font-oswald uppercase">
        Matryerse
    </a>
    <div class="w-full max-w-xl bg-base-200 border border-base-300 p-8 rounded space-y-5">
        <h2 class="font-semibold text-2xl">Crea tu cuenta</h2>

        <div class="space-y-4">
            <fieldset class="fieldset">
                <label class="fieldset-label">Correo electrónico:</label>
                <label class="input">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g
                            stroke-linejoin="round"
                            stroke-linecap="round"
                            stroke-width="2.5"
                            fill="none"
                            stroke="currentColor">
                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </g>
                    </svg>
                    <input type="email" placeholder="ejemplo@gmail.com" required />
                </label>
            </fieldset>
            <label class="input">
                <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g
                        stroke-linejoin="round"
                        stroke-linecap="round"
                        stroke-width="2.5"
                        fill="none"
                        stroke="currentColor">
                        <path
                            d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"></path>
                        <circle cx="16.5" cy="7.5" r=".5" fill="currentColor"></circle>
                    </g>
                </svg>
                <input type="password" required placeholder="Ingresa tu contraseña" />
            </label>
            <fieldset class="fieldset">
                <button class="btn btn-primary">Subir</button>
            </fieldset>
        </div>

        <div class="flex justify-center items-center mt-6">
            <a href="/register" class="inline-flex items-center font-bold text-primary hover text-xs text-center">
                <span>
                    <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </span>
                <span class="ml-2">¿Ya tienes una cuenta?</span>
            </a>
        </div>
    </div>
</section>
@endsection