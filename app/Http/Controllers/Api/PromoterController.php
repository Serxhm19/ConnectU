<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promoter;
use App\Http\Resources\PromoterResource;

class PromoterController extends Controller
{
    public function index()
    {
        $orderColumn = request('order_column', 'created_at');
        if (!in_array($orderColumn, ['id', 'name', 'created_at'])) {
            $orderColumn = 'created_at';
        }
        $orderDirection = request('order_direction', 'desc');
        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'desc';
        }
        $promoters = promoter::
            when(request('search_id'), function ($query) {
                $query->where('id', request('search_id'));
            })
            ->when(request('search_title'), function ($query) {
                $query->where('name', 'like', '%' . request('search_title') . '%');
            })
            ->when(request('search_global'), function ($query) {
                $query->where(function ($q) {
                    $q->where('id', request('search_global'))
                        ->orWhere('name', 'like', '%' . request('search_global') . '%');

                });
            })
            ->orderBy($orderColumn, $orderDirection)
            ->paginate(50);

        return PromoterResource::collection($promoters);
    }

    public function store(Request $request)
    {
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

    public function update($id, Request $request)
    {
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

    public function destroy($id)
    {
        $promoter = Promoter::find($id);

        $promoter->delete();

        return response()->json(['success' => true, 'data' => 'eliminada correctamente']);
    }

    public function show($id)
    {

        $promoter = Promoter::find($id);
        return response()->json($promoter);

    }
}
