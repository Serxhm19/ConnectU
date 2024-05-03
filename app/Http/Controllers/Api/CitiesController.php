<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function index()
    {
        //return "hola";

        $city = City::all()->toArray();

        return $city;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:5',
        ]);
        $city = $request->all();
        $ciudad = City::create($city);

        return response()->json(['success' => true, 'data' => $ciudad]);
    }

    public function update($id, Request $request)
    {
        $city = City::find($id);

        $request->validate([
            'name' => 'required|max:5',
            'description' => 'required',
        ]);

        $dataToUpdate = $request->all();
        $city->update($dataToUpdate);

        return response()->json(['success' => true, 'data' => $city]);
    }

    public function destroy($id)
    {
        $city = City::find($id);

        $city->delete();

        return response()->json(['success' => true, 'data' => 'eliminada correctamente']);
    }

    public function show($id)
    {

        $city = City::find($id);
        return response()->json($city);

    }
}
