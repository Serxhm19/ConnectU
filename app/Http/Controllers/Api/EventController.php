<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEventRequest;
use App\Http\Resources\EventResource;
use App\Http\Resources\zz;

use App\Models\event;


class EventController extends Controller
{
    public function index()
    {
        $orderColumn = request('order_column', 'created_at');
        if (!in_array($orderColumn, ['id', 'category_id', 'name', 'description', 'location', 'start_date', 'end_date', 'user_id'])) {
            $orderColumn = 'created_at';
        }
        $orderDirection = request('order_direction', 'desc');
        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'desc';
        }

        $events = Event::query()
            ->when(request('search_category'), function ($query) {
                $query->where('category_id', request('search_category'));
            })
            ->when(request('search_id'), function ($query) {
                $query->where('id', request('search_id'));
            })
            ->when(request('search_name'), function ($query) {
                $query->where('name', 'like', '%' . request('search_name') . '%');
            })
            ->when(request('search_description'), function ($query) {
                $query->where('description', 'like', '%' . request('search_description') . '%');
            })
            ->when(request('search_location'), function ($query) {
                $query->where('location', 'like', '%' . request('search_location') . '%');
            })
            ->when(request('search_start_date'), function ($query) {
                $query->where('start_date', '>=', request('search_start_date'));
            })            
            ->when(request('search_end_date'), function ($query) {
                $query->where('end_date', '<=', request('search_end_date'));
            })
            ->when(request('search_user_id'), function ($query) {
                $query->where('user_id', request('search_user_id'));
            })
            ->when(request('search_global'), function ($query) {
                $searchGlobal = request('search_global');
                $query->where(function ($q) use ($searchGlobal) {
                    $q->Where('name', 'like', '%' . $searchGlobal . '%')
                        ->orWhere('description', 'like', '%' . $searchGlobal . '%')
                        ->orWhere('location', 'like', '%' . $searchGlobal . '%')
                        ->orWhere('start_date', 'like', '%' . $searchGlobal . '%')
                        ->orWhere('end_date', 'like', '%' . $searchGlobal . '%');
                });
            })
            
            ->orderBy($orderColumn, $orderDirection)
            ->paginate(10);

        return $events;
    }

    public function promoterEvents($id)
    {
        $events = Event::where('user_id', $id)->get();

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

    public function update($id, StoreEventRequest $request)
    {
        $event = Event::find($id);

        $event->update($request->validated());
    
        if($request->hasFile('thumbnail')) {
            $event->media()->delete();
            $event->addMediaFromRequest('thumbnail')->preservingOriginal()->toMediaCollection('images');
        }

        return new EventResource($event);



        /*
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
        */
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

    public function showByPromoter($promoter)
    {
        // Buscar eventos por el campo 'promoter'
        $events = Event::where('user_id', $promoter)->get();
        
        // Devolver la respuesta JSON con los eventos encontrados
        return response()->json($events);

    }
    

}
