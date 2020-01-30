@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <a href="{{route('students.create')}}" class="btn btn-success">Добавить учащегося</a>
                @if(Auth::user()->role !=  'teacher')
                <a href="{{route('student.excel')}}" class="btn btn-primary">Экспорт в Excel</a>
                <a href="{{route('debtor_search')}}" class="btn btn-danger">Отобразить должников</a>
                @endif
              </div>
              

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Фамилия</th>
                  <th>Имя</th>
                  <th>Номер телефона</th>
                  <th>Статус</th>
                  <th style="width: 100px">Группы</th>
                  <th style="width: 40px">Дата регистрации</th>
                  <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @for($i = 0; $i < $limit; $i++)
                  <tr style="background: {{ $collection[$i]['7'] }};">
                    <td>{{ $collection[$i]['1'] }}</td>
                    <td>{{ $collection[$i]['2'] }}</td>
                    <td>{{ $collection[$i]['3'] }}</td>
                    <td>{{ $collection[$i]['4'] }}</td>
                    <td>{{ $collection[$i]['6'] }}</td> 
                    <td>{{ $collection[$i]['5'] }}</td>
                    <td> 
                    @if($collection[$i]['7'] != null) + 
                    <a href="{{route('info', $collection[$i]['0'] )}}" class="btn btn-info" target="_blank" style="margin-left: 12px">Подробнее</a>
                    @endif 
                    @if($collection[$i]['7'] == null) - 
                    <a href="{{route('info', $collection[$i]['0'] )}}" class="btn btn-info" target="_blank" style="margin-left: 15px">Подробнее</a>
                    @endif
                    </td>
                  </tr>
                @endfor
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <style>
    div .row div .col-sm-6{
      float: right;
    }
    .fl{
      float: left;
    }
  </style>
@endsection