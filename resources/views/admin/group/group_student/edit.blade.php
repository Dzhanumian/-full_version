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
          <form method="POST" action="{{route('group_students.update', $group_studs->id)}}">
          @method('PATCH')   
          @csrf
          <!------------>
          <div class="form-group row">
            <label for="group_studs" class="col-md-2 col-form-label text-md-right">{{ __('Статус') }}</label>
            <div class="col-md-6">
              <select class="form-control select2 @error('group_studs') is-invalid @enderror"  name="group_studs" autofocus autocomplete="group_studs">


                <option>{{ $group_studs->status_s }}</option>
                <option>учится</option>
                <option>выпустился</option>
                <option>временно не учится</option>
                <option>забросил обучени</option>


              </select>
                
              @error('group_studs')
                  <span class="invalid-feedback" role="alert">
                      <span>{{ 'Преподаватели не найдены' }}</span>
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
