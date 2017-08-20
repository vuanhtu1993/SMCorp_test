@extends('layout.index')
@section('content')
<a href="{{route('users.index')}}">Home</a>
<br>
Check permission of User
<br>
<?php
        if(session('message')){
            echo session('message');
        }
$selected_user_id = session('selected_user');
$selected_permission_id = session('selected_permission');
?>

<form action="get_check" method="post">
    {{csrf_field()}}
    <select name="users" id="" class="checkbox">
        @foreach($users as $user)
            <option value="{{$user->id}}"
            <?php
                if ($selected_user_id == $user->id) {
                    echo ' selected ';
                }
                ?>
            >{{$user->name}}</option>
        @endforeach
    </select>
    <select name="permissions" id="" class="checkbox">
        @foreach($permissions as $permission)
            <option value="{{$permission->id}}"
            <?php if ($selected_permission_id == $permission->id) {
                echo ' selected ';
            } ?>
            >{{$permission->name}}</option>
        @endforeach
    </select>
    <button type="submit">Check</button>
</form>
@endsection