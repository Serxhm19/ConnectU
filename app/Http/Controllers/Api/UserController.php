<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
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
        $users = User::
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

        return UserResource::collection($users);
    }

    public function allUsers()
    {
        $users = User::all()->toArray();

        return $users;
    }

    public function showUser($id)
    {

        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserResource
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'genre' => $request->genre,
            'password' => bcrypt($request->password),
            'nif' => $request->nif,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('profile_image')) {
            $user->addMedia($request->file('profile_image'))
                ->toMediaCollection('profile-image');
        }

        if ($request->hasFile('background_image')) {
            $user->addMedia($request->file('background_image'))
                ->toMediaCollection('background-image');
        }

        return response()->json($user, 201);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return UserResource
     */
    public function uploadProfileImage(Request $request)
    {
        // Handle the uploaded profile image
        $user = auth()->user();
        if ($request->hasFile('profilePic')) {
            $user->clearMediaCollection('profile-image');
            $user->addMedia($request->file('profilePic'))
                ->toMediaCollection('profile-image');
        }
        return response()->json(['message' => 'Profile image uploaded successfully']);
    }
    public function uploadBackgroundImage(Request $request)
    {
        // Manejar la imagen de fondo cargada
        $user = auth()->user();
        if ($request->hasFile('backgroundImage')) {
            // Borra la colección de medios existente (si la hay) y agrega la nueva imagen de fondo
            $user->clearMediaCollection('background-image');
            $user->addMedia($request->file('backgroundImage'))
                ->toMediaCollection('background-image');
        }
        return response()->json(['message' => 'Background image uploaded successfully']);
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'genre' => $request->genre,
            'nif' => $request->nif,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('profile_image')) {
            $user->clearMediaCollection('profile-image');
            $user->addMedia($request->file('profile_image'))
                ->toMediaCollection('profile-image');
        }

        if ($request->hasFile('background_image')) {
            $user->clearMediaCollection('background-image');
            $user->addMedia($request->file('background_image'))
                ->toMediaCollection('background-image');
        }

        return response()->json($user);
    }
    public function getProfileImageUrl()
    {
        $user = auth()->user();
        $profileImageUrl = $user->getFirstMediaUrl('profile-image');
        return response()->json(['profile_image_url' => $profileImageUrl]);
    }

    public function getBackgroundImageUrl()
    {
        $user = auth()->user();
        $backgroundImageUrl = $user->getFirstMediaUrl('background-image');
        return response()->json(['background_image_url' => $backgroundImageUrl]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function show(User $user)
    {
        $user->load('roles');
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('user-delete');
        $user->delete();

        return response()->noContent();
    }


}
