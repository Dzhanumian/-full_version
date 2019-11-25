@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box">
        <p><strong style="font-size: 20px">Редактирование пользователя</strong></p>
        <div class="box-body">
          <form method="POST" action="{{route('users.update', $user->id)}}">
          @method('PATCH')
          @csrf

          <div class="form-group row">
            <label for="surname" class="col-md-2 col-form-label text-md-right">{{ __('Фамилия') }}</label>
            <div class="col-md-6">
                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname"  value="{{ $user->surname }}" autocomplete="surname" autofocus>
                @error('surname')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                    </span>
                @enderror
            </div>
          </div>
          <!------------>
          <div class="form-group row">
              <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Имя') }}</label>
              <div class="col-md-6">
                  <input id="name" type="text" placeholder="Имя" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" autocomplete="name" autofocus>
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                      </span>
                  @enderror
              </div>
          </div>
          <!------------>
          <div class="form-group row">
              <label for="patronymic" class="col-md-2 col-form-label text-md-right">{{ __('Отчество') }}</label>
              <div class="col-md-6">
                  <input id="patronymic" placeholder="Отчество (не обязательно)" type="text" class="form-control @error('patronymic') is-invalid @enderror" name="patronymic" value="{{  $user->patronymic }}" autocomplete="patronymic" autofocus>
                  @error('patronymic')
                    <span class="invalid-feedback" role="alert">
                      <span>{{ 'Длинна поля не должна превышать 255 символов' }}</span>
                    </span>
                 @enderror
              </div>
          </div>
          <!------------>
          <div class="form-group row">
              <label for="date_of_birth" class="col-md-2 col-form-label text-md-right">{{ __('Дата рождения') }}</label>
               <div class="col-md-6">
                  <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ $user->date_of_birth }}" autocomplete="date_of_birth">

                  @error('date_of_birth')
                    <span class="invalid-feedback" role="alert">
                      <span>Дата должна быть записана так ( '10.08.2019' )</span>
                    </span>
                  @enderror
              </div>
          </div>
          <!------------>
          <div class="form-group row">
            <label for="phone_number" class="col-md-2 col-form-label text-md-right">{{ __('Номер телефона') }}</label>
            <div class="col-md-6">
              <input id="phone_number" type="text" placeholder="0938660771" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $user->phone_number }}" autocomplete="phone_number">

              @error('phone_number')
                  <span class="invalid-feedback" role="alert">
                      <span>{{ 'Номер может состоять только из цифр' }}</span>
                  </span>
               @enderror
            </div>
          </div>
          <!------------>
          
          <!------------>
          <div class="form-group row">
            <label for="level_and_language" class="col-md-2 col-form-label text-md-right">{{ __('Языки и уровень') }}</label>

            <div class="col-md-6">
              <input id="level_and_language" placeholder="Английский А1, Немецкий A1..." type="text" class="form-control @error('level_and_language') is-invalid @enderror" name="level_and_language" value="{{  $user->level_and_language }}" autocomplete="level_and_language">

              @error('level_and_language')
              <span class="invalid-feedback" role="alert">
                  <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 500 символов' }}</span>
              </span>
              @enderror
            </div>
          </div>
          <!------------>
          <div class="form-group row">
            <label for="role" class="col-md-2 col-form-label text-md-right">{{ __('Роль') }}</label>
            <div class="col-md-6">
              <select id="role" class="form-control select2 @error('role') is-invalid @enderror"  name="role" autofocus autocomplete="role">
                <option>{{ $user->role }}</option>
                <option>dismissed</option>
                <option>teacher</option>
                <option>admin</option>
                @if(Auth::user()->role == 'owner')
                <option>owner</option>
                @endif
              </select>

                @error('role')
                  <span class="invalid-feedback" role="alert">
                    <span>{{ 'Запишите в поле одну из этих ролей: admin , teacher, owner, dismissed' }}</span>
                  </span>
                @enderror
            </div>
          </div>
          <!------------>
          <div class="form-group row">
            <label for="teaches" class="col-md-2 col-form-label text-md-right">{{ __('Будет ли преподавать?') }}</label>
            <div class="col-md-6">
              <select id="teaches" class="form-control select2 @error('teaches') is-invalid @enderror"  name="teaches" autofocus autocomplete="teaches">
                <option value="{{ $user->teaches }}">{{ $user->teaches }}</option>
                <option value="да">да</option>
                <option value="нет">нет</option>
              </select>

              @error('teaches')
                <span class="invalid-feedback" role="alert">
                  <span>{{ 'Запишите в поле одну из этих ролей: admin , teacher, owner, dismissed' }}</span>
                </span>
              @enderror
            </div>
          </div>
          <!------------>
          <div class="form-group row">
            <label for="employment_date" class="col-md-2 col-form-label text-md-right">{{ __('Дата приёма на работу') }}</label>
            <div class="col-md-6">
              <input id="employment_date" type="date" class="form-control @error('employment_date') is-invalid @enderror" name="employment_date" value="{{  $user->employment_date }}" autocomplete="employment_date">
                @error('employment_date')
                  <span class="invalid-feedback" role="alert">
                    <span>Дата должна быть записана так ( '10.08.2019' )</span>
                  </span>
                @enderror
            </div>
          </div>
          <!------------>
          <div class="form-group row">
            <label for="date_of_dismissal" class="col-md-2 col-form-label text-md-right">{{ __('Дата увольнения') }}</label>
            <div class="col-md-6">
              <input id="date_of_dismissal" type="date" class="form-control @error('date_of_dismissal') is-invalid @enderror" name="date_of_dismissal" value="{{  $user->date_of_dismissal }}" autocomplete="date_of_dismissal">
                @error('date_of_dismissal')
                  <span class="invalid-feedback" role="alert">
                    <span>Дата должна быть записана так ( '10.08.2019' )</span>
                  </span>
                @enderror
            </div>
          </div>
          <!------------>
          <div class="form-group row">
            <label for="comment" class="col-md-2 col-form-label text-md-right">{{ __('Комментарий') }}</label>
              <div class="col-md-6">
                <input id="comment" type="text" placeholder="Комментарий (не обязательно)" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{  $user->comment }}" autocomplete="comment">

                @error('comment')
                  <span class="invalid-feedback" role="alert">
                      <span>{{ 'Длинна комментария не должна превышать 1000 символов' }}</span>
                  </span>
                @enderror
              </div>
          </div>
          <!------------>
          
          <!------------>
          <div class="form-group row mb-0">
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
  <!-- /.content-wrapper -->

@endsection