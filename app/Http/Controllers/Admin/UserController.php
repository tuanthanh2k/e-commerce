<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user;
    protected $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->user->latest('id')->paginate(5);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->role->all()->groupBy('group');
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $dataCreate = $request->all();
        $dataCreate['password'] = Hash::make($request->password);
        $dataCreate['image'] = $this->user->saveImage($request);

        $users = $this->user->create($dataCreate);
        $users->roles()->attach($dataCreate['roles_ids']);
        $users->images()->create(['url' => $dataCreate['image']]);
        return to_route('users.index')->with(['message' => 'Create Sussess']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = $this->user->findOrFail($id)->load('roles');
        $roles = $this->role->all()->groupBy('group');

        return view('admin.users.edit', compact('users', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $dataUpdate = $request->except('password');
        $users = $this->user->findOrFail($id)->load('roles');

        if ($request->password) {
            $dataCreate['password'] = Hash::make($request->password);
        }
        $currentImage = $users->images->count() > 0 ? $users->images->first()->url : '';
        $dataUpdate['image'] = $this->user->updateImage($request, $currentImage);
        $users->update($dataUpdate);
        $users->images()->delete();
        $users->images()->create(['url' => $dataUpdate['image']]);
        $users->roles()->sync($dataUpdate['roles_id'] ?? []);
        return to_route('users.index')->with(['message' => 'Update Success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = $this->user->findOrFail($id)->load('roles');
        $users->images()->delete();
        $imageName = $users->images->count() > 0 ? $users->images->first()->url : '';
        $this->user->deleteImage($imageName);
        $users->delete();
        return to_route('users.index')->with(['message' => 'Delete Success']);
    }
}
