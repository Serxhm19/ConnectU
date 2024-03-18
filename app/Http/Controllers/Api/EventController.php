<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\event;


class EventController extends Controller
{
    public function index()
    {
        $event = Event::all()->toArray();

        return $event;
    }

    public function promoterEvents($id)
    {
          // Encuentra todos los eventos relacionados con el promotor identificado por $id
            $events = Event::where('user_id', $id)->get();

            // Devuelve los eventos como un array JSON
            return response()->json($events);
    }

    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $event = $request->all();
        $evento = Event::create($event);

        return response()->json(['success' => true, 'data' => $evento]);

    }

    public function update($id, Request $request)
    {
        $event = Event::find($id);

        $request->validate([
            'category_id' => 'sometimes',
            'name' => 'sometimes',
            'description' => 'sometimes',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
        ]);

        $dataToUpdate = $request->all();
        $event->update($dataToUpdate);

        return response()->json(['success' => true, 'data' => $event]);
    }

    public function destroy($id)
    {
        $event = Event::find($id);

        $event->delete();

        return response()->json(['success' => true, 'data' => 'eliminado correctamente']);
    }
    public function show($id)
    {

        $event = Event::find($id);
        return response()->json($event);

    }

}
