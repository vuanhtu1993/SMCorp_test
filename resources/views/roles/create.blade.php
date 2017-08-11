@if(session('thongbao'))
    {{session('thongbao')}}
    @endif
<form action="{{route('roles.store')}}" method="post">
    {{csrf_field()}}
    Add Roles
    <input type="text" name="name">
    <button type="submit" >Create Roles</button>
</form>