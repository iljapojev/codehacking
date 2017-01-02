<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Photo;
use App\Http\Requests\UsersCreateRequest;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;

use App\Http\Controllers\Controller;

class AdminUsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name', 'id')->all();
        
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersCreateRequest $request)
    {   
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }
        else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }
        
        if($request->file('photo_id')){
            $file = $request->file('photo_id');
            $name = time() . "_" . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            
            $input['photo_id'] = $photo->id;
        }
        
        User::create($input);
        
        $username = $request->name;
        Session::flash('message','User ' . $username . ' has been created.');
        
        return redirect('/admin/users');
//         return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::lists('name', 'id')->all();
        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }
        else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        if($request->file('photo_id')){
            $file = $request->file('photo_id');
            $name = time() . "_" . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }
        $user->update($input);
        
        $username = User::findOrFail($id)->name;
        Session::flash('message','User ' . $username . ' has been updated.');
    
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $username = User::findOrFail($id)->name;
        
        $user = User::findOrFail($id);
        unlink(public_path() . $user->photo->file);
        $user->delete();

        Session::flash('message','User ' . $username . ' has been deleted.');
        
        return redirect('admin/users');
    }
}
