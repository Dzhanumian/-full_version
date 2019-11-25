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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Пользователь</th>
                  <th>Действие</th>
                  <th>Запись о</th>
                  <th>Дата/время</th>

                </tr>
                </thead>
                <tbody>
                @foreach($logs as $log)
                  <tr>
                    <td>{{$log->id}}</td>
                    <td>{{$log->user_name}}</td>
                    <td>{{$log->event}}</td>
                    <td>{{$log->user_name_event}}</td>
                    <td>{{$log->created_at }}</td>
                  </tr>
                @endforeach

                <tfoot>
                  <tr>
                    <td colspan="3">
                      <ul class="pagination pull-right">
                        {{ $logs->links() }}
                      </ul>
                    </td>
                  </tr>
                </tfoot>
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