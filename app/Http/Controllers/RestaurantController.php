<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use DB;

class RestaurantController extends Controller
{
    protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        return $this->user
            ->restaurants()
            ->get(['name', 'description', 'location', 'fone'])
            ->toArray();
    }

    public function show($id)
    {
        $restaurant = $this->user->restaurants()->find($id);
    
        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, restaurant with id ' . $id . ' cannot be found'
            ], 400);
        }
    
        return $restaurant;
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'fone' => 'required'
        ]);

       /**
        * $provider = DB::table('users')->where([
        *   ['id' == $this->user],
        *    ['provider' == 1]
        *])->get();

        *if (!$provider) {
        *   return response()->json([
        *        'success' => false,
        *       'message' => 'Only provider can create restaurants'
        *    ]);
        *}
        */ 

        $restaurant = new Restaurant();
        $restaurant->name = $request->name;
        $restaurant->description = $request->description;
        $restaurant->location = $request->location;
        $restaurant->fone = $request->fone;

        if ($this->user->restaurants()->save($restaurant))
            return response()->json([
                'success' => true,
                'restaurant' => $restaurant
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, restaurant could not be added'
            ], 500);
    }

    public function update(Request $request, $id)
    {
        $restaurant = $this->user->restaurants()->find($id);
    
        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, restaurant with id ' . $id . ' cannot be found'
            ], 400);
        }
    
        $updated = $restaurant->fill($request->all())
            ->save();
    
        if ($updated) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, restaurant could not be updated'
            ], 500);
        }
    }

    public function destroy($id)
    {
        $restaurant = $this->user->restaurants()->find($id);
    
        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, restaurant with id ' . $id . ' cannot be found'
            ], 400);
        }
    
        if ($restaurant->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'restaurant could not be deleted'
            ], 500);
        }
    }


}