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
            <div style="margin-left: 10px;">
              <a href="/dashboard/lesson" class="btn btn-primary">по дням</a>
              <a href="/dashboard/lesson_week" class="btn btn-primary">по неделям</a>
              <a href="/dashboard/lesson_month" class="btn btn-primary">по месяцам</a>
            </div>
            <div class="box-body">
              <div style="font-size: 20px;">
                <a href="{{ url('dashboard/lesson_one_day/'.$yesterday)}}" style="margin-left: 35%;">{{ $yesterday }}</a>
                <strong style="margin-left: 20px;">{{ $date }}</strong>

                <a href="{{ url('dashboard/lesson_one_day/'.$tomorrow)}}" style="margin-left: 20px;">{{ $tomorrow }}</a>
              </div>
              <div class="form-group" style="font-size: 20px;">
                @if(Auth::user()->role != 'teacher')
                <a href="{{route('lesson.create')}}" class="btn btn-success">Добавить 1 занятие</a>
                <a href="{{route('automatic.create')}}" class="btn btn-success">Добавить несколько занятий</a>
                <a href="{{route('lesson.worked.create')}}" class="btn btn-success">Добавить отработку</a>
                @endif
              </div>
              <table id="example1" class="table table-bordered table-striped" style="font-size: 20px;">
               
                 <thead>
                <tr>
                  <th>Занятия на {{$date}}</th>
                  <th>Время</th>                
                  <th>Статус</th>
                  <th>Урок/Действие</th>
                </tr>
                
                </thead>
                <tbody>
                @foreach($lessons as $les)
                  <tr style="background: {{$les->color}};">
                                        
                    <td><span style="opacity: 0; float: right;">{{$les->subsidiaries}}</span> {!! $les->data_lesson !!}</td>
                    <td>{{$les->lesson_time}} - {{$les->lesson_time_end}}</td>
                    <td>{{$les->status}}</td>
                    <td><span>Урок № {{ $les->id }}</span><br>
                      @if(Auth::user()->role != 'teacher')
                      <a href="{{route('lesson.edit', $les->id)}}" class="fa fa-pencil"></a>

                      <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="{{route('lesson.destroy', $les->id)}}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        {{csrf_field()}}
                        <button type="submit" class="delete">
                          <i class="fa fa-remove"></i>
                        </button>
                      </form>
                      @endif
                      <a href="{{route('presence.show', $les->id)}}" target="_blank" style="color: #2F4F4F"><button style="background: {{$les->color}}; width: 150px; height: 30px; margin-left: 50px">Об уроке</button>
                      </a>
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