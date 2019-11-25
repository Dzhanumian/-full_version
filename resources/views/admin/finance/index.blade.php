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
              <div class="form-group" style="font-size: 20px;">
                <a href="{{route('finance.create')}}" class="btn btn-success">Добавить</a><br><br>
              </div>
              <form method="POST" action="{{route('users.excel')}}" style="margin-top: -30px;">
                @csrf
                <div style="display: inline-block;">
                  <span style="color: red">C  </span>
                  <input type="date" name="from" required>
                </div>

                <div style="display: inline-block;">
                  <span style="color: red">По </span>
                  <input type="date" name="before" required>
                </div>
                <input type="hidden" name="finance" value="true">
                <button class="btn btn-info">Excel</button>
              </form>
              <table id="example1" class="table table-bordered table-striped" style="font-size: 16px;">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Студент</th>
                  <th>Группа</th>
                  <th>Сумма</th>
                  <th>За</th>
                  <th>Создано</th>
                  <th>Обновлено</th>
                  <th>Урок/Действие</th>
                </tr>
                
                </thead>
                <tbody>
                @foreach($finance as $fin)
                  <tr>
                                        
                    <td>{{ $fin->id }}</td>
                    <td>{{ $fin->initials }}</td>
                    <td>{{ $fin->group_name }}</td>
                    <td>{{ $fin->invoice }}</td>
                    <td>{{ $fin->month }}</td>
                    <td>@php echo substr($fin->created_at, 0,10); @endphp</td>
                    <td>@php echo substr($fin->updated_at, 0,10); @endphp</td>
 
                    <td>
                      <a href="{{route('finance.edit', $fin->id)}}" target="_blank" class="fa fa-pencil"></a>

                      <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('finance.destroy', $fin->id)}}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        {{csrf_field()}}
                        <button type="submit" class="delete">
                          <i class="fa fa-remove"></i>
                        </button>
                      </form>
                    </td>
                  
                  </tr>
                @endforeach

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