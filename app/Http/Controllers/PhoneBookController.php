<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhoneBookDetails;
use Firebase\JWT\JWT;

class PhoneBookController extends Controller
{
    public function create(Request $request)
    {
        $fullname   = $request->fullname;
        $number_one = $request->number_one;
        $number_two = $request->number_two;
        $email      = $request->email;

        $accessToken = $request->input('access_token');
        $tokenKey = env('TOKEN_KEY');
        $decodeJwt = JWT::decode($accessToken, $tokenKey, array('HS256'));

        $decodeArray=(array) $decodeJwt;

        $checkAvailability = PhoneBookDetails::where(function ($query) use ($number_one, $number_two) {
            $query->where('number_one', '=', $number_one)
                  ->orWhere('number_two', '=', $number_two);
        })->first();

        if (empty($checkAvailability)) {
            $result = PhoneBookDetails::insert([
                'fullname'   => $fullname,
                'number_one' => $number_one,
                'number_two' => $number_two,
                'email'      => $email,
                'created_by' => $decodeArray['user_id']
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

    public function onSelect(Request $request)
    {
        $accessToken = $request->input('access_token');
        $tokenKey = env('TOKEN_KEY');
        $decodeJwt = JWT::decode($accessToken, $tokenKey, array('HS256'));

        $decodeArray=(array) $decodeJwt;

        $result = PhoneBookDetails::where('created_by', $decodeArray['user_id'])->get();

        return $result;
    }
    
    public function onDelete(Request $request)
    {
        $accessToken = $request->input('access_token');
        $tokenKey = env('TOKEN_KEY');
        $decodeJwt = JWT::decode($accessToken, $tokenKey, array('HS256'));

        $decodeArray=(array) $decodeJwt;
        
        $result = PhoneBookDetails::where('id', $request->phone_book_details_id)
            ->where("created_by", $decodeArray['user_id'])
            ->delete(); 

        if ($result) {
            return response("Delete Successfully", 202);
        }else{
            return response("Delete Failed. Please try again", 404);
        }
    }
}
