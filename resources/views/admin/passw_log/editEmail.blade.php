@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small>приятные слова..</small>
      </h1>
    </section>

    <section class="content">
      <div class="box">
        <div class="box-body">
          <form method="POST" action="{{route('email.update', $user->id)}}">
          @method('PATCH')
          @csrf

          <div class="form-group row">
            <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('Электронный адрес') }}</label>

            <div class="col-md-6">
              <input id="email" type="text" placeholder="test@test.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email">

              @error('email')
                <span class="invalid-feedback" role="alert">
                  <span>Длинна почты не должна превышать 500 символов, в адрессе должен быть символ '@' </span>
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