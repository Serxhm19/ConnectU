<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Resources\zz;
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

    public function store(StoreEventRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();

        $event = Event::create($validatedData);

        if ($request->hasFile('thumbnail')) {
            $event->addMediaFromRequest('thumbnail')->preservingOriginal()->toMediaCollection('images');
        }

        return new EventResource($event);
    }

    public function update($id, Request $request)
    {
        $event = Event::find($id);

        $request->validate([
            'category_id' => 'sometimes',
            'name' => 'sometimes',
            'description' => 'sometimes',
            'location' => 'sometimes',
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
