@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box">
        <p><strong style="font-size: 20px">Добавление студентов</strong></p>
        <div class="box-body">
          <form method="POST" action="{{route('group_students.store')}}">
          @csrf
          <input type="hidden" name="group_id" value="{{ $id_g }}">
          <!------------>
          <div class="form-group row">
            <label for="studs" class="col-md-2 col-form-label text-md-right">{{ __('Студенты') }}</label>
            <div class="col-md-6">
              <select class="form-control select2 @error('studs') is-invalid @enderror"  name="studs[]" autofocus autocomplete="studs" multiple required>
                  
              @foreach($studs_g as $stud)
                
                <option value="{{ $stud->id }}">{{$stud->surname .' '. $stud->name}}</option>

              @endforeach
              </select>
                
              @error('studs')
                  <span class="invalid-feedback" role="alert">
                      <span>{{ '.' }}</span>
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

