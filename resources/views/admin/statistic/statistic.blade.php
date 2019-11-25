@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box">
        <div class="box-body">
          <!----------------------------------------------------->
         	<p style="font-size: 20px">Студенты</p>
         	<table id="stud" class="table table-bordered table-striped">
                <thead>
                <tr>
                 	<th>Всего</th>
                 	<th>Новых</th>
                 	<th>Активных</th>
                 	<th>Выпустившихся (всего)</th>
                 	<th>Выпустившихся (в этом месяце)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                	<td>{{ $arr_stud[0] }}</td>
                    <td>{{ $arr_stud[1] }}</td>
                    <td>{{ $arr_stud[2] }}</td>
                    <td>{{ $arr_stud[3] }}</td>
                    <td>{{ $arr_stud[4] }}</td>
                </tr>               
            </table>
            <br><br>
            <p style="font-size: 20px">Уроки</p>
         	<table id="stud" class="table table-bordered table-striped">
                <thead>
                <tr>
                	<th></th>
                	<th>Всего</th>
                	<th>Запланированных</th>
                	<th>Проведёных</th>
                	<th>Отмененных</th>
                	<th>Поздно отмененных</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                	<td>За всё время</td>
                	<td>{{ $arr_stat[5] }}</td>
                    <td>{{ $arr_stat[6] }}</td>
                    <td>{{ $arr_stat[7] }}</td>
                    <td>{{ $arr_stat[8] }}</td>
                    <td>{{ $arr_stat[9] }}</td>
                </tr>
                <tr>
                	<td>В этом месяце</td>
                	<td>{{ $arr_stat[0] }}</td>
                    <td>{{ $arr_stat[1] }}</td>
                    <td>{{ $arr_stat[2] }}</td>
                    <td>{{ $arr_stat[3] }}</td>
                    <td>{{ $arr_stat[4] }}</td>
                </tr>               
            </table>
            <br><br>
            <p style="font-size: 20px">Финансы</p>
         	<table id="stud" class="table table-bordered table-striped">
                <thead>
                <tr>
                 	<th>Ожидаймая прибыль</th>
                 	<th>Текущая прибыль</th>
                 	<th>Разница</th>
                 	<th>Задолжности</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                	<td>{{ $arr_finanse[0] }}</td>
                    <td>{{ $arr_finanse[1] }}</td>
                    <td>{{ $arr_finanse[2] }}</td>
                    <td>{{ $arr_finanse[3] }}</td>
                </tr>               
            </table>
        </div>
      </div>  
    </section>
    <style>
      .invalid-feedback
      {
        color: red;
      };
    </style>
  </div>
@endsection

