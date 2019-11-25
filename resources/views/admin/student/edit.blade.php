@extends('admin.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <section class="content">
      <div class="box">
        <p><strong style="font-size: 20px">Редактирование студента</strong></p>
        <div class="box-body">
          <form method="POST" action="{{route('students.update', $stud->id)}}">
          @method('PATCH')
          @csrf


            <div class="form-group row">
                <label for="surname_s" class="col-md-4 col-form-label text-md-right">{{ __('Фамилия') }}</label>

                <div class="col-md-6">
                    <input id="surname_s" type="text" class="form-control @error('surname_s') is-invalid @enderror" name="surname_s" placeholder="Фамилия" value="{{ $stud->surname }}"  autocomplete="surname_s" autofocus required>

                    @error('surname_s')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
              <label for="name_s" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

              <div class="col-md-6">
                  <input id="name_s" type="text" class="form-control @error('name_s') is-invalid @enderror" name="name_s" placeholder="Имя" value="{{ $stud->name }}"  autocomplete="name_s" autofocus required>

                    @error('name_s')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</strong>
                      </span>
                    @enderror
              </div>
            </div>


            <div class="form-group row">
              <label for="patronymic_s" class="col-md-4 col-form-label text-md-right">{{ __('Отчество') }}</label>

              <div class="col-md-6">
                  <input id="patronymic_s" type="text" class="form-control @error('patronymic_s') is-invalid @enderror" name="patronymic_s" placeholder="Отчество" value="{{ $stud->patronymic }}"  autocomplete="patronymic_s" autofocus required>

                  @error('patronymic_s')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</strong>
                      </span>
                  @enderror
              </div>
            </div>

          <div class="form-group row"> 
              <label for="date_of_birth_s" class="col-md-4 col-form-label text-md-right">{{ __('Дата рождения') }}</label>

              <div class="col-md-6">
                                <input id="date_of_birth_s" type="date" class="form-control @error('date_of_birth_s') is-invalid @enderror" name="date_of_birth_s" value="{{ $stud->date_of_birth }}"  autocomplete="date_of_birth_s" autofocus required>

                  @error('date_of_birth_s')
                      <span class="invalid-feedback" role="alert">
                          <strong>Дата должна быть записана так ( '10.08.2019' )</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row">
              <label for="phone_number_s" class="col-md-4 col-form-label text-md-right">{{ __('Номер телефона') }}</label>

              <div class="col-md-6">
                  <input id="phone_number_s" type="tel" class="form-control @error('phone_number_s') is-invalid @enderror" name="phone_number_s" placeholder="3809383366" value="{{ $stud->phone_number }}"  autocomplete="phone_number_s" autofocus required>

                  @error('phone_number_s')
                      <span class="invalid-feedback" role="alert">
                          <strong>Номер должен быть настоящим</strong>
                      </span>
                  @enderror
              </div>
          </div>


          <div class="form-group row">
            <label for="email_s" class="col-md-4 col-form-label text-md-right">{{ __('Эл адес') }}</label>

            <div class="col-md-6">
                <input id="email_s" type="email" class="form-control @error('email_s') is-invalid @enderror" name="email_s" placeholder="test@gmail.com" value="{{ $stud->email_s }}"  autocomplete="email_s" autofocus>

                @error('email_s')
                    <span class="invalid-feedback" role="alert">
                        <strong>Поля обязательно для заполнения. Возможно такая почта уже занята</strong>
                    </span>
                @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="field_of_activity_s" class="col-md-4 col-form-label text-md-right">{{ __('Вид ващей деятельности') }}</label>

            <div class="col-md-6">
                <input id="field_of_activity_s" type="text" class="form-control @error('field_of_activity_s') is-invalid @enderror" name="field_of_activity_s" placeholder="Школьник или Военный или Пожарный..." value="{{ $stud->field_of_activity }}"  autocomplete="field_of_activity_s" autofocus required>

                @error('field_of_activity_s')
                    <span class="invalid-feedback" role="alert">
                        <strong>Поле должно быть заполненым и его длинна не должна быть более 255 символов</strong>
                    </span>
                @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="education" class="col-md-4 col-form-label text-md-right">{{ __('Образовование') }}</label>

            <div class="col-md-6">
              <select id="education" type="text" class="form-control @error('education') is-invalid @enderror" name="education"  autocomplete="education" autofocus>
                  <option>{{ $stud->education }}</option>
                  <option>неполное среднее</option>
                  <option>среднее</option>
                  <option>среднее специальное</option>
                  <option>высшее (неоконченное)</option>
                  <option>высшее</option>
                  <option>ученая степень</option>
              </select>

                @error('education')
                    <span class="invalid-feedback" role="alert">
                        <strong>Поле должно быть заполненым и его длинна не должна быть более 255 символов</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
          <label for="meaning" class="col-md-4 col-form-label text-md-right">{{ __('Цель обучения') }}</label>

          <div class="col-md-6">
              <input id="meaning" type="text" class="form-control @error('meaning') is-invalid @enderror" name="meaning" placeholder="какая у вас цель обучения ?" value="{{ $stud->meaning }}" autocomplete="meaning" autofocus required>

              @error('meaning')
                  <span class="invalid-feedback" role="alert">
                      <strong>Длинна поля не должна быть более 255 символов</strong>
                  </span>
              @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="about_us" class="col-md-4 col-form-label text-md-right">{{ __('Откуда вы узнали о нас?') }}</label>

          <div class="col-md-6">
              <input id="about_us" type="text" class="form-control @error('about_us') is-invalid @enderror" name="about_us" value="{{ $stud->about_us }}" autocomplete="about_us" autofocus required>

              @error('about_us')
                  <span class="invalid-feedback" role="alert">
                      <strong>Длинна поля не должна быть более 255 символов</strong>
                  </span>
              @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="studied" class="col-md-4 col-form-label text-md-right">{{ __('Обучались ли вы ранее школах английского языка ?') }}</label>

          <div class="col-md-6">
              <input id="studied" type="text" class="form-control @error('studied') is-invalid @enderror" name="studied" value="{{ $stud->studied }}" autocomplete="studied" autofocus required>

              @error('studied')
                  <span class="invalid-feedback" role="alert">
                      <strong>Длинна поля не должна быть более 255 символов</strong>
                  </span>
              @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Комментарий') }}</label>

          <div class="col-md-6">
              <textarea id="comment" type="text" class="form-control" name="comment" autocomplete="comment" autofocus>{{ $stud->comment }}</textarea>

              @error('comment')
                  <span class="invalid-feedback" role="alert">
                      <strong>Длинна поля не должна быть более 255 символов</strong>
                  </span>
              @enderror
          </div>
        </div>

        <div class="form-group row">
          <strong class="col-md-10 col-form-label text-md-right" style="font-size: 20px;">Данные про контактное лицо</strong>
        </div>
        <div class="form-group row">
          <label for="relations_s" class="col-md-4 col-form-label text-md-right">{{ __('Кем этот человек вам является?') }}</label>

          <div class="col-md-6">
            <input id="relations_s" type="text" class="form-control @error('relations_s') is-invalid @enderror" name="relations_s" placeholder="Отец, Мама .." value="{{ $stud->relations }}"  autocomplete="relations_s" autofocus required>

              @error('relations_s')
                <span class="invalid-feedback" role="alert">
                  <strong>Поле должно быть заполненым и его длинна не должна быть более 255 символов</strong>
                </span>
              @enderror
            </div>
        </div>

        <div class="form-group row">
          <label for="surname_r" class="col-md-4 col-form-label text-md-right">{{ __(' Фамилия ') }}</label>

          <div class="col-md-6">
              <input id="surname_r" type="text" class="form-control @error('surname_r') is-invalid @enderror" name="surname_r" placeholder="Фамилия" value="{{ $stud->surname_r }}"  autocomplete="surname_r" autofocus required>

               @error('surname_r')
                  <span class="invalid-feedback" role="alert">
                      <strong>Поле должно быть заполненым и его длинна не должна быть более 255 символов</strong>
                  </span>
                @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="name_r" class="col-md-4 col-form-label text-md-right">{{ __(' Имя ') }}</label>

          <div class="col-md-6">
              <input id="name_r" type="text" class="form-control @error('name_r') is-invalid @enderror" name="name_r" placeholder="Имя" value="{{$stud->name_r}}"  autocomplete="name_r" autofocus required>

              @error('name_r')
                <span class="invalid-feedback" role="alert">
                  <strong>Поле должно быть заполненым и его длинна не должна быть более 255 символов</strong>
                </span>
              @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="patronymic_r" class="col-md-4 col-form-label text-md-right">{{ __(' Отчество ') }}</label>

          <div class="col-md-6">
              <input id="patronymic_r" type="text" class="form-control @error('patronymic_r') is-invalid @enderror" name="patronymic_r" placeholder="Отчество" value="{{ $stud->patronymic_r }}"  autocomplete="patronymic_r" autofocus required>

              @error('patronymic_r')
                  <span class="invalid-feedback" role="alert">
                      <strong>Поле должно быть заполненым и его длинна не должна быть более 255 символов</strong>
                  </span>
              @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="date_of_birth_r" class="col-md-4 col-form-label text-md-right">{{ __(' Дата рождения ') }}</label>

          <div class="col-md-6">
              <input id="date_of_birth_r" type="date" class="form-control @error('date_of_birth_r') is-invalid @enderror" name="date_of_birth_r" placeholder="Дату можно записать в ручную" value="{{ $stud->date_of_birth_r }}"  autocomplete="date_of_birth_r" autofocus required>

               @error('date_of_birth_r')
                  <span class="invalid-feedback" role="alert">
                      <strong>Дата должна быть записана так ( '10.08.2019' )</strong>
                  </span>
              @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="phone_number_r" class="col-md-4 col-form-label text-md-right">{{ __(' Номер телефона ') }}</label>

           <div class="col-md-6">
              <input id="phone_number_r" type="tel" class="form-control @error('phone_number_r') is-invalid @enderror" name="phone_number_r" placeholder="+380938330666" value="{{ $stud->phone_number_r }}"  autocomplete="phone_number_r" autofocus required>

              @error('phone_number_r')
                <span class="invalid-feedback" role="alert">
                    <strong>Необходимо указать настоящий номер</strong>
                </span>
              @enderror
          </div>
        </div>

        <div class="form-group row">
            <label for="email_r" class="col-md-4 col-form-label text-md-right">{{ __('Эл адес') }}</label>

            <div class="col-md-6">
                <input id="email_r" type="email" class="form-control @error('email_r') is-invalid @enderror" name="email_r" placeholder="test@gmail.com" value="{{ $stud->email_r }}"  autocomplete="email_r" autofocus>

                @error('email_r')
                    <span class="invalid-feedback" role="alert">
                        <strong>Поля обязательно для заполнения. Возможно такая почта уже занята</strong>
                    </span>
                @enderror
            </div>
          </div>


          <div class="form-group row">
            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Статус') }}</label>

            <div class="col-md-6">
              <select id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status"  autocomplete="status" autofocus>
                  <option>{{ $stud->status }}</option>
                  <option>Новый</option>
                  <option>Активный</option>
                  <option>Не активный</option>
                  <option>Закончил обучение</option>
              </select>

                @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>Поле должно быть заполненым и его длинна не должна быть более 255 символов</strong>
                    </span>
                @enderror
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                {{ __('Подтвердить') }}
              </button>
            </div>
          </div>
        </form>
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
