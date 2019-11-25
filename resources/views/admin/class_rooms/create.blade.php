@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box">
        <p><strong style="font-size: 20px">Добавление кабинета</strong></p>
        <div class="box-body">
          <form method="POST" action="{{route('class_room.store')}}">
          @csrf

          <!------------>
          <div class="form-group row">
            <label for="subsidiaries_name" class="col-md-2 col-form-label text-md-right">{{ __('Название филиала') }}</label>
            <div class="col-md-6">
              <select class="form-control select2 @error('subsidiaries_name') is-invalid @enderror"  name="subsidiaries_name" autofocus autocomplete="subsidiaries_name">
              @foreach($nameSubs as $nameSub)
                <option>{{ $nameSub->name }}</option>
              @endforeach
              </select>
                
              @error('subsidiaries_name')
                  <span class="invalid-feedback" role="alert">
                      <span>{{ 'Филия не найдена' }}</span>
                  </span>
              @enderror
            </div>
          </div>
          <!------------>
          <div class="form-group row">
            <label for="room_name" class="col-md-2 col-form-label text-md-right">{{ __('Название кабинета') }}</label>
            <div class="col-md-6">
                <input id="room_name" type="text" class="form-control @error('room_name') is-invalid @enderror" name="room_name"  placeholder="Название кабинета" autocomplete="room_name" autofocus value="{{ old('room_name') }}">
                @error('room_name')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                    </span>
                @enderror
            </div>
          </div>
          <!------------>
          <div class="form-group row">
            <label for="seating_capacity" class="col-md-2 col-form-label text-md-right">{{ __('Количество мест') }}</label>
            <div class="col-md-6">
                <input id="seating_capacity" type="text" class="form-control @error('seating_capacity') is-invalid @enderror" name="seating_capacity"  placeholder="Количество мест" autocomplete="seating_capacity" autofocus value="{{ old('seating_capacity') }}">
                @error('seating_capacity')
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
