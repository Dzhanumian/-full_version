@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <button id="close" class="btn btn-success" style="margin-top: -30px;">Закрыть</button>
      <div class="box" style="font-size: 18px">
        <p><strong style="font-size: 20px">Урок №{{ $lesson->id}}</strong>
          @if (\Session::has('failure'))
            <div class="alert alert-danger">
              <ul>
                  <li>{!! \Session::get('failure')[0] !!}</li>
              </ul>
            </div>
          @endif
        <div class="box-body">
          <form method="POST" action="{{route('status_up.update', $lesson->id)}}">
          @method('PATCH')  
          @csrf
          <!----------------------------------------------------->
          <h4>Статус урока</h4>
          <div class="form-group row">
            <div class="col-md-3">
                <select class="form-control @error('status') is-invalid @enderror"  name="status" autofocus autocomplete="status">
                  <option value="{{$lesson->status.','.$lesson->color}}">{{ $lesson->status }}</option>
                  <option value="Запланированный,#FFD700">Запланированный</option>
                  <option value="Проведён,#32CD32">Проведён</option>
                  <option value="Отмененный,#357cf0">Отмененный</option>
                  <option value="Поздно отмененный,#FF0000">Поздно отмененный</option>
                </select>
                @error('status')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                    </span>
                @enderror
            </div>

            <div style="margin-left: 20px">
              <button type="submit" class="btn btn-primary">
                {{ __('Провести урок') }}
              </button>
            </div>
          </div>          
          <!----------------------------------------------------->
        </form>
        <div style="width: 100%;"></div>

        <div style="float: left; padding-right: 50px;">
          <h4>Информация об уроке</h4>
          <div><strong>Преподаватель:</strong> {{$teacher->surname.' '.$teacher->name}}</div>
          <div><strong>Дата:</strong> {{ date_format(date_create($lesson->lesson_date), 'l d.m.Y') }}</div>
          <div><strong>Время:</strong> {{$lesson->lesson_time.' - '.$lesson->lesson_time_end}}</div>
          <div><strong>Филиал:</strong> {{$room->subsidiaries_name}}</div>
          <div><strong>Кабинет:</strong> {{$room->room_name}}</div>
          @if(isset($group) != false)
          <div><strong>Группа:</strong> {{$group->group_name}}</div>
          @endif

          <a href="{{route('lesson.edit', $lesson->id)}}">
            <button type="button" class="btn btn-primary">
              Редактировать урок
            </button>
          </a>
            <br><br>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              Назначить пробное занятие
            </button>
              <!-- Modal -->
              <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Список студентов:</h4>
                    </div>
                    <div class="modal-body">
                      <div class="col-md-3">
                      
                      <form method="POST" action="{{route('lesson.trial.student.store')}}">
                      @csrf
                        <select class="select2" multiple name="tria_users[]" style="width: 400px;">
                          @foreach($TrialLesson as $trial)
                          <option value="{{ $trial->id }}" selected>{{ $trial->surname.' '.$trial->name.' '.$trial->patronymic }}</option>
                          @endforeach

                          @foreach($all_student as $students)
                              <option value="{{$students->id}}">{{ $students->surname.' '.$students->name }}</option>
                          @endforeach
                        </select>
                        <br><br>

                        <input type="hidden" name="lesson_idd" value="{{ $lesson->id }}">

                        <button type="submit" class="btn btn-primary">
                          Назначить
                        </button>
                      </form>

                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                  </div>

                </div>
              </div>

        </div>

        <div style="float: left; padding-right: 50px;">
          @if(isset($group) == true)
            <h4>Учащиеся группы {{$group->name}}:</h4>
          @endif

          @if(isset($group) != true)
            <h4>Учащиеся:</h4>
          @endif
          <ol>
            @if(isset($group) == true)

              @foreach($student as $stud)
                @foreach($stud as $s)
                  <li>{{ $s->surname.' '.$s->name }}</li>
                @endforeach
              @endforeach

            @endif

              @foreach($TrialLesson as $trial)
                <li style="color: orange">{{ $trial->surname.' '.$trial->name }}</li>
              @endforeach

          </ol>
        </div>

        <div style="float: left; padding-right: 50px;">
          <h4>Присутствовали:</h4>
          @for ($i = 0; $i < $limit_ar['limit']; $i++)
             
            @foreach($arr_presence[$i] as $key)
              <li>{{ $key->surname.' '.$key->name }}</li>
            @endforeach

          @endfor

        </div>

        <div style="float: left; padding-right: 50px;">
          <h4>Отсутствовали:</h4>
          @for ($i = 0; $i < $limit_ar['limit1']; $i++)
             
            @foreach($arr_presence1[$i] as $key)
              <li>{{ $key->surname.' '.$key->name }}</li>
            @endforeach

          @endfor
        </div>

        <div style="float: left; padding-right: 50px;">
          <form method="POST" action="{{route('presence.store')}}">
          @csrf

          <!------------>
          


                  <div class="up" style="margin-top: 40px">
                    <label for="studs" class="col-form-label">Отсутствовавшие на уроке учащиеся</label><br><small>Укажите учащихся, которые отсутствовали на уроке и нажмите кнопку "Отметить"<br>Если все учащиеся группы присутствовали на уроке, оставьте поле пустым и нажмите кнопку "Отметить"</small><br>
                    <select style="width: 475px" class="form-control select2"  name="studs[]" autofocus autocomplete="studs" multiple>
                      @foreach($TrialLesson as $trial)
                        <option value="{{ $trial->id }}">{{ $trial->surname.' '.$trial->name.' '.$trial->patronymic }}</option>
                      @endforeach

                      @foreach($student as $stud)
                        @foreach($stud as $s)
                          <option value="{{ $s->id }}">{{ $s->surname.' '.$s->name }}</option>
                        @endforeach
                      @endforeach
                    </select>
                  </div>


              <input type="hidden" name="lesson_id" value="{{ $lesson->id}}">
              @if(isset($group) == true)
                <input type="hidden" name="group_id" value="{{ $group->id}}">
              @endif
      
              @if(isset($group) != true)
                <input type="hidden" name="group_id" value="10001">
              @endif
              <!----------------------------------->
              <select name="all[]" multiple hidden="true">
                  
                  @foreach($student as $stud)
                    @foreach($stud as $s)
                      <option selected>{{ $s->id }}</option>
                    @endforeach
                  @endforeach 
                  @foreach($TrialLesson as $trial)
                    <option selected>{{ $trial->id }}</option>
                  @endforeach

              </select>
              <!----------------------------------->
              <button type="submit" class="btn btn-primary">
                {{ __('Отметить') }}
              </button>
          <!------------>       
        </form>
        </div>

      </div> 
    </section>
    <style>
      .invalid-feedback
      {
        color: red;
      };
    </style>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script>
      
      $(function(){
          $('#close').bind('click', function(){
            window.close();
          });
      });

    </script>
  </div>
@endsection

