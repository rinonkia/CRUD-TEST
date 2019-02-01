<?php

namespace CRUDTEST\Http\Controllers;

use Illuminate\Http\Request;
use CRUDTEST\User;
use CRUDTEST\Http\Requests\StoreUser;


class UserController extends Controller
{
    /**
     * 
     */
    public function __construct()
    {
        //$this->middleware('auth')->except(['index', 'show']);
        $this->middleware('auth')->only('destroy');
        $this->middleware('verified')->except(['index', 'show', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \CRUDTEST\Http\Requests\StoreUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return redirect('users/'.$user->id)->with('my_status', __('Create new user.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        //そのユーザが投稿した記事のうち最新5件を取得
        $user->posts = $user->posts()->paginate(5);
        
        return view('users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('edit', $user);
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('edit', $user);

        // 編集する場合はname欄だけなので、バリデーションもnameだけ取り出す
        $request->validate([
            'name' => (new StoreUser())->rules()['name']
        ]);

        $user->update([
            'name' => $request->name,
        ]);
        return redirect('users/'.$user->id)->with('my_status', __('Updated a user.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('edit', $user);
        $user->delete();
        return redirect('users')->with('my_status', __('Deleted a user.'));
    }
}
