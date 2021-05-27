@extends('layouts.app')

@section('content')

@include('layouts.banner')

<div class="container" style="margin-top:40px">
    <div class="row">
        <!--inicio card-->
        @foreach ($seguindo as $s)
            <div class="col-2 mt-2">
                <a href="{{route('perfil',$s->following->id)}}">
                    <div class="card" style="background-color: #585858">
                        <img src="{{ url("storage/{$s->following->img_perfil}") }}" class="card-img-top">
                        <div class="card-body" style="color: white">
                            {{$s->following->name}}
                        </div>
                    </div>
                </a>
            </div>            
        @endforeach
        <!--fim card-->

        <!--td aqui dentro-->
    </div>
</div>

<br>
<br>
{{-- 
@if (isset($filters))
    {!! $user->appends($filters)->links() !!}
@else
    {!! $user->links() !!}
@endif --}}


@endsection