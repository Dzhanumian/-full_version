@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @auth
                <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
                <script>
                    $(function(){
                        $('#close').bind('click', function(){
                            window.close();
                        });
                    });
                </script>

                <div>
                    <button id="close" class="btn btn-success" style="margin-bottom: 10px">Закрыть</button>
                    <a style="margin-bottom: 10px" href="/dashboard/students" class="btn btn-success">В админку</a>
                </div>
            @endauth
            <div class="card">
                <div class="card-header">{{ __('Tests') }}</div>
                <br>
                <h3 align="left" style="font-size: 19px; padding: 0px 20px">
                	If you have Intermediate level or less use only Part A. <br>
                    If you have Intermediate level or higher use Part A and Part B. 
                </h3>

                <div>

                	<a href="{{$url_1}}" style="color: #000">
	                	<p style="background: {{$test_1}}; padding: 30px 30px; font-size: 20px; margin: 0px 20px 10px 20px">
	                		<i><Strong>Part A</Strong></i>
                            @php
                                if(isset($Test1) != null){
                                    echo "<span>your appraisal</span> <strong>".$Test1->value."</strong> from 50";
                                }
                            @endphp
	                	</p>
                	</a>
                	<a href="{{$url_2}}" style="color: #000">
	                	<p style="background: {{$test_2}}; padding: 30px 30px; font-size: 20px; margin: 0px 20px 0px 20px">
	                		<i><Strong>Part B</Strong></i>
                            @php
                                if(isset($Test2) != null){
                                    echo "<span>your appraisal</span> <strong>".$Test2->value."</strong> from 50";
                                }
                            @endphp
	                	</p>
                	</a>

                </div>

                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection