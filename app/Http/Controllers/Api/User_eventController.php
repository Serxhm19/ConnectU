<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_event;

class User_eventController extends Controller
{
    public function index()
    {
        $userEvent = user_event::all()->toArray();

        return $userEvent;
    }

    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'sometimes',
            'event_id' => 'sometimes',
        ]);

        $userEvent = $request->all();
        $usuarioevento = user_event::create($userEvent);

        return response()->json(['success' => true, 'data' => $usuarioevento]);

    }

    public function update($id, Request $request)
    {
        $userEvent = user_event::find($id);

        $request->validate([
            'user_id' => 'sometimes',
            'event_id' => 'sometimes',
            ]);

        $dataToUpdate = $request->all();
        $userEvent->update($dataToUpdate);

        return response()->json(['success' => true, 'data' => $userEvent]);
    }

    public function destroy($user_id, $event_id)
    {
        $userEvent = user_event::where('user_id', $user_id)->where('event_id', $event_id)->first();

        if ($userEvent) {
            $userEvent->delete();
            
            return response()->json(['success' => true, 'data' => 'Eliminado correctamente']);
        } else {
            return response()->json(['success' => false, 'data' => 'No se encontró el registro']);
        }
    }
    
    public function show($id)
    {

        $userEvent = user_event::find($id);
        return response()->json($userEvent);

    }

    public function countByEventId($event_id)
    {
        $count = user_event::where('event_id', $event_id)->count();
        return response()->json(['success' => true, 'data' => $count]);
    }

    public function userInEvent($user_id, $event_id)
    {
        $userEvent = user_event::where('user_id', $user_id)->where('event_id', $event_id)->first();

        if ($userEvent) {
            return response()->json(['success' => true, 'data' => true]);
        } else {
            return response()->json(['success' => true, 'data' => false]);
        }
    }

}
