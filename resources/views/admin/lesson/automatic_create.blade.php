@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box">
        <p><strong style="font-size: 20px">Добавление уроков</strong></p>
        <div class="box-body">
          <form method="POST" action="{{route('automatic.store')}}">
          @csrf
          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="from" class="col-md-2 col-form-label text-md-right">{{ __('ОТ') }}</label>
            <div class="col-md-6">

                <input id="from" type="date" class="form-control @error('from') is-invalid @enderror" name="from" value="{{ old('from') }}"  autocomplete="from" autofocus required>

                @error('from')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                    </span>
                @enderror
            </div>
          </div>
          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="before" class="col-md-2 col-form-label text-md-right">{{ __('ДО') }}</label>
            <div class="col-md-6">

                <input id="before" type="date" class="form-control @error('before') is-invalid @enderror" name="before" value="{{ old('before') }}"  autocomplete="before" autofocus required>

                @error('before')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                    </span>
                @enderror
            </div>
          </div>
          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="day_week" class="col-md-2 col-form-label text-md-right">{{ __('Дни') }}</label>
            <div class="col-md-6">
                <select class="form-control select2 @error('day_week') is-invalid @enderror"  name="day_week" autofocus autocomplete="day_week">

                  <option value="Monday">По всем понедельникам</option>
                  <option value="Tuesday">По всем вторникам</option>
                  <option value="Wednesday">По всем средам</option>
                  <option value="Thursday">По всем четвергам</option>
                  <option value="Friday">По всем пятницам</option>
                  <option value="Saturday">По всем субботам</option>
                  <option value="Sunday">По всем воскресеньям</option>

                </select> 
                @error('day_week')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно состоять из букв и его длинна не должна превышать 255 смиволов' }}</span>
                    </span>
                @enderror
            </div>
          </div>
          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="teacher_id" class="col-md-2 col-form-label text-md-right">{{ __('Преподователь') }}</label>
            <div class="col-md-6">
                <select class="form-control select2 @error('teacher_id') is-invalid @enderror"  name="teacher_id" autofocus autocomplete="teacher_id">
                  <option>Не выбрано</option>
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
            <label for="group_id" class="col-md-2 col-form-label text-md-right">{{ __('Занятие для группы') }}</label>
            <div class="col-md-6">
                <select class="form-control select2 @error('group_id') is-invalid @enderror"  name="group_id" autofocus autocomplete="group_id">
                @foreach($groups as $group)
                  <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                @endforeach
                </select> 
                @error('group_id')
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
            <label for="status" class="col-md-2 col-form-label text-md-right">{{ __('Статус урока') }}</label>
            <div class="col-md-6">
                <select class="form-control select2 @error('status') is-invalid @enderror"  name="status" autofocus autocomplete="status">
                  <option value="Запланированный,#FFD700">Запланированный</option>
                </select>
                @error('status')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                    </span>
                @enderror
            </div>
          </div>
          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="type" class="col-md-2 col-form-label text-md-right">{{ __('Тип урока') }}</label>
            <div class="col-md-6">
                <select class="form-control select2 @error('type') is-invalid @enderror"  name="type" autofocus autocomplete="type">
                  <option>Урок по расписанию</option>
                  <option>Тестирование</option>
                  <option>Пробное занятие</option>
                  <option>Отработка</option>
                  <option>Speaking club</option>
                </select>
                @error('type')
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
@endsection

