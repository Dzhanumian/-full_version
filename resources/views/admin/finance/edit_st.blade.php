@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <section class="content">
      <div class="box">
        <p><strong style="font-size: 20px">Редактирование счёта</strong></p>
        <div class="box-body">
          <form method="POST" action="{{route('finance.update', $finance->id)}}">
          @method('PATCH')
          @csrf

            <div class="form-group row">
              <label for="account_date" class="col-md-2 col-form-label text-md-right">{{ __('Выберете месяц') }}</label>
              <div class="col-md-4">

                  <input id="account_date" type="date" class="form-control @error('account_date') is-invalid @enderror" name="account_date" value="{{ $finance->month }}"  autocomplete="account_date" autofocus required>

              </div>
            </div>
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="account" class="col-md-2 col-form-label text-md-right">Cумма оплаты</label>
              <div class="col-md-4">

                  <input id="account" type="text" class="form-control @error('account') is-invalid @enderror" name="account" autocomplete="account" autofocus required value="{{ $finance->invoice }}">

              </div>
            </div>
            <!----------------------------------------------------->
            <input id="how_many" type="hidden" name="how_many" value="{{ $finance->quantity }}">
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="tarif" class="col-md-2 col-form-label text-md-right">Тариф</label>
              <div class="col-md-4">

                  <input id="tarif" value="{{ $finance->tarif }}" type="text" class="form-control @error('tarif') is-invalid @enderror" name="tarif" autocomplete="tarif" autofocus required>

              </div>
            </div>
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="payment_type" class="col-md-2 col-form-label text-md-right">Тип оплаты</label>
              <div class="col-md-4">
                <select class="form-control select2"  name="payment_type" autofocus autocomplete required> 
                  <option>{{ $finance->type }}</option>
                  <option>Наличными</option>
                  <option>Банковская карта</option>
                  <option>Банковский расчетный счет</option>
                  <option>В долг</option>
                  <option>Подарок</option>
                </select>
              </div>
            </div>
            <!----------------------------------------------------->
            <div class="form-group row" style="margin-top: 30px">
              <label for="comment" class="col-md-2 col-form-label text-md-right">Комментарий</label>
              <div class="col-md-4">
                  <textarea id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment"  autocomplete="comment" autofocus>{{ $finance->comment }}</textarea>
              </div>
            </div>
          <!----------------------------------------------------->

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
