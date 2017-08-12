<form action="{{route('users.update',$user->id)}}" method="post">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <input type="text" name="name" value="{{$user->name}}">
    <button type="submit">Change user name</button>
</form>