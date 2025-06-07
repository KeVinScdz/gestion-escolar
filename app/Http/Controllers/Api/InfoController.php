<?php

namespace App\Http\Controllers\Api;

use App\Mail\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InfoController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a new contact request.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate(
                [
                    'fullName' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'phone' => 'required|string|max:20',
                    'institution' => 'required|string|max:255',
                    'role' => 'required|string|max:100',
                    'message' => 'required|string|min:10|max:1000',
                ],
                [
                    'fullName.required' => 'El nombre es requerido',
                    'email.required' => 'El correo electrónico es requerido',
                    'email.email' => 'El correo electrónico debe ser válido',
                    'phone.required' => 'El teléfono es requerido',
                    'institution.required' => 'La institución es requerida',
                    'role.required' => 'El rol es requerido',
                    'message.required' => 'El mensaje es requerido',
                    'message.min' => 'El mensaje debe tener al menos 10 caracteres',
                    'message.max' => 'El mensaje debe tener menos de 1000 caracteres',
                ]
            );

            // Enviar email
            Mail::to(config('mail.contact_email', 'andres52885241@gmail.com'))
                ->send(new Info($validated));

            return response()->json([
                'success' => true,
                'message' => 'Información enviada correctamente',
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar la información: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
