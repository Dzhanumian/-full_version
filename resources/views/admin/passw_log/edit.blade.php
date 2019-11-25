@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box">
        <div class="box-body">
          <form method="POST" action="{{route('password.update', $user->id)}}">
          @method('PATCH')
          @csrf

          <div class="form-group row">
            <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Пароль') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" placeholder="Введите новый пароль" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

              @error('password')
                <span class="invalid-feedback" role="alert">
                    <span>Пароль не должен быть короче 10 символов</span>
                </span>
              @enderror
            </div>
          </div>

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