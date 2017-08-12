<form action="{{route('users.update',$user->id)}}" method="post">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <input type="text" name="name" value="{{$user->name}}">
    @foreach($user->roles as $role)
        <input type="checkbox" name="role" value="{{$role->id}}">{{$role->name}}<br>

    @endforeach
    <button type="submit">Change user name</button>
</form>