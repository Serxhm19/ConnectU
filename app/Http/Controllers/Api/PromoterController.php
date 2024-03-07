<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promoter;

class PromoterController extends Controller
{
    public function index(){
        //return "hola";
        
        $promoters = Promoter::all()->toArray();
        
        return $promoters;
    }

    public function store(Request $request){
        $request->validate([
            'NIF' => 'sometimes',
            'name' => 'sometimes',
            'email' => 'sometimes',
            'description' => 'sometimes',
            'category_id' => 'sometimes',
            'password' => 'sometimes'
        ]);

        $promoter = $request->all();
        $promotor = Promoter::create($promoter);
        
        return response()->json(['success' => true, 'data' => $promotor]);
    }

    public function update($id, Request $request){
        $promoter = Promoter::find($id);
        
        $request->validate([
            'category_id' => '',
            'name' => '',
            'email' => '',
            'description' => '',
            'password' => '',
            'start_date' => '',
            'end_date' => ''
        ]);
        
        $dataToUpdate = $request->all();
        $promoter->update($dataToUpdate);
        
        return response()->json(['success' => true, 'data' => $promoter]);
    }

    public function destroy($id){
        $promoter = Promoter::find($id);
        
        $promoter->delete();
        
        return response()->json(['success' => true, 'data' => 'eliminada correctamente']);
    }
        
    public function show($id){
            
        $promoter = Promoter::find($id);
        return response()->json($promoter);
        
    }
}
