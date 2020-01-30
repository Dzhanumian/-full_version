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
          <form method="POST" action="{{route('lesson.test.store')}}">
          @csrf

          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="teacher_id" class="col-md-2 col-form-label text-md-right">{{ __('Преподователь') }}</label>
            <div class="col-md-6">
                <select class="form-control select2 @error('teacher_id') is-invalid @enderror"  name="teacher_id" autofocus autocomplete="teacher_id">
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
                <select class="form-control select2 @error('class_room') is-invalid @enderror"  name="class_room" autofocus autocomplete="class_room">
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

                <input id="lesson_date" type="date" class="form-control @error('lesson_date') is-invalid @enderror" name="lesson_date" value="{{ old('lesson_date') }}"  autocomplete="lesson_date" autofocus required>

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

                <input id="lesson_time" type="time" class="form-control @error('lesson_time') is-invalid @enderror" name="lesson_time" value="{{ old('lesson_time') }}"  autocomplete="lesson_time" autofocus required>

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

                <input id="lesson_time_end" type="time" class="form-control @error('lesson_time_end') is-invalid @enderror" name="lesson_time_end" value="{{ old('lesson_time_end') }}"  autocomplete="lesson_time_end" autofocus required>

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
                <textarea id="comment" name="comment" style="width: 100%;">
                </textarea>
            </div>
          </div>
          <!----------------------------------------------------->
          <!----------------------------------------------------->
          <h3 style="margin-left: 450px;">Студенты</h3>
          <div id="addStud" style="margin-left: 430px; margin-bottom: 10px;" class="btn btn-primary">Добавить студента</div>

          <div id="st1"> 
            <div class="form-group row">
              <label for="fio1" class="col-md-2 col-form-label text-md-right">{{ __('ФИО') }}</label>
              <div class="col-md-6">
                  <input required id="fio1" name="fio1" style="width: 100%;" required> 
              </div>
            </div>

            <div class="form-group row">
              <label for="phone1" class="col-md-2 col-form-label text-md-right">{{ __('Телефон') }}</label>
              <div class="col-md-6">
                  <input id="phone1" name="phone1" style="width: 100%;"> 
              </div>
            </div>
          </div>
          <br>
          <!----------------------------------------------------->
          <div id="st2" class="hidden">
            <div class="form-group row">
              <label for="fio2" class="col-md-2 col-form-label text-md-right">{{ __('ФИО') }}</label>
              <div class="col-md-6">
                  <input id="fio2" name="fio2" style="width: 100%;"> 
              </div>
            </div>

            <div class="form-group row">
              <label for="phone2" class="col-md-2 col-form-label text-md-right">{{ __('Телефон') }}</label>
              <div class="col-md-6">
                  <input id="phone2" name="phone2" style="width: 100%;"> 
              </div>
            </div>
          </div>
          <br>
          <!----------------------------------------------------->
          <div id="st3" class="hidden">
            <div class="form-group row">
              <label for="fio3" class="col-md-2 col-form-label text-md-right">{{ __('ФИО') }}</label>
              <div class="col-md-6">
                  <input id="fio3" name="fio3" style="width: 100%;"> 
              </div>
            </div>

            <div class="form-group row">
              <label for="phone3" class="col-md-2 col-form-label text-md-right">{{ __('Телефон') }}</label>
              <div class="col-md-6">
                  <input id="phone3" name="phone3" style="width: 100%;"> 
              </div>
            </div>
          </div>
          <br>
          <!----------------------------------------------------->
          <div id="st4" class="hidden">
            <div class="form-group row">
              <label for="fio4" class="col-md-2 col-form-label text-md-right">{{ __('ФИО') }}</label>
              <div class="col-md-6">
                  <input id="fio4" name="fio4" style="width: 100%;"> 
              </div>
            </div>

            <div class="form-group row">
              <label for="phone4" class="col-md-2 col-form-label text-md-right">{{ __('Телефон') }}</label>
              <div class="col-md-6">
                  <input id="phone4" name="phone4" style="width: 100%;"> 
              </div>
            </div>
          </div>
          <br>
          <!----------------------------------------------------->
          <div id="st5" class="hidden">
            <div class="form-group row">
              <label for="fio5" class="col-md-2 col-form-label text-md-right">{{ __('ФИО') }}</label>
              <div class="col-md-6">
                  <input id="fio5" name="fio5" style="width: 100%;"> 
              </div>
            </div>

            <div class="form-group row">
              <label for="phone5" class="col-md-2 col-form-label text-md-right">{{ __('Телефон') }}</label>
              <div class="col-md-6">
                  <input id="phone5" name="phone5" style="width: 100%;"> 
              </div>
            </div>
          </div>
          <br>
          <!----------------------------------------------------->
          <div id="st6" class="hidden">
            <div class="form-group row">
              <label for="fio6" class="col-md-2 col-form-label text-md-right">{{ __('ФИО') }}</label>
              <div class="col-md-6">
                  <input id="fio6" name="fio6" style="width: 100%;"> 
              </div>
            </div>

            <div class="form-group row">
              <label for="phone6" class="col-md-2 col-form-label text-md-right">{{ __('Телефон') }}</label>
              <div class="col-md-6">
                  <input id="phone6" name="phone6" style="width: 100%;"> 
              </div>
            </div>
          </div>
          <br>
          <!----------------------------------------------------->
          <div id="st7" class="hidden">
            <div class="form-group row">
              <label for="fio7" class="col-md-2 col-form-label text-md-right">{{ __('ФИО') }}</label>
              <div class="col-md-6">
                  <input id="fio7" name="fio7" style="width: 100%;"> 
              </div>
            </div>

            <div class="form-group row">
              <label for="phone7" class="col-md-2 col-form-label text-md-right">{{ __('Телефон') }}</label>
              <div class="col-md-6">
                  <input id="phone7" name="phone7" style="width: 100%;"> 
              </div>
            </div>
          </div>
          <br>
          <!----------------------------------------------------->
          
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
    var sad = 2;
    $('#addStud').click(function(){
      $("#st"+sad).removeClass('hidden');
      sad = sad+1;
    });
  </script>


@endsection

