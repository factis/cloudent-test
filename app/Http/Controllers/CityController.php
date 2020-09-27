<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\City;


class CityController extends Controller
{

    public function show($id)
    {
        $city = City::where('country_id', $id)->get();

        return response()->json([
            'City' => $city,
        ], 200);
    }

    public function store(Request $request)
    {

        $request->validate([
            'City' => 'required|max:255',
            'country_id' => 'required|max:255'
        ]);

        $city = City::create($request->all());

        return response()->json([
            'city' => $city,
        ], 201);
    }

    public function update(Request $request, $id)
    {
       $this->validate($request, [
            'City'        => 'required|max:255',
            'country_id' => 'required|max:255'
        ]);

        $City = City::find($id);

        $City->City = $request -> City;

        $City->save();

        return response()->json([
            'message' => 'Ország sikeresen módosítva!'
        ], 200);
    }

    public function delete($id)
    {
        $City = City::findOrFail($id);
        $City->delete();

        return response()->json([
            'message' => 'Ország sikeresen törölve!'
        ], 200);
    }
}
