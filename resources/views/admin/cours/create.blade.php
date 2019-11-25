@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box">
        <p><strong style="font-size: 20px">Добавление курсы</strong></p>
        <div class="box-body">
          <form method="POST" action="{{route('course.store')}}">
          @csrf

          <!------------>
          <div class="form-group row">
            <label for="course_name" class="col-md-2 col-form-label text-md-right">{{ __('Название курса') }}</label>
            <div class="col-md-6">
                <input id="course_name" type="text" class="form-control @error('course_name') is-invalid @enderror" name="course_name"  placeholder="Название" autocomplete="course_name" autofocus value="{{ old('course_name') }}">
                @error('course_name')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов. Возможно такой курс уже добавлен' }}</span>
                    </span>
                @enderror
            </div>
          </div>

          <!------------>
          <div class="form-group row">
            <label for="category" class="col-md-2 col-form-label text-md-right">{{ __('Категория') }}</label>
            <div class="col-md-6">
              <select class="form-control select2 @error('category') is-invalid @enderror"  name="category" autofocus autocomplete="category">
                <option>младшая школа</option>
                <option>средняя школа</option>
                <option>старшая школа</option>
                <option>студенты вузов</option>
                <option>взрослые</option>
                <option>преподаватели</option>
                <option>смешанная</option>
              </select>
                
              @error('category')
                  <span class="invalid-feedback" role="alert">
                      <span>{{ 'Филия не найдена' }}</span>
                  </span>
              @enderror
            </div>
          </div>
          <!------------>
           <div class="form-group row">
            <label for="level" class="col-md-2 col-form-label text-md-right">{{ __('Уровень') }}</label>
            <div class="col-md-6">
              <select class="form-control select2 @error('level') is-invalid @enderror"  name="level" autofocus autocomplete="level">
                <option>А1 - Beginner</option>
                <option>A2 - Pre-Intermediate</option>
                <option>B1 - Intermediate</option>
                <option>B2 - Upper-Intermediate</option>
                <option>C1 - Advanced</option>
                <option>C2 - Proficient</option>
              </select>
                
              @error('level')
                  <span class="invalid-feedback" role="alert">
                      <span>{{ 'Филия не найдена' }}</span>
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

