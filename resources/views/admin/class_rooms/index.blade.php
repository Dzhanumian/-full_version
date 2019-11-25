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
                <a href="{{route('class_room.create')}}" class="btn btn-success">Добавить кабинет</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID кабинета</th>
                  <th>ID филиала</th>
                  <th>Название филиала</th>
                  <th>Название кабинета</th>
                  <th>Количество мест</th>

                  <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rooms as $room)
                  <tr>
                    <td>{{$room->id}}</td>
                    <td>{{$room->subsidiaries_id}}</td>
                    <td>{{$room->subsidiaries_name}}</td>
                    <td>{{$room->room_name}}</td>
                    <td>{{$room->seating_capacity}}</td>

                    <td><a href="{{route('class_room.edit', $room->id)}}" class="fa fa-pencil" target="_blank"></a>
                    <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('class_room.destroy', $room->id)}}" method="post">
                      <input type="hidden" name="_method" value="DELETE">
                      {{csrf_field()}}
                      <button type="submit" class="delete">
                        <i class="fa fa-remove"></i>
                      </button>
                    </form>
                  </tr>
                  </tr>
                @endforeach

                <tfoot>
                  <tr>
                    <td colspan="3">
                      <ul class="pagination pull-right">
                        {{ $rooms->links() }}
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