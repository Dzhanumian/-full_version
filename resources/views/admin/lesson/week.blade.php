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
              <a href="/dashboard/lesson_month" class="btn btn-primary">По месяцам</a>
              
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
                      @if($filter['group_id'] == 9999) 
                      <option value="{{ $filter['group_id'] }}">Отработки</option>
                      @endif
                      @if($filter['group_id'] == 10000) 
                      <option value="{{ $filter['group_id'] }}">Тестирования</option>
                      @endif
                      @if($filter['group_id'] == 10001) 
                      <option value="{{ $filter['group_id'] }}">Пробные уроки</option>
                      @endif
                      @if($filter['group_id'] != 9999 and $filter['group_id'] != 10000) 
                      <option value="{{ $filter['group_id'] }}">Для {{ $filter["group_name"] }}</option>
                      @endif
                    @endif
                    
                      <option>Все группы</option>
                      <option value="9999">Отработки</option>
                      <option value="10000">Тестирование</option>
                      <option value="10001">Пробное занятие</option>
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
              <span style="margin-left: 40%;"> c {{ date_format(date_create($from), 'd.m.y') }}</span> 
              <span> по {{ date_format(date_create($before), 'd.m.y') }}</span>
            </div>
            <div style="float: right;">


              <a href="{{url('/dashboard/lesson_week/'.$week_before.'/'.$filter['teacher_id'].'/'.$filter['group_id'].'/'.$filter['room_id'] )}}" class="btn btn-default">Прошлая неделя</a>

              <a href="{{url('/dashboard/lesson_week/'.$week_next.'/'.$filter['teacher_id'].'/'.$filter['group_id'].'/'.$filter['room_id'] )}}" class="btn btn-default">Следующая неделя</a>
            </div>
            <div class="box-body">

              <div class="form-group" style="font-size: 20px;">
                <a href="{{route('lesson.create')}}"  class="btn btn-success">Добавить урок</a>
                <a href="{{route('automatic.create')}}"  class="btn btn-success">Добавить расписание</a>
                <a href="{{route('lesson.worked.create')}}" class="btn btn-success">Добавить отработку</a>
                <a href="{{route('lesson.test.create')}}" class="btn btn-success">Добавить тестирование</a>
                <a href="{{route('lesson.trial.student.get')}}" class="btn btn-success">Добавить пробное занятие</a>

              </div>
              
              <!-------------------Понедельник-------------------->
              <div class="control-3">
                <div style="width: 180px; float: left;">
                  <div style="font-size: 20px; font-weight:530;" align="middle">
                    Понедельник<br>{{ date_format(date_create($week_day[0]), 'd.m.y') }}
                  </div>
                  <div align="middle" style="">
                    <div>                      
                      @foreach($Monday as $les)
                        <div align="left" style="margin: 2px; height: 100px; margin-bottom: 35px; font-size: 20px; background: #C0C0C0">
                          <div style="border: solid #C0C0C0 2px; border-spacing:0;border-collapse: collapse;">
                            <span style="font-size: 16px;">{{$les->lesson_time.' - '.$les->lesson_time_end}}</span>
                            <a href="{{route('presence.show', $les->id)}}" class="fa fa-pencil-square-o" target="_blank"></a>
                             
                            <a style="margin-left: 8px" href="{{route('lesson.edit', $les->id)}}" class="fa fa-info"></a>
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
                            <div style="margin-bottom: 5px; font-weight:bold">
                              @php
                                $pieces = explode('<br>', $les->data_lesson); 
                                $group = substr($pieces[1], 0, 35); 
                                echo $group; 
                              @endphp
                            </div>
                            <div style="font-size: 14px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $teacher = substr($pieces[0], 0, 35); 
                                echo $teacher;
                              @endphp 
                            </div>
                            <div style="font-size: 12px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $sub = substr($pieces[3], 0, 20); 
                                $room = substr($pieces[2], 0, 17); 
                                echo $sub.': '.$room;
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
                    Вторник<br>{{ date_format(date_create($week_day[1]), 'd.m.y') }}
                  </div>
                  <div align="middle" style="">
                    <div>                      
                      @foreach($Tuesday as $les)
                        <div align="left" style="margin: 2px; height: 100px; margin-bottom: 35px; font-size: 20px; background: #C0C0C0">
                          <div style="border: solid #C0C0C0 2px; border-spacing:0;border-collapse: collapse;">
                            <span style="font-size: 16px;">{{$les->lesson_time.' - '.$les->lesson_time_end}}</span>
                            <a href="{{route('presence.show', $les->id)}}" class="fa fa-pencil-square-o" target="_blank"></a>
                             
                            <a style="margin-left: 8px" href="{{route('lesson.edit', $les->id)}}" class="fa fa-info"></a>
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
                            <div style="margin-bottom: 5px; font-weight:bold">
                              @php
                                $pieces = explode('<br>', $les->data_lesson); 
                                $group = substr($pieces[1], 0, 35); 
                                echo $group; 
                              @endphp
                            </div>
                            <div style="font-size: 14px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $teacher = substr($pieces[0], 0, 35); 
                                echo $teacher;
                              @endphp 
                            </div>
                            <div style="font-size: 12px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $sub = substr($pieces[3], 0, 20); 
                                $room = substr($pieces[2], 0, 17); 
                                echo $sub.': '.$room;
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
                    Среда<br>{{ date_format(date_create($week_day[2]), 'd.m.y') }}
                  </div>
                  <div align="middle" style="">
                    <div>                      
                      @foreach($Wednesday as $les)
                        <div align="left" style="margin: 2px; height: 100px; margin-bottom: 35px; font-size: 20px;background: #C0C0C0">
                          <div style="border: solid #C0C0C0 2px; border-spacing:0;border-collapse: collapse;">
                            <span style="font-size: 16px;">{{$les->lesson_time.' - '.$les->lesson_time_end}}</span>
                            <a href="{{route('presence.show', $les->id)}}" class="fa fa-pencil-square-o" target="_blank"></a>
                             
                            <a style="margin-left: 8px" href="{{route('lesson.edit', $les->id)}}" class="fa fa-info"></a>
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
                            <div style="margin-bottom: 5px; font-weight:bold">
                              @php
                                $pieces = explode('<br>', $les->data_lesson); 
                                $group = substr($pieces[1], 0, 35); 
                                echo $group; 
                              @endphp
                            </div>
                            <div style="font-size: 14px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $teacher = substr($pieces[0], 0, 35); 
                                echo $teacher;
                              @endphp 
                            </div>
                            <div style="font-size: 12px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $sub = substr($pieces[3], 0, 20); 
                                $room = substr($pieces[2], 0, 17); 
                                echo $sub.': '.$room;
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
                    Четверг<br>{{ date_format(date_create($week_day[3]), 'd.m.y') }}
                  </div>
                  <div align="middle" style="">
                    <div>                      
                      @foreach($Thursday as $les)
                        <div align="left" style="margin: 2px; height: 100px; margin-bottom: 35px; font-size: 20px; background: #C0C0C0">
                          <div style="border: solid #C0C0C0 2px; border-spacing:0;border-collapse: collapse;">
                            <span style="font-size: 16px;">{{$les->lesson_time.' - '.$les->lesson_time_end}}</span>
                            <a href="{{route('presence.show', $les->id)}}" class="fa fa-pencil-square-o" target="_blank"></a>
                             
                            <a style="margin-left: 8px" href="{{route('lesson.edit', $les->id)}}" class="fa fa-info"></a>
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
                            <div style="margin-bottom: 5px; font-weight:bold">
                              @php
                                $pieces = explode('<br>', $les->data_lesson); 
                                $group = substr($pieces[1], 0, 35); 
                                echo $group; 
                              @endphp
                            </div>
                            <div style="font-size: 14px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $teacher = substr($pieces[0], 0, 35); 
                                echo $teacher;
                              @endphp 
                            </div>
                            <div style="font-size: 12px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $sub = substr($pieces[3], 0, 20); 
                                $room = substr($pieces[2], 0, 17); 
                                echo $sub.': '.$room;
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
                    Пятница<br>{{ date_format(date_create($week_day[4]), 'd.m.y') }}
                  </div>
                  <div align="middle" style="">
                    <div>                      
                      @foreach($Friday as $les)
                        <div align="left" style="margin: 2px; height: 100px; margin-bottom: 35px; font-size: 20px;background: #C0C0C0">
                          <div style="border: solid #C0C0C0 2px; border-spacing:0;border-collapse: collapse;">
                            <span style="font-size: 16px;">{{$les->lesson_time.' - '.$les->lesson_time_end}}</span>
                            <a href="{{route('presence.show', $les->id)}}" class="fa fa-pencil-square-o" target="_blank"></a>
                             
                            <a style="margin-left: 8px" href="{{route('lesson.edit', $les->id)}}" class="fa fa-info"></a>
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
                            <div style="margin-bottom: 5px; font-weight:bold">
                              @php
                                $pieces = explode('<br>', $les->data_lesson); 
                                $group = substr($pieces[1], 0, 35); 
                                echo $group; 
                              @endphp
                            </div>
                            <div style="font-size: 14px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $teacher = substr($pieces[0], 0, 35); 
                                echo $teacher;
                              @endphp 
                            </div>
                            <div style="font-size: 12px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $sub = substr($pieces[3], 0, 20); 
                                $room = substr($pieces[2], 0, 17); 
                                echo $sub.': '.$room;
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
                    Суббота<br>{{ date_format(date_create($week_day[5]), 'd.m.y') }}
                  </div>
                  <div align="middle" style="">
                    <div>                      
                      @foreach($Saturday as $les)
                        <div align="left" style="margin: 2px; height: 100px; margin-bottom: 35px; font-size: 20px; background: #C0C0C0">
                          <div style="border: solid #C0C0C0 2px; border-spacing:0;border-collapse: collapse;">
                            <span style="font-size: 16px;">{{$les->lesson_time.' - '.$les->lesson_time_end}}</span>
                            <a href="{{route('presence.show', $les->id)}}" class="fa fa-pencil-square-o" target="_blank"></a>
                             
                            <a style="margin-left: 8px" href="{{route('lesson.edit', $les->id)}}" class="fa fa-info"></a>
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
                            <div style="margin-bottom: 5px; font-weight:bold">
                              @php
                                $pieces = explode('<br>', $les->data_lesson); 
                                $group = substr($pieces[1], 0, 35); 
                                echo $group; 
                              @endphp
                            </div>
                            <div style="font-size: 14px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $teacher = substr($pieces[0], 0, 35); 
                                echo $teacher;
                              @endphp 
                            </div>
                            <div style="font-size: 12px">
                              @php
                                $pieces = explode('<br>', $les->data_lesson);
                                $sub = substr($pieces[3], 0, 20); 
                                $room = substr($pieces[2], 0, 17); 
                                echo $sub.': '.$room;
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
                  Воскресенье<br>{{ date_format(date_create($week_day[6]), 'd.m.y') }}
                </div>
                <div align="middle" style="">
                  <div>                      
                    @foreach($Sunday as $les)
                      <div align="left" style="margin: 2px; height: 100px; margin-bottom: 35px; font-size: 20px; background: #C0C0C0">
                        <div style="border: solid #C0C0C0 2px; border-spacing:0;border-collapse: collapse;">
                          <span style="font-size: 16px;">{{$les->lesson_time.' - '.$les->lesson_time_end}}</span>
                          <a href="{{route('presence.show', $les->id)}}" class="fa fa-pencil-square-o" target="_blank"></a>
                           
                          <a style="margin-left: 8px" href="{{route('lesson.edit', $les->id)}}" class="fa fa-info"></a>
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
                          <div style="margin-bottom: 5px; font-weight:bold">
                            @php
                              $pieces = explode('<br>', $les->data_lesson); 
                              $group = substr($pieces[1], 0, 35); 
                              echo $group; 
                            @endphp
                          </div>
                          <div style="font-size: 14px">
                            @php
                              $pieces = explode('<br>', $les->data_lesson);
                              $teacher = substr($pieces[0], 0, 35); 
                              echo $teacher;
                            @endphp 
                          </div>
                          <div style="font-size: 12px">
                            @php
                              $pieces = explode('<br>', $les->data_lesson);
                              $sub = substr($pieces[3], 0, 20); 
                              $room = substr($pieces[2], 0, 17); 
                              echo $sub.': '.$room;
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection