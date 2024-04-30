<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class MessagesController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->latest()->get();

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'sometimes',
            'date' => 'sometimes|date'
        ]);

        $message = $request->all();
        $message['user_id'] = Auth::id();
        $mensaje = Message::create($message);

        event(new MessageSent($mensaje));

        return response()->json(['success' => true, 'data' => $mensaje]);
    }

    public function update($id, Request $request)
    {
        $message = Message::find($id);

        $request->validate([
            'message' => 'sometimes',
            'date' => 'sometimes|date'
        ]);

        $dataToUpdate = $request->all();
        $message->update($dataToUpdate);

        return response()->json(['success' => true, 'data' => $message]);
    }

    public function destroy($id)
    {
        $message = Message::find($id);

        $message->delete();

        return response()->json(['success' => true, 'data' => 'eliminada correctamente']);
    }

    public function show($id)
    {

        $message = Message::find($id);
        return response()->json($message);

    }

    public function sendMessage(Request $request, $group_id)
    {
        if (auth()->check()) {
            $request->validate([
                'message' => 'required|string',
            ]);

            $user = Auth::user();
            $message = $user->messages()->create([
                'message' => $request->input('message'),
                'group_id' => $group_id,
            ]);
            return ['status' => 'Message Sent!', 'message' => $message];
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

}