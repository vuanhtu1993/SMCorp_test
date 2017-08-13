<form action="{{route('roles.update',$role->id)}}" method="post">
    {{method_field('PUT')}}
    {{csrf_field()}}
    <input type="text" name="role" value="{{$role->name}}">
    <br>
    <?php /** @var \App\Role $role */
    /** @var \App\Permission $permissions */
    //    echo $role->permissions;
    foreach ($permissions as $permission) { ?>
    {{--echo $role->permissions->contains($permission->id)--}}
    <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
    <?php
        if ($role->permissions->contains($permission->id) == '1') {
            echo "checked";
        }
        ?>
    >{{$permission->name}}
    <br>
    <?php } ?>
    <button TYPE="submit">Edit Roles</button>
</form>