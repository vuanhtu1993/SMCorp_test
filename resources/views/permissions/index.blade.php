<?php if (session('message')){
    echo session('message');
}
 ?>
<table>
    <tr>
        <th>Permission</th>
        <th>Permission_chil</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php /** @var \App\Permission $permissions */
    foreach($permissions as $permission){ ?>
    <tr>
        <td>{{$permission->name}}</td>
        <td><?php foreach ($permission->children as $child){
            echo $child->name;
            echo "<br>";
            } ?></td>
        <td><a href="{{route('permissions.edit',$permission->id)}}">Edit</a></td>
        <td>
            <form action="{{route('permissions.destroy',$permission->id)}}" method="post">
                {{method_field('DELETE')}}
                {{csrf_field()}}
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    <?php } ?>
</table>
<a href="{{route('permissions.create')}}">New permission</a>