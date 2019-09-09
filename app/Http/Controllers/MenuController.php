<?php

namespace App\Http\Controllers;

use App\Menu;
use App\User;
use App\Product;
use App\Restaurant;
use Illuminate\Http\Request;
use JWTAuth;
use DB;

class MenuController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        return $this->user
            ->menus()
            ->get(['name', 'description'])
            ->toArray();
    }

    public function show($id)
    {
        $menu = $this->user->menus()->find($id)->join(
            'registrations', 'registrations.product_id'
        );
    
        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, menu with id ' . $id . ' cannot be found'
            ], 400);
        }
    
        return $menu;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'restaurant_id' => 'required'
        ]);

        $menu = new Menu();
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->restaurant_id = $request->restaurant_id;

        if ($this->user->menus()->save($menu))
            return response()->json([
                'success' => true,
                'menu' => $menu
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, menu could not be added'
            ], 500);
    }

    public function update(Request $request, $id)
    {
        $menu = $this->user->menus()->find($id);
    
        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, menu with id ' . $id . ' cannot be found'
            ], 400);
        }
    
        $updated = $menu->fill($request->all())
            ->save();
    
        if ($updated) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, menu could not be updated'
            ], 500);
        }
    }

    public function destroy($id)
    {
        $menu = $this->user->menus()->find($id);
    
        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, menu with id ' . $id . ' cannot be found'
            ], 400);
        }
    
        if ($menu->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'menu could not be deleted'
            ], 500);
        }
    }
}