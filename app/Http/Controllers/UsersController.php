<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var User $user */
        $users  = User::all();

        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->roles;
        $user->save();
        //var_export($request->roles);
        $roles = $request->roles; //vì request->role là một array -> phải foreach array để lấy giá trị bên trong
        foreach ($roles as $role){
            $user->roles()->attach($role); //gán mỗi user với nhiều roles
        }
        return back()->with('thongbao','Adding user successful');
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
        $user = User::find($id);
        $roles = Role::all();
        return view('users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        foreach ($request->roles as $role){
            echo $role;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('message','Delete successful');
    }

    public function check()
    {
        $permissions  = Permission::all();
        $users = User::all();
        return view('layout.check',compact('users','permissions'));
    }

    public function get_check(Request $request)
    {
        $user = User::find($request->users);
        //echo $user;
        foreach ($user->roles as $role){
            foreach ($role->permissions as $permission){
                $check =  $permission->id;
                if ($check == $request->permissions){
                    return back()->with([
                        'message'=>'User have this permission', //syntax gán giá trị trong mảng
                        'selected_user'=>$request->users,
                        'selected_permission'=>$request->permissions,
                    ]);
                }
            }
        }
        return redirect()->back()->with([
            'message'=>'User dont have this permission',
            'selected_user'=>$request->users,
            'selected_permission'=>$request->permissions,
        ]);
    }
}
