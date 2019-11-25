@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <button id="close" class="btn btn-success">Закрыть</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="margin-left: 15px">

              <div class="form-group">
                <!-- <a href="" class="btn btn-success">Назад</a> -->
                <h2>{{ $student->surname.' '.$student->name.' '.$student->patronymic }}
                  <a target="_blank" href="{{route('students.edit', $student->id)}}" class="fa fa-pencil"></a>
                  @if(Auth::user()->role !=  'teacher')
                  <form style="display: inline-block;" onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('students.destroy', $student->id)}}" method="post">
                      <input type="hidden" name="_method" value="DELETE">
                      {{csrf_field()}}
                      <button type="submit" class="delete">
                        <i class="fa fa-remove"></i>
                      </button>
                    </form>
                    @endif
                </h2>
                <div>
                  <h4><strong>Дата рождения:</strong> {{ $student->date_of_birth }}</h4>
                  <h4><strong>Телефон:</strong> {{ $student->phone_number }}</h4>
                  @if($student->relations != 'Сам за себя ответственный')
                    <br>
                    <h4>Контактное лицо</h4>
                    <h4><strong>{{ $student->surname_r.' '.$student->name_r.' '.$student->patronymic_r }}</strong></h4>
                    <h4><strong>Телефон:</strong> {{ $student->phone_number_r }}</h4>
                    <h4><strong>Статус:</strong> {{ $student->relations }}</h4>
                    <br>
                  @endif
                </div>
                <h4><a target="_blank" href="{{route('account.edit', $student->id)}}">Баланс:</a>{{ $balans->account }}</h4>
                <h4>Долги:<br>
                  @foreach($Finance as $debt)
                    <a href="{{route('debt.pay', $debt->id) }}" target="_blank">{{ $debt->group_name.' - '.$debt->month }}</a><br>
                  @endforeach
                </h4>
                <h4><a href="{{url('/test/'.$student->id)}}" target="_blank">Тест</a></h4>
              </div>

              <!------>
              <div style="float: left;">
                <h3>Оплачиваемые группы</h3>
                @if($arr_group[0] != 0)
                  @php
                    $q = 1;
                    $id = $student->id;
                  @endphp

                  @for($i = 1; $i <= $arr_group[0]; $i++)

                    @if($i == 1)
                               
                      <a href="{{url('/dashboard/group_students/'.$arr_group[1].'/edit')}}" target="_blank">
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
                      <a href="{{url('/dashboard/group_students/'.$arr_group[$q].'/edit')}}" target="_blank">
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
                <!------->
                <h3>Все группы</h3>
                @if($arr_group1[0] != 0)
                  @php
                    $q = 1;
                    $id = $student->id;
                  @endphp

                  <table class="table table-bordered table-striped">
                    
                  <tr>
                    <th>Группа</th>
                    <th>Начало обучения</th>
                    <th>Статус</th>
                  </tr>

                  @for($i = 1; $i <= $arr_group1[0]; $i++)

                    @if($i == 1)
                      <tr>
                        <td><a href="{{url('/dashboard/group_students/'.$arr_group1[1].'/edit')}}" target="_blank">{{ $arr_group1[2].' (гр №:'.$arr_group1[1].')' }}</a></td>
                        <td>@php echo substr($arr_group1[4], 0,10) @endphp</td>
                        <td>
                           @php 
                            if($arr_group1[6] == 'учится'){
                              echo "Ещё учится";
                            }
                            if($arr_group1[6] == 'выпустился'){
                              echo "Выпустился ".substr($arr_group1[$q+5], 0,10);
                            }
                            if($arr_group1[6] == 'временно не учится'){
                              echo "Не учится c ".substr($arr_group1[$q+5], 0,10);
                            }
                            if($arr_group1[6] == 'забросил обучени'){
                              echo "Забросил с ".substr($arr_group1[$q+5], 0,10);
                            }  
                          @endphp
                        </td>
                      </tr>
  
                    @endif

                    @if($i != 1)
                      @php
                        $q = $q + 6;
                      @endphp
                      <tr>
                        <td><a href="{{url('/dashboard/group_students/'.$arr_group1[$q].'/edit')}}" target="_blank">{{ $arr_group1[$q+1].' (гр №:'.$arr_group1[$q].')' }}</a></td>
                        <td>@php echo substr($arr_group1[$q+3], 0,10) @endphp</td>
                       
                        <td>
                          @php 
                            if($arr_group1[$q+5] == 'учится'){
                              echo "Ещё учится";
                            }
                            if($arr_group1[$q+5] == 'выпустился'){
                              echo "Выпустился ".substr($arr_group1[$q+4], 0,10);
                            }
                            if($arr_group1[$q+5] == 'временно не учится'){
                              echo "Не учится c ".substr($arr_group1[$q+4], 0,10);
                            }
                            if($arr_group1[$q+5] == 'забросил обучени'){
                              echo "Забросил с ".substr($arr_group1[$q+4], 0,10);
                            }  

                          @endphp
                        </td>
                        
                      </tr>

                    @endif

                  @endfor
                @endif
                
                </table>
              </div>
              <!------>



              
              <div class="layer">
                <h3 align="middle">Журнал посещений</h3>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Группа</th>
                    <th>Урок</th>
                    <th>Статус</th>
                    <th>Дата</th>
                  </tr>
                  </thead>
                <tbody>
                @foreach($archive as $arch)
                  <tr>
                    <td><a href="{{url('/dashboard/group_students/'.$arch->group_id.'/edit')}}" target="_blank">{{$arch->group_id}}</a></td>
                    <td><a href="{{url('/dashboard/lesson/presence/'.$arch->lesson_id)}}" target="_blank">{{$arch->lesson_id}}</a></td>
                    <td>{{$arch->status}}</td>
                    <td>
                      @php 
                        $a = $arch->created_at; 
                        echo substr($a, 0,10);
                      @endphp
                    </td>
                  </tr>
                @endforeach
                </table>



              </div>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->


          <style>
            #example1_filter{
              margin-left: -60px;
              margin-top: 30px;
            }


            .layer{
              margin-top: -1px;
              float: right;
              overflow: scroll;
              width: 400px;
              height: 700px;
              padding: 5px;
            }

            @media screen and (max-width: 1000px){
              .layer{
              margin-top: 0px;
              float: left;
              overflow: scroll;
              width: 400px;
              height: 700px;
              padding: 5px;
            }

              

            
          </style>      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script>
      
      $(function(){
          $('#close').bind('click', function(){
            window.close();
          });
      });

    </script>
@endsection