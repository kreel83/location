<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnvoiLaDemandeDeContact;
use App\Mail\DemandeDeContact;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    
    public function index() {
        return view('admin.contact.index');
    }

    public function store(EnvoiLaDemandeDeContact $request)
    {
        // Sauvegarde du message dans la table 'contacts'
        Contact::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'message' => $request->message
        ]);
        // Envoi d'un email pour nous prévenir
        $user = Auth::user();
        $to = explode(',', config('app.custom.admin_emails'));
        //Mail::to($to)->send(new DemandeDeContact($user, $request->subject, $request->message));
        return back()
            ->with('status', 'success')
            ->with('msg', 'Votre message a été envoyé.');
    }

}
