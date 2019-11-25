@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box">
        <div style="padding: 10px 20px;">
          <a href="/dashboard/finance"><button class="btn-success" style="width: 80px; height: 35px">Назад</button></a>
        </div>
        <p style="margin-left: 20px;"><strong style="font-size: 20px">Счёт для</strong></p>
        <div class="box-body">
          <!----------------------------------------------------->
          <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Фамилия</th>
                  <th>Имя</th>
                  <th>Отчество</th>
                  <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach($student as $stud)
                  <tr>
                    <td>{{$stud->id}}</td>
                    <td>{{$stud->surname}}</td>
                    <td>{{$stud->name}}</td>
                    <td>{{$stud->patronymic}}</td>

                    <td><a href="{{route('finance.show', $stud->id)}}" target="_blank" class="fa fa-calculator"></a>
                  </tr>
                @endforeach

                
              </table>

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

