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
                <a href="{{route('subsidiary.create')}}" class="btn btn-success">Добавить филиал</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Название</th>
                  <th>Адрес</th>
                  <th>Город</th>
                  <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subs as $sub)
                  <tr>
                    <td>{{$sub->id}}</td>
                    <td>{{$sub->name}}</td>
                    <td>{{$sub->adress}}</td>
                    <td>{{$sub->city}}</td>

                    <td><a target="_blank" href="{{route('subsidiary.edit', $sub->id)}}" class="fa fa-pencil"></a>

                    

                    <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('subsidiary.destroy', $sub->id)}}" method="post">
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
                        {{ $subs->links() }}
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