<?php

class RestaurantController extends Controller
{
    public function index()
    {
        return Restaurant::all();
    }

    public function show(Restaurant $restaurant)
    {
        return $restaurant;
    }

    public function store(Request $request)
    {
        $restaurant = Restaurant::create($request->all());

        return response()->json($restaurant, 201);
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $restaurant->update($request->all());

        return response()->json($restaurant, 200);
    }

    public function delete(Restaurant $restaurant)
    {
        $restaurant->delete();

        return response()->json(null, 204);
    }
}