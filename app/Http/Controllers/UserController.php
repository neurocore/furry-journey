<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = request()->input('page', 1);
        $data = User::whereHas('roles', function($q) { $q->where('name', 'author'); })
             ->withCount(['books'])
             ->paginate(5);
    
        return view('users.index', compact('data'))
             ->with('i', ($page - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.edit')
             ->with('user', false)
             ->with('action', route('users.store'))
             ->with('title', 'Добавить нового автора');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $request->offsetSet('password', Hash::make($request->input('password')));
        $user = User::Create($request->all());

        $role = Role::firstWhere('name', 'author');
        $user->roles()->attach($role);
     
        return redirect()->route('users.index')
                         ->with('message', 'Автор успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'))
             ->with('action', route('users.update', $user->id))
             ->with('title', 'Редактировать автора');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();
    
        $user->update($request->all());
    
        return redirect()->route('users.index')
                         ->with('message', 'Автор успешно обновлён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    
        return redirect()->route('users.index')
                         ->with('message', 'Автор успешно удалён');
    }
}
