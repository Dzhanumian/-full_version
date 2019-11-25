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
                <a href="{{route('course.create')}}" class="btn btn-success">Добавить курс</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Название</th>
                  <th>Категория</th>
                  <th>Уровень</th>
                  <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach($course as $cours)
                  <tr>
                    <td>{{$cours->id}}</td>
                    <td>{{$cours->course_name}}</td>
                    <td>{{$cours->category}}</td>
                    <td>{{$cours->level}}</td>

                    <td><a href="{{route('course.edit', $cours->id)}}" class="fa fa-pencil" target="_blank"></a>

                    <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('course.destroy', $cours->id)}}" method="post">
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
                        {{ $course->links() }}
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