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
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->save();
        //var_export($request->roles);
        $roles = $request->roles; // foreach array để lấy giá trị bên trong
        if ($roles) {
            foreach ($roles as $role) {
                $user->roles()->attach($role); //gán mỗi user với nhiều roles
            }
        }
        return back()->with('thongbao', 'Adding user successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->save();
//        foreach ($request->roles as $role){
//            echo $role;
//        }
        $user->roles()->sync($request->roles); //delete all relationship alternative by new sync([array])
        return redirect('users')->with('message', 'Editing user successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('message', 'Delete successful');
    }

    public function check()
    {
        $permissions = Permission::all();
        $users = User::all();
        return view('layout.check', compact('users', 'permissions'));
    }

    public function get_check(Request $request)
    {
        $idToCheck = $request->permissions;
        $user = User::find($request->users);
        //echo $user;
        foreach ($user->roles as $role) {
            /** @var Permission $each_permission */
            foreach ($role->permissions as $each_permission) {
                $each_permission_id = $each_permission->id;
                if ($each_permission_id == $idToCheck) {
                    return back()->with([
                        'message' => 'User have this permission', //syntax gán giá trị trong mảng
                        'selected_user' => $request->users,
                        'selected_permission' => $request->permissions,
                    ]);
                }
                foreach($each_permission->children as $each_child_permission){
                    if($each_child_permission->id == $idToCheck){
                        return back()->with([
                            'message' => 'User have this permission', //syntax gán giá trị trong mảng
                            'selected_user' => $request->users,
                            'selected_permission' => $request->permissions,
                        ]);
                    }
                }
            }
        }
        return redirect()->back()->with([
            'message' => 'User dont have this permission',
            'selected_user' => $request->users,
            'selected_permission' => $request->permissions,
        ]);
    }
}
