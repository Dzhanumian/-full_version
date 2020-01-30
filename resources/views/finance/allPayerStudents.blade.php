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
              <table id="example1" class="table table-bordered table-striped" style="font-size: 16px;">
                <thead>
                <tr>
                  <th>Студент</th>
                </tr>
                
                </thead>
                <tbody>
                @foreach($allPayerStudents as $payerStudent)
                  <tr> 
                    <td><a href="{{route('invoice.student', $payerStudent->id)}}" target="_blank" style="color: black">{{ $payerStudent->patronymic.' '.$payerStudent->surname.' '.$payerStudent->name }}</a></td>
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