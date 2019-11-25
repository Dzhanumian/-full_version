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
                <a href="{{ route('register') }}" class="btn btn-success">Добавить пользователя</a>
              </div>

              <form method="POST" action="{{route('users.excel')}}">
                @csrf

                <div style="display: inline-block;">
                  <span style="color: red">C  </span>
                  <input type="date" name="from" required>
                </div>

                <div style="display: inline-block;">
                  <span style="color: red">По </span>
                  <input type="date" name="before" required>
                </div>
                <input type="hidden" name="finance" value="false">
                <button class="btn btn-info">Excel</button>
              </form>
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Фамилия</th>
                  <th>Имя</th>
                  <th>Отчество</th>
                  <th>Роль</th>
                  <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                  <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->surname}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->patronymic}}</td>
                    <td>{{$user->role}}</td>
                    
                    <td>
                      <a href="{{route('users.edit', $user->id)}}" target="_blank" class="fa fa-pencil"></a>
                      <a href="{{route('password.edit', $user->id)}}" target="_blank" class="fa fa-key"></a>
                      <a href="{{route('email.edit', $user->id)}}" target="_blank" class="fa fa-lock"></a>
                            
                    <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('users.destroy', $user->id)}}" method="post">
                      <input type="hidden" name="_method" value="DELETE">
                      {{csrf_field()}}
                      <button type="submit" class="delete">
                        <i class="fa fa-remove"></i>
                      </button>     
                    </form>
                  </tr>
                @endforeach

                <tfoot>
                  <tr>
                    <td colspan="3">
                      <ul class="pagination pull-right">
                        {{ $users->links() }}
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