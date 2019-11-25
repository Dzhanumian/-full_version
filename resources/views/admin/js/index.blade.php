@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
               <example-component></example-component>
               <br><br><br><br>

               <div id="test">
                 <div>
                    <test-component></test-component>
                 </div>  
               </div>
            </div>
        </div>
    </div>
</div>
@endsection