@extends('layout.index')
@section('content')
<?php if (session('message')){
    echo session('message');
}
    ?>
<table class="table">
    <tr>
        <th>User</th>
        <th>Roles</th>
        <th>Permissions</th>
        <th>Permission_children</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php foreach ($users as $user){ ?>
    <tr>
        <td>{{$user->name}}</td>
        <td><?php foreach ($user->roles as $role){ ?>
           <?php echo $role->name;
            echo '<br>';
            ?>
        <?php }?>
        </td>
        <td>
            <?php
                foreach ($user->roles as $role){
                    foreach ($role->permissions as $permission){
                        echo $permission->name;
                        /** @var \App\Permission $permission */
//                        foreach($permission->children as $childPermission){
//                            echo $childPermission->name;
//                            echo '<br>';
//                        }
                        echo "<br>";
                    }
                }
            ?>
        </td>
        <td>
            <?php foreach ($user->roles as $role){
                foreach ($role->permissions as $permission){
                    foreach ($permission->children as $permission_children){
                        echo $permission_children->name;
                        echo "<br>";
                    }
                }
            } ?>
        </td>
        <td><a href="{{route('users.edit',$user->id)}}">Edit</a></td>
        <td>
            {{--Delete user--}}
            <form action="{{route('users.destroy',$user->id)}}" method="post">
                {{method_field('DELETE')}}
                {{csrf_field()}}
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    <?php }?>
</table>
<a  href="{{route('users.create')}}">New User</a> <br>
<a href="users/check">Check permission</a> <br>
<a href="{{route('roles.index')}}">Roles page</a> <br>
<a href="{{route('permissions.index')}}">Permissions page</a> <br>
@endsection