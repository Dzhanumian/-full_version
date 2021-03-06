@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box">
        <p><strong style="font-size: 20px">Редактирование группу</strong></p>
        <div class="box-body">
          <form method="POST" action="{{route('group.update', $group->id)}}">
          @method('PATCH')   
          @csrf
          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="teacher_surname" class="col-md-2 col-form-label text-md-right">{{ __('Преподавалетль') }}</label>
            <div class="col-md-6">
              <select class="form-control select2 @error('teacher_surname') is-invalid @enderror"  name="teacher_surname" autofocus autocomplete="teacher_surname">
                <option value="{{ $group->teacher_id.','.$group->teacher_name }}">{{ $group->teacher_name }}</option>
              @foreach($teachers as $teacher)
                <option value="{{ $teacher->id.','.$teacher->surname.' '.$teacher->name }}">{{ $teacher->surname .' '. $teacher->name }}</option>
              @endforeach
              </select>
                
              @error('teacher_surname')
                  <span class="invalid-feedback" role="alert">
                      <span>{{ 'Преподаватели не найдены' }}</span>
                  </span>
              @enderror
            </div>
          </div>
          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="group_name" class="col-md-2 col-form-label text-md-right">{{ __('Название группы') }}</label>
            <div class="col-md-6">
                <input id="group_name" type="text" class="form-control @error('group_name') is-invalid @enderror" name="group_name"  placeholder="Название группы" autocomplete="group_name" autofocus required value="{{ $group->group_name }}">
                @error('group_name')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                    </span>
                @enderror
            </div>
          </div>
          <!----------------------------------------------------->          
          <div class="form-group row">
            <label for="cours" class="col-md-2 col-form-label text-md-right">{{ __('Курс') }}</label>
            <div class="col-md-6">
              <select class="form-control select2 @error('cours') is-invalid @enderror"  name="cours" autofocus autocomplete="cours">
                <option>{{ $group->course }}</option>
              @foreach($courses as $cours)
                <option>{{ $cours->course_name }}</option>
              @endforeach
              </select>
                
              @error('cours')
                  <span class="invalid-feedback" role="alert">
                      <span>{{ 'курсы не найдены' }}</span>
                  </span>
              @enderror
            </div>
          </div>
          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="type" class="col-md-2 col-form-label text-md-right">{{ __('Тип группы') }}</label>
            <div class="col-md-6">
                <select class="form-control select2 @error('type') is-invalid @enderror"  name="type" autofocus autocomplete="type">
                  <option>{{ $group->type }}</option>
                  <option>Стандартная</option>
                  <option>Мини группа</option>
                  <option>Индивидуальная</option>
                </select>
            </div>
          </div>
          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="rate" class="col-md-2 col-form-label text-md-right">{{ __('Тариф') }}</label>
            <div class="col-md-6">
                <input id="rate" type="text" class="form-control @error('rate') is-invalid @enderror" name="rate"  placeholder="Для групп указывать за месяц, для инд за урок. Пример: 430" autocomplete="rate" autofocus value="{{ $group->rate }}" required>
                @error('rate')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно быть заполненым и состоять из цифр' }}</span>
                    </span>
                @enderror
            </div>
          </div>
          <!----------------------------------------------------->
          <div class="form-group row">
            <label for="status" class="col-md-2 col-form-label text-md-right">{{ __('Статус группы') }}</label>
            <div class="col-md-6">
                <select class="form-control select2 @error('status') is-invalid @enderror"  name="status" autofocus autocomplete="status">
                  <option>{{ $group->status }}</option>
                  <option>активная</option>
                  <option>не активная</option>
                </select>
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
