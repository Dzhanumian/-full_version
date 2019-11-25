@extends('layouts.app')
@section('content')


	@auth
	   <a href="/dashboard">Обратно в админку</a>
   	@endauth


	@guest
    	@if(@is_null($userEmail))
	        <a href="/students/create">Вначале зарегестрируйтесь</a>
	    @else
	        <p>{{ $userName }}, Привет</p>
	    @endif
	@endguest

@endsection

