<?php

namespace App\Http\Controllers;

use App\Registration;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use DB;

class RegistrationController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'menu_id' => 'required',
        ]);

        $registration = new Registration();
        $registration->product_id = $request->product_id;
        $registration->menu_id = $request->menu_id;
      
        if ($this->user->registrations()->save($registration))
            return response()->json([
                'success' => true,
                'registration' => $registration
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product could not be added to menu'
            ], 500);
    }

    public function destroy($id)
    {
        $registration = $this->user->registrations()->find($id);
    
        if (!$registration) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product with id ' . $id . ' cannot be found'
            ], 400);
        }
    
        if ($registration->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'product could not be deleted'
            ], 500);
        }
    }
}