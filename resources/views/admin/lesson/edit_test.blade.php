@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box">
        <p><strong style="font-size: 20px">Добавление урока</strong></p>
        <div class="box-body">
          <form method="POST" action="{{route('lesson.update', $lesson->id)}}">
          @method('PATCH')  
          @csrf

          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="teacher_id" class="col-md-2 col-form-label text-md-right">{{ __('Преподователь') }}</label>
            <div class="col-md-6">
                <select class="form-control select2 @error('teacher_id') is-invalid @enderror" required  name="teacher_id" autofocus autocomplete="teacher_id">
                  <option selected value="{{ $teaches->id }}">{{ $teaches->surname .' '. $teaches->name }}</option>
                @foreach($teachers as $teacher)
                  <option value="{{ $teacher->id }}">{{ $teacher->surname .' '. $teacher->name }}</option>
                @endforeach
                </select> 
                @error('teacher_id')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно состоять из букв и его длинна не должна превышать 255 смиволов' }}</span>
                    </span>
                @enderror
            </div>
          </div>
          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="class_room" class="col-md-2 col-form-label text-md-right">{{ __('Кабинет') }}</label>
            <div class="col-md-6">
                <select class="form-control select2 @error('class_room') is-invalid @enderror"  name="class_room" autofocus autocomplete="class_room" required>
                  <option selected value="{{ $room->id }}">{{ $room->subsidiaries_name.': '.$room->room_name.' - мест:'.$room->seating_capacity }}</option>
                @foreach($class_rooms as $room)
                  <option value="{{ $room->id }}">{{ $room->subsidiaries_name.': '.$room->room_name.' - мест:'.$room->seating_capacity }}</option>
                @endforeach

                </select> 
                @error('class_room')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно состоять из букв и его длинна не должна превышать 255 смиволов' }}</span>
                    </span>
                @enderror
            </div>
          </div>
          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="lesson_date" class="col-md-2 col-form-label text-md-right">{{ __('Дата занятия') }}</label>
            <div class="col-md-6">

                <input id="lesson_date" type="date" class="form-control @error('lesson_date') is-invalid @enderror" name="lesson_date" value="{{ $lesson->lesson_date }}"  autocomplete="lesson_date" autofocus required>

                @error('lesson_date')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                    </span>
                @enderror
            </div>
          </div>
          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="lesson_time" class="col-md-2 col-form-label text-md-right">{{ __('Урок начнётся в') }}</label>
            <div class="col-md-6">

                <input id="lesson_time" type="time" class="form-control @error('lesson_time') is-invalid @enderror" name="lesson_time" value="{{ $lesson->lesson_time }}"  autocomplete="lesson_time" autofocus required>

                @error('lesson_time')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                    </span>
                @enderror
            </div>
          </div>

          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="lesson_time_end" class="col-md-2 col-form-label text-md-right">{{ __('Урок закончится в') }}</label>
            <div class="col-md-6">

                <input id="lesson_time_end" type="time" class="form-control @error('lesson_time_end') is-invalid @enderror" name="lesson_time_end" value="{{ $lesson->lesson_time_end }}"  autocomplete="lesson_time_end" autofocus required>

                @error('lesson_time_end')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                    </span>
                @enderror
            </div>
          </div>
          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="comment" class="col-md-2 col-form-label text-md-right">{{ __('Комментарий') }}</label>
            <div class="col-md-6">
                <textarea id="comment" name="comment" style="width: 100%;">@foreach($student as $stud){{ $stud->comment }}
                    @break
                  @endforeach
                </textarea>
            </div>
          </div>
          <!----------------------------------------------------->
          <!----------------------------------------------------->
          <h3 style="margin-left: 450px;">Студенты</h3>
          <div id="addStud" style="margin-left: 430px; margin-bottom: 10px;" class="btn btn-primary">Добавить студента</div>

          <!----------------------------------------------------->
          @php
            $i = 1;
          @endphp

          @php
            echo $limit = count($student);
          @endphp

          @foreach($student as $stud)
          <div id="st{{$i}}"> 
            <div class="form-group row">
              <label for="fio{{$i}}" class="col-md-2 col-form-label text-md-right">ФИО</label>
              <div class="col-md-6">
                  <input id="fio{{$i}}" name="fio{{$i}}" style="width: 100%;" value="{{$stud->fio}}"> 
              </div>
            </div>
          @php
            
          @endphp
            <div class="form-group row">
              <label for="phone{{$i}}" class="col-md-2 col-form-label text-md-right">Телефон</label>
              <div class="col-md-6">
                  <input id="phone{{$i}}" name="phone{{$i}}" style="width: 100%;" value="{{$stud->phone_number
}}"> 
              </div>
            </div>
          </div>
          <br>
          <!----------------------------------------------------->
          
          
          
          @php
            $i++;
          @endphp
        
          @if($i > $limit)
          @for($q = $i; $q <= 7; $q++)
          <div id="st{{$q}}" class="hidden"> 
            <div class="form-group row">
              <label for="fio{{$q}}" class="col-md-2 col-form-label text-md-right">ФИО</label>
              <div class="col-md-6">
                  <input id="fio{{$q}}" name="fio{{$q}}" style="width: 100%;"> 
              </div>
            </div>
          @php
            
          @endphp
            <div class="form-group row">
              <label for="phone{{$q}}" class="col-md-2 col-form-label text-md-right">Телефон</label>
              <div class="col-md-6">
                  <input id="phone{{$q}}" name="phone{{$q}}" style="width: 100%;"> 
              </div>
            </div>
          </div>
          <br>
          <!----------------------------------------------------->
          
          <div style="opacity: 0">$i++</div>

          @endfor
          @endif

          @endforeach

          <input type="hidden" name="back" value="{{ $back }}">
          
          <style>
            .hidden{
              display: none;
            }
          </style>

          <div class="form-group row">
            <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                {{ __('Подтвердить') }}
              </button>
            </div>
          </div>

        </form>
        </div>
      </div> 
      <input type="hidden" id="var_val" value="{{$i+1}}"> 
    </section>
    <style>
      .invalid-feedback
      {
        color: red;
      };
    </style>
  </div>

  <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
  <script>
    var sad = document.getElementById("var_val").value;
    $('#addStud').click(function(){
      $("#st"+sad).removeClass('hidden');
      sad = Number(sad)+1;
    });
  </script>


@endsection

