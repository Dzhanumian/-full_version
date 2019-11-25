@extends('admin.layout')

@section('content')
<!------------------------------>
@if($ind_1 == 1)
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box">
        <div style="padding: 10px 20px;">
          <a href="/dashboard/finance/create"><button class="btn-success" style="width: 80px; height: 35px">Назад</button></a>
        </div>
        <div style="padding: 30px 80px">
          <p>
            <strong style="font-size: 20px">Оплата долга</strong>
          </p>

          <p style="font-size: 18px;">
            <span>Баланс студента: {{ $Account->account }} гр </span>
          </p>
          <p style="font-size: 18px;">
            <span>Текущий тариф группы: {{ $Group->rate }} гр занятие</span>
          </p>
          <br>

          <p style="font-size: 18px;">
            <span>Ещё не было оплаты для этой группы<br> или последний счёт был подарочный</span>
          </p>
        </div>
        <div class="box-body">

            <form id="form" method="POST" action="{{route('debt.store')}}">
            @csrf

            <input value="0" type="hidden" form="form" name="balance">
            <input type="hidden" name="id" value="{{ $debt->id }}">
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="student" class="col-md-2 col-form-label text-md-right">Счёт для</label>
              <div class="col-md-4">

                  <input id="student" type="text" class="form-control @error('student') is-invalid @enderror" name="student" value="{{ $Student->surname.' '.$Student->name }}"  autocomplete="student" autofocus required disabled>

                  @error('student')
                      <span class="invalid-feedback" role="alert">
                          <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                      </span>
                  @enderror
              </div>
            </div>
            <!----------------------------------------------------->
            <input type="hidden" name="stud_name" value="{{ $Student->surname.' '.$Student->name }}">
            <!----------------------------------------------------->
            <input type="hidden" name="stud_id" value="{{ $Student->id }}">
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="group" class="col-md-2 col-form-label text-md-right">Счёт для группы</label>
              <div class="col-md-4">

                  <input id="group" type="text" class="form-control @error('group') is-invalid @enderror" name="group" value="{{ $Group->group_name }}"  autocomplete="group" autofocus required disabled>

                  @error('group')
                      <span class="invalid-feedback" role="alert">
                          <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                      </span>
                  @enderror
              </div>
            </div>
            <!----------------------------------------------------->
            <input type="hidden" name="group_id" value="{{ $Group->id }}">
            <!----------------------------------------------------->
            <input type="hidden" name="type_rec" value="type2">
            <!----------------------------------------------------->

            <div class="form-group row">
              <label for="account_date" class="col-md-2 col-form-label text-md-right">{{ __('Выберете месяц') }}</label>
              <div class="col-md-4">

                  <input id="account_date" type="date" class="form-control" name="account_date" value="{{ $debt->month }}"  autocomplete="account_date" autofocus disabled>
              </div>
            </div>
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="account" class="col-md-2 col-form-label text-md-right">Cумма оплаты</label>
              <div class="col-md-4">

                  <input id="account" type="text" class="form-control" name="account" autocomplete="account" autofocus required value="{{ $debt->invoice }}">

                  @error('account')
                      <span class="invalid-feedback" role="alert">
                          <span>{{ 'Поле должно состоять из цифр' }}</span>
                      </span>
                  @enderror
              </div>
            </div>
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="how_many" class="col-md-2 col-form-label text-md-right">Планируется уроков</label>
              <div class="col-md-4">

                  <input id="how_many" type="text" class="form-control" name="how_many" autocomplete="how_many" autofocus required value="{{ $debt->quantity }}">
              </div>
            </div>
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="tarif" class="col-md-2 col-form-label text-md-right">Тариф</label>
              <div class="col-md-4">

                  <input id="tarif" value="{{ $debt->tarif }}" type="text" class="form-control @error('tarif') is-invalid @enderror" name="tarif" autocomplete="tarif" autofocus required placeholder="Тариф за месяц">

                  @error('tarif')
                      <span class="invalid-feedback" role="alert">
                          <span>{{ 'Поле должно состоять из цифр' }}</span>
                      </span>
                  @enderror
              </div>
             </div>
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="payment_type" class="col-md-2 col-form-label text-md-right">Тип оплаты</label>
              <div class="col-md-4">
                <select class="form-control select2"  name="payment_type" autofocus autocomplete required> 
                  <option checked value="В долг">Выплата долга</option>
                </select>
              </div>
            </div>
            <!----------------------------------------------------->
            <div class="form-group row" style="margin-top: 30px">
              <label for="comment" class="col-md-2 col-form-label text-md-right">Комментарий</label>
              <div class="col-md-4">
                  <textarea id="comment" type="text" class="form-control name="comment"  autocomplete="comment" autofocus></textarea>
              </div>
            </div>
          <!----------------------------------------------------->

          <div class="form-group row">
            <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                {{ __('Подтвердить') }}
              </button>
            </div>
          </div>

        </form>

         <div class="account">
            <table style="width: 400px">
              <thead>
                <caption>
                  Последние платежи
                </caption>
                <tr>
                  <th>Месяц</th>
                  <th>Группа</th>
                  <th>Сумма</th>
                </tr>
              </thead>
              
              @foreach($last_accounts as $receipt)
                @php
                  $pieces = explode("-", $receipt->month);
                @endphp

                <tr>
                  <td>{{ $pieces[1] }}</td>
                  <td>{{ $receipt->group_name }}</td>
                  <td>{{ $receipt->invoice }}</td>
                </tr>
              @endforeach
            </table>
          </div>
      </div>   
      </div>  
    </section>
  </div>
@endif
<!------------------------------>
@if($ind_2 == 1)
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box">
        <div style="padding: 10px 20px;">
          <a href="/dashboard/finance/create"><button class="btn-success" style="width: 80px; height: 35px">Назад</button></a>
        </div>
        
        <div style="padding: 30px 80px">
          <p>
            <strong style="font-size: 20px">Выставление счёта</strong>
          </p>

          <p style="font-size: 18px;">
            <span>Баланс студента: {{ $Account->account }} гр </span>
          </p>
          <p style="font-size: 18px;">
            <span>Текущий тариф группы: {{ $Group->rate }} гр </span>
          </p>
          <br>
          <div style="font-size: 18px;">
            <p>
              <p>Последняя оплата для этой группы:</p>
              @foreach($last_account as $account) 
                <p>
                  За 
                    @php  
                      $rest = substr($account->month, 0, 7);  
                    @endphp 
                    {{ $rest }}
                </p>

                <p>
                  Сумма {{ $account->invoice }} гр
                </p>
                <p>
                  За {{ $account->quantity }} уроков
                </p>
                <p>
                  Всего было уроков {{ $all_les }}
                </p>
                <p>
                  Оплачиваемых уроков {{ $all_pai }} 
                </p>
                <p>
                  Посещенно оплачиваемых уроков {{ $visited_les }}
                </p>
                <p>
                  Ещё не проведённых опл уроков {{ $not_yet }}
                </p>
              @endforeach
            <p style="font-size: 18px;">
              <span>Остаток за прошлый месяц</span><br><input value="{{ $res }}" type="text" form="form" name="balance">
              <br> по старому тарифу {{$tarif}}гр за 1 занятие
            </p>
            </p>
          </div> 
           
        </div>
        <div class="box-body">

            <form id="form" method="POST" action="{{route('debt.store')}}">
            @csrf

            <!----------------------------------------------------->
            <input type="hidden" name="id" value="{{ $debt->id }}">
            <div class="form-group row">
              <label for="student" class="col-md-2 col-form-label text-md-right">Счёт для</label>
              <div class="col-md-4">

                  <input id="student" type="text" class="form-control" name="student" value="{{ $Student->surname.' '.$Student->name }}"  autocomplete="student" autofocus required disabled>
              </div>
            </div>
            <!----------------------------------------------------->
            <input type="hidden" name="stud_name" value="{{ $Student->surname.' '.$Student->name }}">
            <!----------------------------------------------------->
            <input type="hidden" name="stud_id" value="{{ $Student->id }}">
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="group" class="col-md-2 col-form-label text-md-right">Счёт для группы</label>
              <div class="col-md-4">

                  <input id="group" type="text" class="form-control @error('group') is-invalid @enderror" name="group" value="{{ $Group->group_name }}"  autocomplete="group" autofocus required disabled>

                  @error('group')
                      <span class="invalid-feedback" role="alert">
                          <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                      </span>
                  @enderror
              </div>
            </div>
            <!----------------------------------------------------->
            <input type="hidden" name="group_id" value="{{ $Group->id }}">
            <!----------------------------------------------------->
            <input type="hidden" name="type_rec" value="type2">
            <!----------------------------------------------------->

            <div class="form-group row">
              <label for="account_date" class="col-md-2 col-form-label text-md-right">{{ __('Выберете месяц') }}</label>
              <div class="col-md-4">

                  <input id="account_date" type="date" class="form-control" name="account_date" value="{{ $debt->month }}"  autocomplete="account_date" autofocus required disabled>
              </div>
            </div>
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="account" class="col-md-2 col-form-label text-md-right">Cумма оплаты</label>
              <div class="col-md-4">

                  <input id="account" type="text" class="form-control" name="account" autocomplete="account" autofocus required value="{{ $debt->invoice }}">
              </div>
            </div>
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="how_many" class="col-md-2 col-form-label text-md-right">Планируется уроков</label>
              <div class="col-md-4">

                  <input id="how_many" type="text" class="form-control" name="how_many" autocomplete="how_many" autofocus required value="{{ $debt->quantity }}">
              </div>
            </div>
          <!----------------------------------------------------->
           <div class="form-group row">
              <label for="tarif" class="col-md-2 col-form-label text-md-right">Тариф</label>
              <div class="col-md-4">

                  <input id="tarif" type="text" class="form-control" name="tarif" autocomplete="tarif" autofocus required value="{{ $debt->tarif }}">
              </div>
            </div>
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="payment_type" class="col-md-2 col-form-label text-md-right">Тип оплаты</label>
              <div class="col-md-4">
                <select class="form-control select2"  name="payment_type" autofocus autocomplete required> 
                  <option value="В долг" checked>Выплата долга</option>
                </select>
              </div>
            </div>
            <!----------------------------------------------------->

            <div class="form-group row" style="margin-top: 30px">
              <label for="comment" class="col-md-2 col-form-label text-md-right">Комментарий</label>
              <div class="col-md-4">
                  <textarea id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment"  autocomplete="comment" autofocus></textarea>
              </div>
            </div>
          <!----------------------------------------------------->

          <div class="form-group row">
            <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                {{ __('Подтвердить') }}
              </button>
            </div>
          </div>

        </form>

         <div class="account">
            <table style="width: 400px">
              <thead>
                <caption>
                  Последние платежи
                </caption>
                <tr>
                  <th>Месяц</th>
                  <th>Группа</th>
                  <th>Сумма</th>
                </tr>
              </thead>
              
              @foreach($last_accounts as $receipt)
                @php
                  $pieces = explode("-", $receipt->month);
                @endphp

                <tr>
                  <td>{{ $pieces[1] }}</td>
                  <td>{{ $receipt->group_name }}</td>
                  <td>{{ $receipt->invoice }}</td>
                </tr>
              @endforeach
            </table>
          </div>
      </div>

        
      </div>  
    </section>
  </div>
@endif
<!------------------------------>
@if($stand == 1)
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box">
        <div style="padding: 10px 20px;">
          <a href="/dashboard/finance/create"><button class="btn-success" style="width: 80px; height: 35px">Назад</button></a>
        </div>
        <div style="padding: 30px 80px">
          <p>
            <strong style="font-size: 20px">Выплата долга</strong>
          </p>

          <p style="font-size: 18px;">
            <span>Баланс студента: {{ $Account->account }} гр </span>
          </p>
        </div>
        <div class="box-body">

            <form method="POST" action="{{route('debt.store')}}">
            @csrf

            <input type="hidden" name="id" value="{{ $debt->id }}">
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="student" class="col-md-2 col-form-label text-md-right">Счёт для</label>
              <div class="col-md-4">

                  <input id="student" type="text" class="form-control @error('student') is-invalid @enderror" name="student" value="{{ $Student->surname.' '.$Student->name }}"  autocomplete="student" autofocus required disabled>

                  @error('student')
                      <span class="invalid-feedback" role="alert">
                          <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                      </span>
                  @enderror
              </div>
            </div>
            <input type="hidden" name="type_rec" value="type1">
            <!----------------------------------------------------->
            <input type="hidden" name="stud_name" value="{{ $Student->surname.' '.$Student->name }}">
            <!----------------------------------------------------->
            <input type="hidden" name="stud_id" value="{{ $Student->id }}">
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="group" class="col-md-2 col-form-label text-md-right">Счёт для группы</label>
              <div class="col-md-4">

                  <input id="group" type="text" class="form-control @error('group') is-invalid @enderror" name="group" value="{{ $Group->group_name }}"  autocomplete="group" autofocus required disabled>

                  @error('group')
                      <span class="invalid-feedback" role="alert">
                          <span>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</span>
                      </span>
                  @enderror
              </div>
            </div>
            <!----------------------------------------------------->
            <input type="hidden" name="group_id" value="{{ $Group->id }}">
            <!----------------------------------------------------->

            <div class="form-group row">
              <label for="account_date" class="col-md-2 col-form-label text-md-right">{{ __('Выберете месяц') }}</label>
              <div class="col-md-4">

                  <input id="account_date" type="date" class="form-control" name="account_date" value="{{ $debt->month }}"  autocomplete="account_date" autofocus required disabled>
              </div>
            </div>
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="tarif" class="col-md-2 col-form-label text-md-right">Тариф</label>
              <div class="col-md-4">

                  <input id="tarif" value="{{ $debt->tarif }}" type="text" class="form-control" name="tarif" autocomplete="tarif" autofocus required placeholder="Тариф за месяц">
              </div>
            </div>
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="account" class="col-md-2 col-form-label text-md-right">Cумма оплаты</label>
              <div class="col-md-4">

                  <input id="account" type="text" class="form-control @error('account') is-invalid @enderror" name="account" value="{{ $debt->invoice }}"  autocomplete="account" autofocus required>

                  @error('account')
                      <span class="invalid-feedback" role="alert">
                          <span>{{ 'Поле должно состоять из цифр' }}</span>
                      </span>
                  @enderror
              </div>
            </div>
            <!----------------------------------------------------->
            <div class="form-group row">
              <label for="payment_type" class="col-md-2 col-form-label text-md-right">Тип оплаты</label>
              <div class="col-md-4">
                <select class="form-control select2"  name="payment_type" autofocus autocomplete required> 
                  <option value="В долг" checked>Выплата долга</option>
                </select>
              </div>
            </div>
            <!----------------------------------------------------->
            <div class="form-group row" style="margin-top: 30px">
              <label for="comment" class="col-md-2 col-form-label text-md-right">Комментарий</label>
              <div class="col-md-4">
                  <textarea id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment"  autocomplete="comment" autofocus></textarea>
              </div>
            </div>
          <!----------------------------------------------------->

          <div class="form-group row">
            <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                {{ __('Подтвердить') }}
              </button>
            </div>
          </div>

        </form>

         <div class="account">
            <table style="width: 400px">
              <thead>
                <caption>
                  Последние платежи
                </caption>
                <tr>
                  <th>Месяц</th>
                  <th>Группа</th>
                  <th>Сумма</th>
                </tr>
              </thead>
              
              @foreach($last_accounts as $receipt)
                @php
                  $pieces = explode("-", $receipt->month);
                @endphp

                <tr>
                  <td>{{ $pieces[1] }}</td>
                  <td>{{ $receipt->group_name }}</td>
                  <td>{{ $receipt->invoice }}</td>
                </tr>
              @endforeach
            </table>
          </div>
      </div>
      </div>  
    </section>
  </div>
@endif
<style>
      table {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        border-collapse: collapse;
        color: #686461;
      }
      caption {
        padding: 10px;
        color: white;
        background: #B9B29F;
        font-size: 18px;
        text-align: left;
        font-weight: bold;
      }
      th {
        border-bottom: 3px solid #B9B29F;
        padding: 10px;
        text-align: left;
      }
      td {
        padding: 10px;
      }
      tr:nth-child(odd) {
        background: white;
      }
      tr:nth-child(even) {
        background: #E8E6D1;
      }

      .account{
        float: right; 
        margin-right: 5%; 
        margin-top: -320px;
      }

      @media screen and (max-width: 1150px){
        .account{
        margin-top: 50px; 
        float: left; 
      }
      }
      
    </style>
  </div>
</style>
@endsection

