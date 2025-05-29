<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'phone' => 'required|regex:/^\d{10,15}$/',
            'message' => 'required|max:200',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor HP wajib diisi.',
            'phone.regex' => 'Nomor HP harus berupa angka dan 10-15 digit.',
            'message.required' => 'Pesan wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        Contact::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Form berhasil dikirim!'
        ]);
    }
}