<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function pendaftaran ()
    {
        return view ('page.daftar');
    }

    public function welcome (Request $request)
    {
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $address = $request->input('address');

        return view('page.dashboard', ['firstname' => $firstname, 'lastname' => $lastname, 'address' => $address]);
    }
}
