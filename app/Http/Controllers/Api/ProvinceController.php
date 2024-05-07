<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\province;

class ProvinceController extends Controller
{
    public function index()
    {
        $province = Province::all()->toArray();

        return $province;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $province = $request->all();
        $provincia = Province::create($province);

        return response()->json(['success' => true, 'data' => $provincia]);
    }

    public function update($id, Request $request)
    {
        $province = Province::find($id);

        $request->validate([
            'name' => 'required',
        ]);

        $dataToUpdate = $request->all();
        $province->update($dataToUpdate);

        return response()->json(['success' => true, 'data' => $province]);
    }

    public function destroy($id)
    {
        $province = Province::find($id);

        $province->delete();

        return response()->json(['success' => true, 'data' => 'eliminada correctamente']);
    }

    public function show($id)
    {

        $province = Province::find($id)->toArray();
        return  $province;

    }

    
}
