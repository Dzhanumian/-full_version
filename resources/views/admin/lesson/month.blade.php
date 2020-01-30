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
              <div style="margin-left: 30px;">
                <a href="/dashboard/lesson" class="btn btn-primary">По дням</a>
                <a href="/dashboard/lesson_week" class="btn btn-primary">По неделям</a>
                <a href="/dashboard/lesson_month" class="btn btn-primary">По месяцам</a> 
                <!------------------------------------------------------------------->
                <div class="navbar-custom-menu" style="float: right;">
                <ul class="nav navbar-nav">
                  <!-- Messages: style can be found in dropdown.less-->
                  <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-info-circle"></i>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">Статистика уроков</li>
                      <li>
                        <ul class="menu">
                          <li style="padding: 5px 20px">
                              <p>Всего: {{$arr_stat[0]}}</p>
                              <p>Запланированных: {{$arr_stat[1]}}</p>
                              <p>Проведенных: {{$arr_stat[2]}}</p>
                              <p>Отмененных: {{$arr_stat[3]}}</p>
                              <p>Поздно отмененных: {{$arr_stat[4]}}</p> 
                              </div>
                          </li>
                        </ul>
                      </li>
                    </ul> 
              
                <form style="margin: 10px 0px 20px 0px;" method="POST" action="{{route('filter')}}">
                  @csrf
                  <!----------------------------------->
                  <select class="form-control select2" style="height: 34px; width: 200px;" name="teacher">
                      
                    @if($filter["teacher_id"] != null && $filter["teacher_id"] !=  0)
                      <option value=" {{ $filter['teacher_id'] }} ">Для {{ $filter["teacher_name"] }}</option>
                    @endif
                    
                      <option>Все учителя</option>
                  
                    @foreach ($teachers as $teacher)
                      <option value="{{ $teacher->id }}">{{ $teacher->surname.' '.$teacher->name }}</option>
                    @endforeach
                  </select>
                  <!----------------------------------->
                   <select class="form-control select2" style="height: 34px; width: 200px;" name="group">
                      
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
                      <option value="10000">Тестирования</option>
                      <option value="10001">Пробное занятие</option>
                    @foreach ($groups as $group)
                      <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                    @endforeach
                  </select>
                  <!----------------------------------->
                   <select class="form-control select2" style="height: 34px; width: 200px;" name="room">
                      
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
              <span style="margin-left: 40%;"></span><strong>{{ $count["month"] }}</strong>
              <span></span>
            </div>
            <div style="float: right;">

              <a href="{{url('/dashboard/lesson_month/'.$count['befor_month'].'/'.$filter['teacher_id'].'/'.$filter['group_id'].'/'.$filter['room_id'] )}}" class="btn btn-default">Прошлый месяц</a>
              <a href="{{url('/dashboard/lesson_month/'.$count['next_month'].'/'.$filter['teacher_id'].'/'.$filter['group_id'].'/'.$filter['room_id'] )}}" class="btn btn-default">Следующий месяц</a>

            </div>
            <div class="box-body">
              @if(Auth::user()->role != 'teacher')
              <div class="form-group" style="font-size: 20px;">
                <a href="{{route('lesson.create')}}" class="btn btn-success">Добавить урок</a>
                <a href="{{route('automatic.create')}}" class="btn btn-success">Добавить расписание</a>
                <a href="{{route('lesson.worked.create')}}" class="btn btn-success">Добавить отработку</a>
                <a href="{{route('lesson.test.create')}}" class="btn btn-success">Добавить тестирование</a>
              </div>
              @endif
              <!----------------Понедельник-------------------->


              <div style="width: 170px; font-style: 14px; float: left;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Понедельник {{ $first_week["date_week"][0] }}
                </div>
                <div align="middle" style="">
                  <div>                      
                    @foreach($first_week["monday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}} 

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div style="width: 100%"></div>
              
              <!----------------Вторник-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Вторник {{ $first_week["date_week"][1] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($first_week["tuesday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>

              <!----------------Среда-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Среда {{ $first_week["date_week"][2] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($first_week["wednesday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Четверг-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Четверг {{ $first_week["date_week"][3] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($first_week["thursday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}} 
                        
                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a>
                      </div>

                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Пятница-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Пятница {{ $first_week["date_week"][4] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($first_week["friday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Суббота-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Суббота {{ $first_week["date_week"][5] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($first_week["saturday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Воскресенье-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Воскресенье {{ $first_week["date_week"][6] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($first_week["sunday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
                      
            </div>
            <!-- /.box-body -->
            <div class="box-body"> 
              <!------------------Вторая неделя---------------->
              <!----------------Понедельник-------------------->


              <div style="width: 170px; font-style: 14px; float: left;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Понедельник {{ $second_week["date_week"][0] }}
                </div>
                <div align="middle" style="">
                  <div>                      
                    @foreach($second_week["monday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div style="width: 100%"></div>
              
              <!----------------Вторник-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Вторник {{ $second_week["date_week"][1] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($second_week["tuesday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>

              <!----------------Среда-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Среда {{ $second_week["date_week"][2] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($second_week["wednesday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Четверг-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Четверг {{ $second_week["date_week"][3] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($second_week["thursday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Пятница-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Пятница {{ $second_week["date_week"][4] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($second_week["friday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Суббота-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Суббота {{ $second_week["date_week"][5] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($second_week["saturday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Воскресенье-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Воскресенье {{ $second_week["date_week"][6] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($second_week["sunday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          

          <div class="box-body"> 
              <!------------------Третья неделя---------------->
              <!----------------Понедельник-------------------->

              <div style="width: 170px; font-style: 14px; float: left;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Понедельник {{ $third_week["date_week"][0] }}
                </div>
                <div align="middle" style="">
                  <div>                      
                    @foreach($third_week["monday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div style="width: 100%"></div>
              
              <!----------------Вторник-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Вторник {{ $third_week["date_week"][1] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($third_week["tuesday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>

              <!----------------Среда-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Среда {{ $third_week["date_week"][2] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($third_week["wednesday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Четверг-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Четверг {{ $third_week["date_week"][3] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($third_week["thursday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Пятница-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Пятница {{ $third_week["date_week"][4] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($third_week["friday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Суббота-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Суббота {{ $third_week["date_week"][5] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($third_week["saturday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Воскресенье-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Воскресенье {{ $third_week["date_week"][6] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($third_week["sunday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>

            <div class="box-body"> 
              <!------------------Четвёртая неделя---------------->
              <!----------------Понедельник-------------------->

              <div style="width: 170px; font-style: 14px; float: left;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Понедельник {{ $fourth_week["date_week"][0] }}
                </div>
                <div align="middle" style="">
                  <div>                      
                    @foreach($fourth_week["monday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div style="width: 100%"></div>
              
              <!----------------Вторник-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Вторник {{ $fourth_week["date_week"][1] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($fourth_week["tuesday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>

              <!----------------Среда-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Среда {{ $fourth_week["date_week"][2] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($fourth_week["wednesday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Четверг-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Четверг {{ $fourth_week["date_week"][3] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($fourth_week["thursday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Пятница-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Пятница {{ $fourth_week["date_week"][4] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($fourth_week["friday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Суббота-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Суббота {{ $fourth_week["date_week"][5] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($fourth_week["saturday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Воскресенье-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Воскресенье {{ $fourth_week["date_week"][6] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($fourth_week["sunday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>

            @if($count["week5"] == true)

            <div class="box-body"> 
              <!------------------Четвёртая неделя---------------->
              <!----------------Понедельник-------------------->

              <div style="width: 170px; font-style: 14px; float: left;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Понедельник {{ $fifth_week["date_week"][0] }}
                </div>
                <div align="middle" style="">
                  <div>                      
                    @foreach($fifth_week["monday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div style="width: 100%"></div>
              
              <!----------------Вторник-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Вторник {{ $fifth_week["date_week"][1] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($fifth_week["tuesday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>

              <!----------------Среда-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Среда {{ $fifth_week["date_week"][2] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($fifth_week["wednesday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Четверг-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Четверг {{ $fifth_week["date_week"][3] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($fifth_week["thursday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Пятница-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Пятница {{ $fifth_week["date_week"][4] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($fifth_week["friday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Суббота-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Суббота {{ $fifth_week["date_week"][5] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($fifth_week["saturday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Воскресенье-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Воскресенье {{ $fifth_week["date_week"][6] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($fifth_week["sunday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>

            @endif

            @if($count["week6"] == true)

            <div class="box-body"> 
              <!------------------Четвёртая неделя---------------->
              <!----------------Понедельник-------------------->

              <div style="width: 170px; font-style: 14px; float: left;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Понедельник {{ $sixth_week["date_week"][0] }}
                </div>
                <div align="middle" style="">
                  <div>                      
                    @foreach($sixth_week["monday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div style="width: 100%"></div>
              
              <!----------------Вторник-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Вторник {{ $sixth_week["date_week"][1] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($sixth_week["tuesday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>

              <!----------------Среда-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Среда {{ $sixth_week["date_week"][2] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($sixth_week["wednesday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Четверг-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Четверг {{ $sixth_week["date_week"][3] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($sixth_week["thursday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Пятница-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Пятница {{ $sixth_week["date_week"][4] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($sixth_week["friday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Суббота-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Суббота {{ $sixth_week["date_week"][5] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($sixth_week["saturday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              
              <!----------------Воскресенье-------------------->
              <div style="width: 170px; font-style: 14px; float: left; margin-left: 2px;">
                <div style="font-style: 16px; font-weight:530;" align="middle">
                  Воскресенье {{ $sixth_week["date_week"][6] }}
                </div>
                <div align="middle" style="">
                  <div>
                    @foreach($sixth_week["sunday"] as $les)
                      <div align="left" style="background: {{$les->color}}; margin: 2px; height: 35px;">
                        {{$les->lesson_time.' - '.$les->lesson_time_end}}

                        <div align="right" style="margin: -22px 30px 0px 0px;">
                          <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil" target="_blank"></a>
                          <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button type="submit" class="delete">
                              <i class="fa fa-remove"></i>
                            </button>
                          </form>
                        </div>
                        <a href="{{route('presence.show', $les->id)}}" target="_blank">
                          <div class="A" style="margin-top: -38px; width: 20px; height: 35px; float: right;">
                          </div>
                        </a> 
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>

            @endif
          </div>
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <style>
    .A:hover {
      background: #1E90FF;
    }


                table {
                font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
                font-size: 12px;
                border-collapse: collapse;
                text-align: center;
                }
                th, td:first-child {
                background: #AFCDE7;
                color: white;
                padding: 10px 20px;
                }
                th, td {
                border-style: solid;
                border-width: 0 1px 1px 0;
                border-color: white;
                }
                td {
                background: #D8E6F3;
                }
                th:first-child, td:first-child {
                text-align: left;
                }

    .stat{
      float: right; 
      margin-top: -60px;
    }
    @media screen and (max-width: 1205px){
      .stat{
      float: left; 
      margin-top: -1px;
    }
              </style>
@endsection