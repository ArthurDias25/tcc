@extends('layouts.app')

@section('title','Configurações de Usuario - ')  

@section('content')
<br>
<br>
<br>
<br>
<br>
<br>

<div class="container">
    <form action="{{route('editPerfil',Auth::user()->id)}}" method="POST" name="userEdit" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" name="name" value="{{Auth::user()->name}}">
        </div>
        <div class="form-group">
            <input type="text" name="descricao" value="{{Auth::user()->descricao}}">
        </div>
        <div class="form-group">
            <input type="file" name="img_perfil">
        </div>
        <div class="form-group">
            <input type="file" name="img_capa">
        </div>
        <div class="form-group">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>

@endsection