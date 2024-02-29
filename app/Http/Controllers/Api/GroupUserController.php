<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\group_user;

class GroupUserController extends Controller
{
    public function index()
    {
        $groupuser = group_user::all()->toArray();

        return $groupuser;
    }

    public function store(Request $request)
    {

        $request = validate([
            'name' => 'sometimes',
            'description' => 'sometimes',
        ]);

        $groupuser = $request->all();
        $grupousuario = group_user::create($groupuser);

        return response()->json(['success' => true, 'data' => $grupousuario]);

    }

    public function update($id, Request $request)
    {
        $groupuser = group_user::find($id);

        $request->validate([
            'name' => 'sometimes',
            'description' => 'sometimes',
            ]);

        $dataToUpdate = $request->all();
        $groupuser->update($dataToUpdate);

        return response()->json(['success' => true, 'data' => $groupuser]);
    }

    public function destroy($id)
    {
        $groupuser = group_user::find($id);

        $groupuser->delete();

        return response()->json(['success' => true, 'data' => 'eliminado correctamente']);
    }
    public function show($id)
    {

        $groupuser = group_user::find($id);
        return response()->json($groupuser);

    }
}
