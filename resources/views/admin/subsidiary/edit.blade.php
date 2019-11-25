@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box">
        <p><strong style="font-size: 20px">Редактирование филиала</strong></p>
        <div class="box-body">
          <form method="POST" action="{{route('subsidiary.update', $sub->id)}}">
          @method('PATCH')
          @csrf
          <!------------>
          <div class="form-group row">
            <label for="subs_name" class="col-md-2 col-form-label text-md-right">{{ __('Название филии') }}</label>
            <div class="col-md-6">
                <input id="subs_name" type="text" class="form-control @error('subs_name') is-invalid @enderror" name="subs_name"  placeholder="Название" autocomplete="subs_name" autofocus value="{{ $sub->name }}">
                @error('subs_name')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                    </span>
                @enderror
            </div>
          </div>
          <!------------>
          <div class="form-group row">
            <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('Адрес') }}</label>
            <div class="col-md-6">
                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"  placeholder="Название" autocomplete="address" autofocus value="{{ $sub->adress }}">
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 500 символов' }}</span>
                    </span>
                @enderror
            </div>
          </div>
          <!------------>
          <div class="form-group row">
            <label for="city" class="col-md-2 col-form-label text-md-right">{{ __('Город') }}</label>
            <div class="col-md-6">
                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city"  value="{{ $sub->city }}" autocomplete="city" autofocus>
                @error('city')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                    </span>
                @enderror
            </div>
          </div>
          <!------------>

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
