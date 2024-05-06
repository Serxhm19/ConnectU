<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\city;

class CityController extends Controller
{
    public function index()
    {
        $city = City::all()->toArray();

        return $city;
    }

    public function store(Request $request)
    {
        $request->validate([
            'province_id' => 'required',
            'name' => 'required',
        ]);
        $city = $request->all();
        $ciudad = City::create($city);

        return response()->json(['success' => true, 'data' => $ciudad]);
    }

    public function update($id, Request $request)
    {
        $city = City::find($id);

        $request->validate([
            'province_id' => 'required',
            'name' => 'required',
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

    public function getCitiesByProvince($province_id = '')
    {
        if ($province_id != null && $province_id != '') {
            $cities = City::where('province_id', $province_id)->get();
        }else {
            $cities = City::all()->toArray();
        }

        return response()->json($cities);
    }
}
