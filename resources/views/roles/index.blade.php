<?php if(session('message'))
    echo session('message');
    ?>
<table>
    <tr>
        <th>Role name</th>
        <th>Permissions</th>
        <th>Permission_children</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php /** @var \App\Role $roles */
    foreach ($roles as $role) {?>
    <tr>
        <td>{{$role->name}}</td>
        <td><?php foreach ($role->permissions as $permission){
            echo $permission->name;
            echo "<br>";
            } ?></td>
        <td><?php foreach ($role->permissions as $permission){
                foreach ($permission->children as $permission_children){
                    echo $permission_children->name;
                    echo "<br>";
                }
            } ?></td>
        <td><a href="{{route('roles.edit',$role->id)}}">Edit</a></td>
        <td>
            <form action="{{route('roles.destroy',$role->id)}}" method="post">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    <?php } ?>
</table>
<a href="{{route('roles.create')}}">New roles</a>