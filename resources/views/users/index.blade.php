<?php if (session('message')){
    echo session('message');
}
    ?>
<table>
    <tr>
        <th>User</th>
        <th>Roles</th>
        <th>Permissions</th>
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
                        echo "<br>";
                    }
                }
            ?>
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
<a href="users/check">Check permission</a>
