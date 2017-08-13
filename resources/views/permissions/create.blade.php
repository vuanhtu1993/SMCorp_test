<a href="{{route('users.index')}}">Home</a>
@if(session('thongbao'))
    {{session('thongbao')}}
@endif
<form action="{{route('permissions.store')}}" method="post">
    {{csrf_field()}}
    Add Permission
    <input type="text" name="name">
    <br>
    Choose permission_children for new permission
    <br>
    @foreach($permissions as $permission)
        <input type="checkbox" name="permission[]" value="{{$permission->id}}">{{$permission->name}}
        <br>
    @endforeach

    <button type="submit">Create Permission</button>
</form>