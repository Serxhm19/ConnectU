<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category_event;

class Category_eventController extends Controller
{
    public function index(){
        
        $cetegories = Category_event::all()->toArray();
        
        return $cetegories;
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'sometimes',
            'description' => 'sometimes'
        ]);

        $category_event = $request->all();
        $categoria = Category_event::create($category_event);
        
        return response()->json(['success' => true, 'data' => $categoria]);
    }

    public function update($id, Request $request){
        $category_event = Category_event::find($id);
        
        $request->validate([
            'name' => 'sometimes',
            'description' => 'sometimes'
        ]);
        
        $dataToUpdate = $request->all();
        $category_event->update($dataToUpdate);
        
        return response()->json(['success' => true, 'data' => $category_event]);
    }

    public function destroy($id){
        $category_event = Category_event::find($id);
        
        $category_event->delete();
        
        return response()->json(['success' => true, 'data' => 'eliminada correctamente']);
    }
        
    public function show($id){
            
        $category_event = Category_event::find($id);
        return response()->json($category_event);
        
    }
}
