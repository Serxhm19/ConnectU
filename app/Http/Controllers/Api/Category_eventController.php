<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryEventRequest;
use App\Http\Resources\CategoryEventResource;
use App\Models\Category_event;
use Illuminate\Http\Request;

class Category_eventController extends Controller
{

    public function index(){
        
            $categories = Category_event::all()->toArray();
            
            return $categories;
    }
    public function filtros(){
        
        $orderColumn = request('order_column', 'created_at');
        if (!in_array($orderColumn, ['id', 'name', 'description', 'created_at'])) {
            $orderColumn = 'created_at';
        }
        $orderDirection = request('order_direction', 'desc');
        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'desc';
        }
        $categories = Category_event::
            when(request('search_id'), function ($query) {
                $query->where('id', request('search_id'));
            })
            ->when(request('search_title'), function ($query) {
                $query->where('name', 'like', '%'.request('search_title').'%');
            })
            ->when(request('search_global'), function ($query) {
                $query->where(function($q) {
                    $q->where('id', request('search_global'))
                        ->orWhere('name', 'like', '%'.request('search_global').'%');

                });
            })
            ->orderBy($orderColumn, $orderDirection)
            ->paginate(50);
        return CategoryEventResource::collection($categories);
    }

    public function store(StoreCategoryEventRequest $request)
    {
        $this->authorize('category-create');
        $category = Category_event::create($request->validated());

        return new StoreCategoryEventRequest($category);
    }

    public function show(Category_event $category)
    {
        $this->authorize('category-edit');
        return new StoreCategoryEventRequest($category);
    }

    public function update(Category_event $category, StoreCategoryEventRequest $request)
    {
        $this->authorize('category-edit');
        $category->update($request->validated());

        return new StoreCategoryEventRequest($category);
    }

    public function destroy(Category_event $category) {
        $this->authorize('category-delete');
        $category->delete();

        return response()->noContent();
    }

    public function getList()
    {
        return StoreCategoryEventRequest::collection(Category_event::all());
    }
}
