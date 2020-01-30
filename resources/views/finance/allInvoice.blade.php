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
                <a href="/dashboard/invoice/payer_students" class="btn btn-success">Cтуденты</a><br><br>
              </div>
              
              <table id="example1" class="table table-bordered table-striped" style="font-size: 16px;">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Студент</th>
                  <th>Группа</th>
                  <th>Сумма</th>
                  <th>Месяц</th>
                  <th>Создано</th>
                  <th>Обновлено</th>
                  <th>Урок/Действие</th>
                </tr>
                
                </thead>
                <tbody>
                @foreach($allInvoice as $invoice)
                  <tr>
                             
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->student_surname.' '.$invoice->student_name }}</td>
                    <td>{{ $invoice->group_name }}</td>
                    <td>{{ $invoice->invoice }}</td>
                    <td>{{ $invoice->month }}</td>
                    <td>{{ $invoice->created_at }}</td>
                    <td>{{ $invoice->updated_at }}</td>
                    
                    
                    
 
                    <td>
                      <a href="" target="_blank" class="fa fa-pencil"></a>

                      <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="" method="post">
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