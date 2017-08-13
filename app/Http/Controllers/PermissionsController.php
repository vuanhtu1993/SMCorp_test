<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('permissions.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->permission_id = '0';
        $permission->save();

        if ($request->permission) {
            foreach ($request->permission as $children_id) {
                $child = Permission::find($children_id);
                $child->permission_id = $permission->id;
                $child->save();
            }
        }
        return back()->with('thongbao', 'Adding Permission successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $permissions = Permission::all();
        return view('permissions.edit',compact('permissions','permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $permission->name = $request->name;
        $permission->save();
        foreach ($request->permissions_child as $children_id){
            $child = Permission::find($children_id);
            $child->permission_id = $permission->id;
            $child->save();
        }
        return redirect('permissions')->with('message','Editing permission successful');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect('permissions')->with('message','Delete permission successful');
    }

}