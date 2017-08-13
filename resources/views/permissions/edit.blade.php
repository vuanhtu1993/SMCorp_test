<form action="{{route('permissions.update',$permission->id)}}" method="post">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <input type="text" name="name" value="{{$permission->name}}">
    <br>
    <?php /** @var array $permissions */
    /** @var \App\Permission $each_permission_to_check_is_child */
    foreach ($permissions as $each_permission_to_check_is_child){
    /** @var \App\Permission $permission */
    if ($each_permission_to_check_is_child->id == $permission->id) {
        echo '<div style="display:none">';
    }else{
        echo '<div>';
    }
    ?>
    {{--/** @var \App\Permission $permission */--}}
    {{--echo $permission->children->contains($each_permission_to_check_is_child->id);--}}
    <input type="checkbox" name="permissions_child[]" value="{{$each_permission_to_check_is_child->id}}"
    <?php if ($permission->children->contains($each_permission_to_check_is_child->id) == '1') {
        echo "checked";
    } ?>
    >{{$each_permission_to_check_is_child->name}}
    <br>
    <?php
    echo '</div>';
    } ?>
    <button type="submit">Edit permission</button>
</form>