@extends('layouts.blank')

@section('title', 'Solicitar información')

@section('content')
<section class="w-full px-5">
    <div class="w-full max-w-[1200px] mx-auto min-h-screen py-15">
        <div class="w-full flex flex-col lg:flex-row items-center gap-10 py-10">
            <div class="flex-1 space-y-6">
                <p class="text-primary text-lg font-bold uppercase tracking-wider">Contáctanos</p>
                <h2 class="text-4xl font-bold">Solicitar información</h2>
                <p class="text-base-content/70 text-lg leading-relaxed">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus atque sint numquam at illum rerum! Quod eum quasi et nemo omnis hic, magni quisquam laborum exercitationem asperiores earum illum debitis?
                </p>
            </div>
            <div class="flex-1 w-full bg-base-200 border border-base-300 rounded-lg p-8 shadow-sm hover:shadow-md transition-shadow duration-300">
                <form id="contactForm" class="upload-form space-y-6 w-full" data-method="POST" data-target="/api/info" data-show-alert="true">
                    <fieldset class="fieldset">
                        <label for="fullName" class="fieldset-label text-base after:content-['*'] after:text-red-500 after:ml-1">
                            Nombre Completo
                        </label>
                        <input type="text" id="fullName" name="fullName" class="input input-bordered w-full" placeholder="Nombre" required>
                    </fieldset>
                    <fieldset class="fieldset">
                        <label for="email" class="fieldset-label text-base after:content-['*'] after:text-red-500 after:ml-1">
                            Correo electrónico
                        </label>
                        <input type="email" id="email" name="email" class="input input-bordered w-full" placeholder="Email" required>
                    </fieldset>
                    <fieldset class="fieldset">
                        <label for="phone" class="fieldset-label text-base after:content-['*'] after:text-red-500 after:ml-1">
                            Teléfono
                        </label>
                        <input type="tel" id="phone" name="phone" class="input input-bordered w-full" placeholder="Teléfono" required>
                    </fieldset>
                    <fieldset class="fieldset">
                        <label for="institution" class="fieldset-label text-base after:content-['*'] after:text-red-500 after:ml-1">
                            Institución
                        </label>
                        <input type="text" id="institution" name="institution" class="input input-bordered w-full" placeholder="Institución" required>
                    </fieldset>
                    <fieldset class="fieldset">
                        <label for="role" class="fieldset-label text-base after:content-['*'] after:text-red-500 after:ml-1">
                            Rol
                        </label>
                        <input type="text" id="role" name="role" class="input input-bordered w-full" placeholder="Rol" required>
                    </fieldset>
                    <fieldset class="fieldset">
                        <label for="message" class="fieldset-label text-base after:content-['*'] after:text-red-500 after:ml-1">
                            Mensaje
                        </label>
                        <textarea id="message" name="message" class="textarea textarea-bordered w-full min-h-[120px]" placeholder="Mensaje" required></textarea>
                    </fieldset>
                    <button type="submit" class="btn btn-primary w-full hover:opacity-90 transition-opacity">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection