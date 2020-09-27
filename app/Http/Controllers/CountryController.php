<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Http\Resources\Country as CountryResource;


class CountryController extends Controller
{
    public function show($id)
    {
        return view('country', ['country' => Country::findOrFail($id)]);
    }

    public function index()
    {
        $country = Country::all();

        return response()->json([
            'country' => $country,
        ], 200);

       // return $country->toArray();
    }

    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required|max:255',
        ]);

        $country = Country::create($request->all());

        return response()->json([
            'country' => $country,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'country'        => 'required|max:255'
        ]);

        $country = Country::find($id);

        $country->country = $request -> country;

        $country->save();

        return response()->json([
            'message' => 'Ország sikeresen módosítva!'
        ], 200);
    }

    public function delete($id)
    {
        $Country = Country::findOrFail($id);
        $Country->delete();

        return response()->json([
            'message' => 'Ország sikeresen törölve!'
        ], 200);
    }
}
