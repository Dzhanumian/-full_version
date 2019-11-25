@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <section class="content">
      <div class="box">
        <p><strong style="font-size: 20px; padding: 30px 10px">Редактирование баланса</strong></p>
        <div class="box-body">
          <form method="POST" action="{{route('account.update', $Account->id)}}">
          @method('PATCH')
          @csrf

          <!------------>
          <div class="form-group row">
            <label for="balans" class="col-md-2 col-form-label text-md-right">{{ __('Баланс') }}</label>
            <div class="col-md-6">
               <input id="balans" type="text" class="form-control @error('balans') is-invalid @enderror" name="balans"  placeholder="Название кабинета" autocomplete="balans" autofocus value="{{ $Account->account }}">
                
              @error('balans')
                  <span class="invalid-feedback" role="alert">
                      <span>{{ 'Используйте только цифры' }}</span>
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
