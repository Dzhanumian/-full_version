@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div style="margin-left: 10px;">
              <a href="/dashboard/lesson" class="btn btn-primary">По дням</a>
              <a href="/dashboard/lesson_week" class="btn btn-primary">По неделям</a>
              <a href="/dashboard/lesson_month" class="btn btn-primary">по месяцам</a>
              
              <form style="margin: 10px 0px 20px 0px;" method="POST" action="{{route('filterW')}}">
                  @csrf
                  <!----------------------------------->
                  <select class="form-control select2" style="height: 34px; width: 200px" name="teacher">
                      
                    @if($filter["teacher_id"] != null && $filter["teacher_id"] !=  0)
                      <option value=" {{ $filter['teacher_id'] }} ">Для {{ $filter["teacher_name"] }}</option>
                    @endif
                    
                      <option>Все учителя</option>
                  
                    @foreach ($teachers as $teacher)
                      <option value="{{ $teacher->id }}">{{ $teacher->surname.' '.$teacher->name }}</option>
                    @endforeach
                  </select>
                  <!----------------------------------->
                   <select class="form-control select2" style="height: 34px; width: 200px" name="group">
                      
                    @if($filter["group_id"] != null && $filter["group_id"] != 0)
                      <option value="{{ $filter['group_id'] }}">Для {{ $filter["group_name"] }}</option>
                    @endif
                    
                      <option>Все группы</option>
                  
                    @foreach ($groups as $group)
                      <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                    @endforeach
                  </select>
                  <!----------------------------------->
                   <select class="form-control select2" style="height: 34px; width: 200px" name="room">
                      
                    @if($filter["room_id"] != null && $filter["room_id"] != 0)
                      <option value="{{ $filter['room_id'] }}">Для {{ $filter["room_name"] }}</option>
                    @endif
                    
                      <option>Все кабинеты</option>
                  
                    @foreach ($Room as $ro)
                      <option value="{{ $ro->id }}">{{ $ro->room_name }}</option>
                    @endforeach
                  </select>

                  <input type="hidden" name="date" value="{{ $count['data'] }}">

                  <button type="submit" class="btn btn-primary">
                  {{ __('Подтвердить') }}
                  </button>

                </form>
            </div>
            <div style="font-size: 20px;">
              <span style="margin-left: 40%;">{{ $from }}</span> \
              <span>{{ $before }}</span>
            </div>
            <div style="float: right;">


              <a href="{{url('/dashboard/lesson_week/'.$week_before.'/'.$filter['teacher_id'].'/'.$filter['group_id'].'/'.$filter['room_id'] )}}" class="btn btn-default">Прошлый месяц</a>

              <a href="{{url('/dashboard/lesson_week/'.$week_next.'/'.$filter['teacher_id'].'/'.$filter['group_id'].'/'.$filter['room_id'] )}}" class="btn btn-default">Следующий месяц</a>
            </div>
            <div class="box-body">

              <div class="form-group" style="font-size: 20px;">
                <a href="{{route('lesson.create')}}"  class="btn btn-success">Добавить 1 занятие</a>
                <a href="{{route('automatic.create')}}"  class="btn btn-success">Добавить несколько занятий</a>
              </div>
              
              <!-------------------Понедельник-------------------->
              <div class="control-3">
                <div style="width: 180px; float: left;">
                  <div style="font-size: 20px; font-weight:530;" align="middle">
                    Понедельник<br>{{ $week_day[0] }}
                  </div>
                  <div align="middle" style="">
                    <div>                      
                      @foreach($Monday as $les)
                        <div align="left" style="margin: 2px; height: 100px; margin-bottom: 35px; font-size: 20px;">
                          <div style="border: solid #f4f4f4 2px; border-spacing:0;border-collapse: collapse;">
                            <span style="font-size: 16px;">{{$les->lesson_time.' - '.$les->lesson_time_end}}</span>
                            <a href="{{route('presence.show', $les->id)}}" class="fa fa-pencil-square-o" target="_blank"></a>
                             
                            <a style="margin-left: 5px" href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil"></a>
                            <form style="float: right;" onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                              <input type="hidden" name="_method" value="DELETE">
                                {{csrf_field()}}
                              <button type="submit" class="delete">
                                <i class="fa fa-remove"></i>
                              </button>
                            </form>
                            
                          </div>
                          <div style="background: {{$les->color}}; height: 100%; font-size: 16px; padding: 1px 3px">
                            <div style="padding-bottom: 7px">
                              {{ $les->type }}
                            </div>
                            <div style="margin-bottom: 5px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson); 
                                $group = substr($pieces[1], 0, 35); 
                                echo $group; 
                              @endphp
                            </div>
                            <div style="font-size: 14px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $teacher = substr($pieces[0], 0, 29); 
                                echo $teacher;
                              @endphp 
                            </div>
                            <div style="font-size: 12px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $sub = substr($pieces[3], 0, 20); 
                                $room = substr($pieces[2], 0, 17); 
                                echo $sub.'..:'.$room;
                              @endphp 
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                <div style="width: 100%"></div>
                <!----------------Вторник-------------------->
                <div style="width: 180px; float: left;">
                  <div style="font-size: 20px; font-weight:530;" align="middle">
                    Вторник<br>{{ $week_day[1] }}
                  </div>
                  <div align="middle" style="">
                    <div>                      
                      @foreach($Tuesday as $les)
                        <div align="left" style="margin: 2px; height: 100px; margin-bottom: 35px; font-size: 20px;">
                          <div style="border: solid #f4f4f4 2px; border-spacing:0;border-collapse: collapse;">
                            <span style="font-size: 16px;">{{$les->lesson_time.' - '.$les->lesson_time_end}}</span>
                            <a href="{{route('presence.show', $les->id)}}" class="fa fa-pencil-square-o" target="_blank"></a>
                             
                            <a style="margin-left: 5px" href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil"></a>
                            <form style="float: right;" onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                              <input type="hidden" name="_method" value="DELETE">
                                {{csrf_field()}}
                              <button type="submit" class="delete">
                                <i class="fa fa-remove"></i>
                              </button>
                            </form>
                            
                          </div>
                          <div style="background: {{$les->color}}; height: 100%; font-size: 16px; padding: 1px 3px">
                            <div style="padding-bottom: 7px">
                              {{ $les->type }}
                            </div>
                            <div style="margin-bottom: 5px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson); 
                                $group = substr($pieces[1], 0, 35); 
                                echo $group; 
                              @endphp
                            </div>
                            <div style="font-size: 14px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $teacher = substr($pieces[0], 0, 29); 
                                echo $teacher;
                              @endphp 
                            </div>
                            <div style="font-size: 12px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $sub = substr($pieces[3], 0, 20); 
                                $room = substr($pieces[2], 0, 17); 
                                echo $sub.'..:'.$room;
                              @endphp 
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
              <div class="control-3">
                <!----------------Среда-------------------->
                <div style="width: 180px; float: left;">
                  <div style="font-size: 20px; font-weight:530;" align="middle">
                    Среда<br>{{ $week_day[2] }}
                  </div>
                  <div align="middle" style="">
                    <div>                      
                      @foreach($Wednesday as $les)
                        <div align="left" style="margin: 2px; height: 100px; margin-bottom: 35px; font-size: 20px;">
                          <div style="border: solid #f4f4f4 2px; border-spacing:0;border-collapse: collapse;">
                            <span style="font-size: 16px;">{{$les->lesson_time.' - '.$les->lesson_time_end}}</span>
                            <a href="{{route('presence.show', $les->id)}}" class="fa fa-pencil-square-o" target="_blank"></a>
                             
                            <a style="margin-left: 5px" href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil"></a>
                            <form style="float: right;" onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                              <input type="hidden" name="_method" value="DELETE">
                                {{csrf_field()}}
                              <button type="submit" class="delete">
                                <i class="fa fa-remove"></i>
                              </button>
                            </form>
                            
                          </div>
                          <div style="background: {{$les->color}}; height: 100%; font-size: 16px; padding: 1px 3px">
                            <div style="padding-bottom: 7px">
                              {{ $les->type }}
                            </div>
                            <div style="margin-bottom: 5px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson); 
                                $group = substr($pieces[1], 0, 35); 
                                echo $group; 
                              @endphp
                            </div>
                            <div style="font-size: 14px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $teacher = substr($pieces[0], 0, 29); 
                                echo $teacher;
                              @endphp 
                            </div>
                            <div style="font-size: 12px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $sub = substr($pieces[3], 0, 20); 
                                $room = substr($pieces[2], 0, 17); 
                                echo $sub.'..:'.$room;
                              @endphp 
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                <!----------------Четверг-------------------->
                <div style="width: 180px; float: left;">
                  <div style="font-size: 20px; font-weight:530;" align="middle">
                    Четверг<br>{{ $week_day[3] }}
                  </div>
                  <div align="middle" style="">
                    <div>                      
                      @foreach($Thursday as $les)
                        <div align="left" style="margin: 2px; height: 100px; margin-bottom: 35px; font-size: 20px;">
                          <div style="border: solid #f4f4f4 2px; border-spacing:0;border-collapse: collapse;">
                            <span style="font-size: 16px;">{{$les->lesson_time.' - '.$les->lesson_time_end}}</span>
                            <a href="{{route('presence.show', $les->id)}}" class="fa fa-pencil-square-o" target="_blank"></a>
                             
                            <a style="margin-left: 5px" href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil"></a>
                            <form style="float: right;" onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                              <input type="hidden" name="_method" value="DELETE">
                                {{csrf_field()}}
                              <button type="submit" class="delete">
                                <i class="fa fa-remove"></i>
                              </button>
                            </form>
                            
                          </div>
                          <div style="background: {{$les->color}}; height: 100%; font-size: 16px; padding: 1px 3px">
                            <div style="padding-bottom: 7px">
                              {{ $les->type }}
                            </div>
                            <div style="margin-bottom: 5px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson); 
                                $group = substr($pieces[1], 0, 35); 
                                echo $group; 
                              @endphp
                            </div>
                            <div style="font-size: 14px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $teacher = substr($pieces[0], 0, 29); 
                                echo $teacher;
                              @endphp 
                            </div>
                            <div style="font-size: 12px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $sub = substr($pieces[3], 0, 20); 
                                $room = substr($pieces[2], 0, 17); 
                                echo $sub.'..:'.$room;
                              @endphp 
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
              <div class="control-3">
                <!----------------Пятница-------------------->
                <div style="width: 180px; float: left;">
                  <div style="font-size: 20px; font-weight:530;" align="middle">
                    Пятница<br>{{ $week_day[4] }}
                  </div>
                  <div align="middle" style="">
                    <div>                      
                      @foreach($Friday as $les)
                        <div align="left" style="margin: 2px; height: 100px; margin-bottom: 35px; font-size: 20px;">
                          <div style="border: solid #f4f4f4 2px; border-spacing:0;border-collapse: collapse;">
                            <span style="font-size: 16px;">{{$les->lesson_time.' - '.$les->lesson_time_end}}</span>
                            <a href="{{route('presence.show', $les->id)}}" class="fa fa-pencil-square-o" target="_blank"></a>
                             
                            <a style="margin-left: 5px" href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil"></a>
                            <form style="float: right;" onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                              <input type="hidden" name="_method" value="DELETE">
                                {{csrf_field()}}
                              <button type="submit" class="delete">
                                <i class="fa fa-remove"></i>
                              </button>
                            </form>
                            
                          </div>
                          <div style="background: {{$les->color}}; height: 100%; font-size: 16px; padding: 1px 3px">
                            <div style="padding-bottom: 7px">
                              {{ $les->type }}
                            </div>
                            <div style="margin-bottom: 5px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson); 
                                $group = substr($pieces[1], 0, 35); 
                                echo $group; 
                              @endphp
                            </div>
                            <div style="font-size: 14px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $teacher = substr($pieces[0], 0, 29); 
                                echo $teacher;
                              @endphp 
                            </div>
                            <div style="font-size: 12px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $sub = substr($pieces[3], 0, 20); 
                                $room = substr($pieces[2], 0, 17); 
                                echo $sub.'..:'.$room;
                              @endphp 
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                <!----------------Суббота-------------------->
                <div style="width: 180px; float: left;">
                  <div style="font-size: 20px; font-weight:530;" align="middle">
                    Суббота<br>{{ $week_day[5] }}
                  </div>
                  <div align="middle" style="">
                    <div>                      
                      @foreach($Saturday as $les)
                        <div align="left" style="margin: 2px; height: 100px; margin-bottom: 35px; font-size: 20px;">
                          <div style="border: solid #f4f4f4 2px; border-spacing:0;border-collapse: collapse;">
                            <span style="font-size: 16px;">{{$les->lesson_time.' - '.$les->lesson_time_end}}</span>
                            <a href="{{route('presence.show', $les->id)}}" class="fa fa-pencil-square-o" target="_blank"></a>
                             
                            <a style="margin-left: 5px" href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil"></a>
                            <form style="float: right;" onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                              <input type="hidden" name="_method" value="DELETE">
                                {{csrf_field()}}
                              <button type="submit" class="delete">
                                <i class="fa fa-remove"></i>
                              </button>
                            </form>
                            
                          </div>
                          <div style="background: {{$les->color}}; height: 100%; font-size: 16px; padding: 1px 3px">
                            <div style="padding-bottom: 7px">
                              {{ $les->type }}
                            </div>
                            <div style="margin-bottom: 5px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson); 
                                $group = substr($pieces[1], 0, 35); 
                                echo $group; 
                              @endphp
                            </div>
                            <div style="font-size: 14px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $teacher = substr($pieces[0], 0, 29); 
                                echo $teacher;
                              @endphp 
                            </div>
                            <div style="font-size: 12px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $sub = substr($pieces[3], 0, 20); 
                                $room = substr($pieces[2], 0, 17); 
                                echo $sub.'..:'.$room;
                              @endphp 
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
              @if(empty($Sunday) == false)
              @else
            <div class="control-3">
              <!----------------Воскресенье-------------------->
              <div style="width: 180px; float: left;">
                <div style="font-size: 20px; font-weight:530;" align="middle">
                  Воскресенье<br>{{ $week_day[6] }}
                </div>
                <div align="middle" style="">
                  <div>                      
                    @foreach($Sunday as $les)
                      <div align="left" style="margin: 2px; height: 100px; margin-bottom: 35px; font-size: 20px;">
                        <div style="border: solid #f4f4f4 2px; border-spacing:0;border-collapse: collapse;">
                          <span style="font-size: 16px;">{{$les->lesson_time.' - '.$les->lesson_time_end}}</span>
                          <a href="{{route('presence.show', $les->id)}}" class="fa fa-pencil-square-o" target="_blank"></a>
                           
                          <a style="margin-left: 5px" href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil"></a>
                          <form style="float: right;" onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                              {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                          
                        </div>
                        <div style="background: {{$les->color}}; height: 100%; font-size: 16px; padding: 1px 3px">
                          <div style="padding-bottom: 7px">
                            {{ $les->type }}
                          </div>
                          <div style="margin-bottom: 5px">
                            @php
                              $pieces = explode('<br>', $les->data_lesson); 
                              $group = substr($pieces[1], 0, 35); 
                              echo $group; 
                            @endphp
                          </div>
                          <div style="font-size: 14px">
                            @php
                              $pieces = explode('<br>', $les->data_lesson);
                              $teacher = substr($pieces[0], 0, 29); 
                              echo $teacher;
                            @endphp 
                          </div>
                          <div style="font-size: 12px">
                            @php
                              $pieces = explode('<br>', $les->data_lesson);
                              $sub = substr($pieces[3], 0, 20); 
                              $room = substr($pieces[2], 0, 17); 
                              echo $sub.'..:'.$room;
                            @endphp 
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              @endif
            </div>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <style>
    .A:hover {
      background: #1E90FF; /* Цвет фона при наведении */
      }
    .control-3{
      width: 360px;
      float: left;
    }
  </style>
@endsection