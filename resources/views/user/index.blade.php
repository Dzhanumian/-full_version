@extends('layouts.app')

@section('content')

<div class="container">

  <a href="{{ route('register') }}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i>Добавить пользователя</a>
  <table class="table table-striped">
    <thead>
      <th>Id</th>
      <th>Фамилия</th>
      <th>Имя</th>
      <th>Отчество</th>
      <th>Роль</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($users as $user)
        <tr>
          <td>{{$user->id}}</td>
          <td>{{$user->surname}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->patronymic}}</td>
          <td>{{$user->role}}</td>
          <td class="text-right">
            <form onsubmit="if(confirm('Удалить?')){ return true } else { return false }" action="/" method="post">
              <input type="hidden" name="_method" value="DELETE">
              {{csrf_field()}}

              <a class="btn btn-default" href="/"><i class="fa fa-edit"></i></a>

              <button type="submit" class="btn"><i class="fa fa-trash o"></i></button>
            </form>
            
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
        </tr>
      @endforelse
    </tbody>
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

@endsection