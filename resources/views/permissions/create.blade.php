@if(session('thongbao'))
    {{session('thongbao')}}
@endif
<form action="{{route('permissions.store')}}" method="post">
    {{csrf_field()}}
    Add Permission
    <input type="text" name="name">
    <button type="submit" >Create Permission</button>
</form>