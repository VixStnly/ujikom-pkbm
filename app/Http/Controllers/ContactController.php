<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    // Menampilkan form kontak
    public function showForm()
    {
        return view('contact');
    }

    // Mengirim email
    public function sendEmail(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Data email yang akan dikirim
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ];

        // Kirim email ke admin
        Mail::to('admin@pkbmtriwala.sch.id')->send(new ContactMail($data));

        // Kembali ke form dengan pesan sukses
        session()->flash('success', 'Pesan Anda telah berhasil dikirim!');

        // Redirect back to the contact page or wherever appropriate
        return redirect()->back();
    }
}
