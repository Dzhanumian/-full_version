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
                <a href="{{route('group.create')}}" class="btn btn-success">Добавить группу</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Имя преподавалетя</th>
                  <th>Название группы</th>
                  <th>Курс</th>
                  <th>Тип</th>
                  <th>Статус</th>
                  <th style="max-width: 80px;">Дни</th>
                  <th>Мест</th>
                  <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @for($i = 0; $i < $limit; $i++)
                  <tr>
                    <td>{{ $collection[$i]['1'] }}</td>
                    <td>{{ $collection[$i]['2'] }}</td>
                    <td>{{ $collection[$i]['3'] }}</td>
                    <td>{{ $collection[$i]['4'] }}</td>
                    <td>{{ $collection[$i]['6'] }}</td>
                    <td>{!! $collection[$i]['8'] !!}</td>
                    <td>{{ $collection[$i]['7'] }}</td>
                    <td>
                      <a style="margin-left: 10px" class="btn btn-info" target="_blank" href="{{route('group_students.edit', $collection[$i]['0'])}}">Подробнее</a>
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
  <!-- /.content-wrapper -->
@endsection