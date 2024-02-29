<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Messages;

class MessagesController extends Controller
{
    public function index(){
        
        $messages = Message::all()->toArray();
        
        return $messages;
    }

    public function store(Request $request){
        $request->validate([
            'message' => 'sometimes',
            'date' => 'sometimes|date'
        ]);

        $message = $request->all();
        $mensaje = Message::create($message);
        
        return response()->json(['success' => true, 'data' => $mensaje]);
    }

    public function update($id, Request $request){
        $message = Message::find($id);
        
        $request->validate([
            'message' => 'sometimes',
            'date' => 'sometimes|date'
        ]);
        
        $dataToUpdate = $request->all();
        $message->update($dataToUpdate);
        
        return response()->json(['success' => true, 'data' => $message]);
    }

    public function destroy($id){
        $message = Message::find($id);
        
        $message->delete();
        
        return response()->json(['success' => true, 'data' => 'eliminada correctamente']);
    }
        
    public function show($id){
            
        $message = Message::find($id);
        return response()->json($message);
        
    }
}
