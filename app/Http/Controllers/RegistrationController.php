<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRegistration;

class RegistrationController extends Controller
{
    public function registrationAction(Request $request)
    {
        $firstname = $request->firstname;
        $lastname  = $request->lastname;
        $city      = $request->city;
        $username  = $request->username;
        $password  = $request->password;

        $checkAvailability = UserRegistration::where('username', $username)->count();

        if ($checkAvailability == 0) {
            $result = UserRegistration::insert([
                'firstname' => $firstname,
                'lastname'  => $lastname,
                'city'      => $city,
                'username'  => $username,
                'password'  => $password
            ]);

            if ($result) {
                return response('Insert Successfully', 200);
            }else{
                return response('Insertion Failed', 404);
            }
        }else{
            return response('User already exist try again', 200);
        }
    }
}
