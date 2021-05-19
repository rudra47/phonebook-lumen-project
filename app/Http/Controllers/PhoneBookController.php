<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhoneBookDetails;
class PhoneBookController extends Controller
{
    public function create(Request $request)
    {
        $fullname   = $request->fullname;
        $number_one = $request->number_one;
        $number_two = $request->number_two;
        $email      = $request->email;

        $checkAvailability = PhoneBookDetails::where(function ($query) use ($number_one, $number_two) {
            $query->where('number_one', '=', $number_one)
                  ->orWhere('number_two', '=', $number_two);
        })->first();

        if (empty($checkAvailability)) {
            $result = PhoneBookDetails::insert([
                'fullname'   => $fullname,
                'number_one' => $number_one,
                'number_two' => $number_two,
                'email'      => $email
            ]);

            if ($result) {
                return response('Insert Successfully', 200);
            }else{
                return response('Insertion Failed', 404);
            }
        }else{
            return response()->json([
                'message' => "Data already exist",
                'existingData' => $checkAvailability
            ]);
        }
    }
}
