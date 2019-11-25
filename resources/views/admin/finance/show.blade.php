@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box">
        <div style="padding: 10px 20px;">
          <a href="/dashboard/finance/create"><button class="btn-success" style="width: 80px; height: 35px">Назад</button></a>
        </div>
        <div style="padding: 80px 80px"><p><strong style="font-size: 20px">Выберете группу</strong></p>
        @if($arr_group[0] != 0)
          @php
            $q = 1;
          @endphp

          @for($i = 1; $i <= $arr_group[0]; $i++)

            @if($i == 1)
              <a href="{{url('/dashboard/invoice/'.$id.'/'.$arr_group[1])}}">
                <div style="width: 300px; color: #696969; padding: 10px 20px;">
                  <div style="width: 90%;height: 40px; background: {{ $arr_group[4] }}; float: left; border-radius: 20px 0px 0px 20px;padding: 10px 20px;">
                    <strong>{{ $arr_group[2] }}</strong>
                  </div>
                  <div style="width: 10%;height: 40px; background: {{ $arr_group[5] }}; float: right; border-radius: 0px 20px 20px 0px;"></div>
                </div>
              </a>
              <br>
              <br>  
            @endif

            @if($i != 1)
              @php
                $q = $q + 5;
              @endphp
              <a href="{{url('/dashboard/invoice/'.$id.'/'.$arr_group[$q])}}">
                <div style="width: 300px; color: #696969; padding: 10px 20px;">
                  <div style="width: 90%;height: 40px; background: {{ $arr_group[$q+3] }}; float: left; border-radius: 20px 0px 0px 20px;padding: 10px 20px;">
                    <strong>{{ $arr_group[$q+1] }}</strong>
                  </div>
                  <div style="width: 10%;height: 40px; background: {{ $arr_group[$q+4] }}; float: right; border-radius: 0px 20px 20px 0px;"></div>
                </div>
              </a>
              <br>
              <br> 
            @endif

          @endfor
        @endif
        </div>

        <div class="box-body">
          
        </div>
      </div>  
    </section>
    <style>
      .true
      {
        background: #FFD700;
      };

      .false
      {
        background: #ADFF2F;
      };
    </style>
  </div>
@endsection

