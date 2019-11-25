@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box" style="position: relative;">
        @foreach($group_stud as $groups)
            <div class="box-header">

              <!-- @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success')[0] !!}</li>
                    </ul>
                </div>
              @endif -->
              @if (\Session::has('failure'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{!! \Session::get('failure')[0] !!}</li>
                    </ul>
                </div>
              @endif

              <div class="form-group">
                <button id="close" class="btn btn-success">Закрыть</button>
                <br><br>
                <a href="{{route('group.edit', $groups->id)}}" target="_blank" class="btn btn-primary">Редактировать</a>
                
                <form style="display: inline-block;" onsubmit="if(confirm('Вы точно хотите удалить все уроки для этой группы ?')){ return true } else { return false }" action="{{route('automatic.destroy', $groups->id)}}" method="post">
                  <input type="hidden" name="_method" value="DELETE">
                  {{csrf_field()}}
                  <button type="submit" class="btn btn-warning">
                    Удалить все уроки
                  </button>
                </form>

                <form style="display: inline-block;" onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('group.destroy', $groups->id)}}" method="post">
                  <input type="hidden" name="_method" value="DELETE">
                  {{csrf_field()}}
                  <button type="submit" class="btn btn-danger">
                    Удалить группу
                  </button>
                </form>

              </div>
              
              <p>Группа: <strong>{{ $groups->group_name }} <a href="{{route('group.edit', $groups->id)}}" class="fa fa-pencil"></a></strong></p>
              <p>Тип: <strong>{{ $groups->type }}</strong></p>
              <p>Преподаватель: <strong>{{ $groups->teacher_name }}</strong></p>
              <p>Статус <strong>{{ $groups->status }}</p>
              @php $group_id = $groups->id; @endphp
            </div>
              
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <a href="{{route('group_students.show', $groups->id)}}" class="btn btn-success">Добавить студентов в группу</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Имя</th>
                  <th>Фамилия</th>
                  <th>Статус</th>

                  <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                  
                    @foreach($groups['student'] as $gr)

                    <tr>
                      <td><a style="display: block;" href="{{route('info', $gr->id)}}" target="_blank">{{$gr->id}}</a></td>
                      <td>{{$gr->name}}</td>
                      <td>{{$gr->surname}}</td>
                      <td>{{$gr->pivot->status_s}}</td>
                    
                      <td>

                      <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('group_students.destroy', $gr->pivot->id.' '.$groups->id)}}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        
                        {{csrf_field()}}
                        <button type="submit" class="delete">
                          <i class="fa fa-remove"></i>
                        </button>
                      </form>
                      <td><a href="{{route('graduation', $gr->pivot->id)}}" class="fa fa-graduation-cap"></a>
                      </td>
                    </tr>

                    @endforeach                 
                  @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script>
      
      $(function(){
          $('#close').bind('click', function(){
            window.close();
          });
      });

    </script>
  <!-- /.content-wrapper -->
@endsection