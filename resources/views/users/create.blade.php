@if(session('thongbao'))
    {{session('thongbao')}}
@endif
<form action="{{route('users.store')}}" method="post">
    {{csrf_field()}}
    Add users
    <input type="text" name="name"><br>
    @foreach($roles as $role)
        <input type="checkbox" name="roles[{{$role->id}}]" value="{{$role->id}}">{{$role->name}}<br>
        {{--muốn truyền nhiều id lên controller thì name="roles[id]" value="..."
        mọt user sẽ chọn đc nhiều roles--}}
        @endforeach
    <button type="submit" >Create User</button>

</form>