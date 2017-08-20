@extends('layout.index')
@section('content')

<form action="{{route('users.update',$user->id)}}" method="post">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <input type="text" name="name" value="{{$user->name}}">
    <br>

    @foreach($roles as $role)

        <input type="checkbox" name="roles[]" value="{{$role->id}}"
        <?php /** @var \App\User $user */
            /** @var \App\Role $role */
            if($user->roles->contains($role->id) == '1'){
                    echo ' checked ';
                } ?>
                >{{$role->name}}<br>

    @endforeach
    <button type="submit">Change User</button>
</form>
    @endsection