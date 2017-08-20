@extends('layout.index')
@section('content')

@if(session('thongbao'))
    {{session('thongbao')}}
    @endif
<form action="{{route('roles.store')}}" method="post">
    {{csrf_field()}}
    Add Roles
    <input type="text" name="name"><br>
    Add permissions for new role
    <br>
    @foreach($permissions as $permission)
        <input type="checkbox" name="permission[]" value="{{$permission->id}}">{{$permission->name}}<br>
        @endforeach
    <button type="submit" >Create Roles</button>
</form>
    @endsection