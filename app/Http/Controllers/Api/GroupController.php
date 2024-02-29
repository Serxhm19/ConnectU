<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    public function index(){
        
        $groups = Group::all()->toArray();
        
        return $groups;
    }

    public function store(Request $request){
        $request->validate([
            'event_id' => 'sometimes',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
        ]);

        $group = $request->all();
        $grupo = Group::create($group);
        
        return response()->json(['success' => true, 'data' => $grupo]);
    }

    public function update($id, Request $request){
        $group = Group::find($id);
        
        $request->validate([
            'event_id' => 'sometimes',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
        ]);
        
        $dataToUpdate = $request->all();
        $group->update($dataToUpdate);
        
        return response()->json(['success' => true, 'data' => $group]);
    }

    public function destroy($id){
        $group = Group::find($id);
        
        $group->delete();
        
        return response()->json(['success' => true, 'data' => 'eliminada correctamente']);
    }
        
    public function show($id){
            
        $group = Group::find($id);
        return response()->json($group);
        
    }
}
