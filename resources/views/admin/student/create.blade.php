@extends('admin.layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <section class="content">
      <div class="box" style="margin-top: -10px">
        <div class="box-body main">

            <!--- Этот блок видят только НЕзарегистрированные на сайте пользователи --->
            @guest
            <div style="width: 100%;">
                <p style="text-align: center; margin: 0 0 10px 0"><span style="font-size: 22px; font-style: Sylfaen; margin-left: +0%; text">Уважаемый посетитель!</span></p>
                <p><span style="font-size: 16px; font-style: Sylfaen">Заполните, пожалуйста, краткую анкету учащегося перед началом тестирования уровня владения языком</span></p>
            </div>
            @endguest

            <!--- Этот блок видят только зарегистрированные на сайте пользователи --->
            @auth
            <p style="text-align: center; margin: 0 0 10px 0"><span style="font-size: 22px; font-style: Sylfaen; margin-left: +0%">Регистрация нового учащегося</span></p>
            @endauth
            
            <form method="POST" action="{{route('students.store')}}">
            @csrf
                <div class="form-group row fl">
                    <div class="col-md-6">
                        <label for="surname_s" class="col-form-label">Фамилия</label>
                        <input required style="width: 475px"  id="surname_s" type="text" class="form-control @error('surname_s') is-invalid @enderror" name="surname_s" value="{{ old('surname_s') }}"  autocomplete="surname_s" autofocus >

                        @error('surname_s')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!----------------------------------------------------->
                <div class="form-group row fl">
                    <div class="col-md-6">
                        <label for="name_s" class="col-form-label">Имя</label>
                        <input required style="width: 475px"  id="name_s" type="text" class="form-control @error('name_s') is-invalid @enderror" name="name_s" value="{{ old('name_s') }}"  autocomplete="name_s" autofocus >

                        @error('name_s')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!----------------------------------------------------->
                <div class="form-group row fl">
                    <div class="col-md-6">
                        <label for="patronymic_s" class="col-form-label">Отчество</label>
                        <input required style="width: 475px"  id="patronymic_s" type="text" class="form-control @error('patronymic_s') is-invalid @enderror" name="patronymic_s" value="{{ old('patronymic_s') }}"  autocomplete="patronymic_s" autofocus >

                        @error('patronymic_s')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!----------------------------------------------------->
                <div class="form-group row fl">
                    <div class="col-md-6">
                        <label for="date_of_birth_s" class="col-form-label">Дата рождения</label>
                        <input required style="width: 475px"  id="date_of_birth_s" type="date" class="form-control @error('date_of_birth_s') is-invalid @enderror" name="date_of_birth_s" value="{{ old('date_of_birth_s') }}"  autocomplete="date_of_birth_s" autofocus >

                        @error('date_of_birth_s')
                            <span class="invalid-feedback" role="alert">
                                <strong>@php echo 'Поле должно быть заполненым в таком формате '.date('d-m-Y'); @endphp</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!----------------------------------------------------->
                <div class="form-group row fl">
                    <div class="col-md-6">
                        <label for="phone_number_s" class="col-form-label">Номер телефона <small>(в формате 380501234567)</small></label>
                        <input required style="width: 475px"  id="phone_number_s" type="tel" class="form-control @error('phone_number_s') is-invalid @enderror" pattern="[0,3,8]{3}[0-9]{2}[0-9]{7}" required name="phone_number_s" value="{{ old('phone_number_s') }}" placeholder="380501234567"  autocomplete="phone_number_s" autofocus >

                        @error('phone_number_s')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ 'Номер телефона должен быть указан в таком формате 380501234567' }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!----------------------------------------------------->
                <div class="form-group row fl">
                    <div class="col-md-6">
                        <label for="email_s" class="col-form-label">Электронная почта</label>
                        <input style="width: 475px;"  id="email_s" type="email" class="form-control @error('email_s') is-invalid @enderror" name="email_s" placeholder="tust@gmail.com" value="{{ old('email_s') }}" placeholder="0938337777"  autocomplete="email_s" autofocus >

                        @error('email_s')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ 'Эта почта уже занята' }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!----------------------------------------------------->
                @error('field_of_activity_s')
                <div class="invalid-feedback" role="alert">
                @enderror    
                <div class="up">
                    <label for="field_of_activity_s" class="col-form-label">Вид деятельности</label>
                    <select required style="width: 300px" class="form-control select2 @error('field_of_activity_s') is-invalid @enderror"  name="field_of_activity_s[]" autofocus autocomplete="field_of_activity_s" multiple>
                        <option value="Предприниматель/владелец бизнеса">Предприниматель, владелец бизнеса</option>
                        <option>Руководитель высшего звена</option>
                        <option>Руководитель среднего звена</option>
                        <option>Госслужащий</option>
                        <option>Военнослужащий</option>
                        <option value="Специалист/инженернотехнический работник">Специалист, инженернотехнический работник</option>
                        <option>Рабочий</option>
                        <option>Работник сферы торговли</option>
                        <option>Работник сферы услуг</option>
                        <option value="Учащийся/студент">Учащийся, студент</option>
                        <option>Безработный</option>
                        <option>Пенсионер</option>
                        <option>Другое (укажите ->)</option>
                    </select>
                </div> 
                <div style="width: 120px; float: left; padding-left: 20px">
                    <label>Свой вариант</label>
                    <input  style="height: 33px" type="text" name="activity">
                </div>
                @error('field_of_activity_s')
                </div>
                @enderror
                <!----------------------------------------------------->
                @error('education')
                <div class="invalid-feedback" role="alert">
                @enderror
                <div class="up" style="margin-top: 10px">
                    <label for="education" class="col-form-label">Образовование</label>
                    <select required style="width: 300px" class="form-control select2 @error('education') is-invalid @enderror"  name="education" autofocus autocomplete="education">
                        <option>Неполное среднее</option>
                        <option>Среднее</option>
                        <option>Среднее специальное</option>
                        <option>Высшее (неоконченное)</option>
                        <option>Высшее</option>
                        <option>Ученая степень</option>
                        <option>Другое (укажите ->)</option>
                    </select>
                </div> 
                <div style="width: 120px; float: left; padding-left: 20px; margin-top: 10px">
                    <label>Свой вариант</label>
                    <input style="height: 33px" type="text" name="education1">
                </div>
                @error('education')
                </div>
                @enderror
                <!----------------------------------------------------->
                @error('meaning')
                <div class="invalid-feedback" role="alert">
                @enderror
                <div class="up" style="margin-top: 10px">
                    <label for="meaning" class="col-form-label">Цель обучения</label>
                    <select required style="width: 300px" class="form-control select2 @error('meaning') is-invalid @enderror"  name="meaning[]" multiple autofocus autocomplete="meaning">
                        <option>Для сдачи экзамена</option>
                        <option>Для получения сертификата</option>
                        <option>Для путешествий</option>
                        <option>Для эмиграции</option>
                        <option>Для общего образования</option>
                        <option>Для карьерного роста</option>
                        <option>Для выполнения должностных обязанностей</option>
                        <option>Для образования за границей</option>
                        <option>Другое (укажите ->)</option>
                    </select>
                </div> 
                <div style="width: 120px; float: left; padding-left: 20px; margin-top: 10px">
                    <label>Свой вариант</label>
                    <input style="height: 33px" type="text" name="meaning1">
                </div>
                @error('meaning')
                </div>
                @enderror
                <!----------------------------------------------------->
                @error('about_us')
                <div class="invalid-feedback" role="alert">
                @enderror
                <div class="up" style="margin-top: 10px">
                    <label for="about_us" class="col-form-label">Откуда вы узнали о нас?</label>
                    <select required style="width: 300px" class="form-control select2 @error('about_us') is-invalid @enderror"  name="about_us[]" multiple autofocus autocomplete="about_us">
                        <option>Самостоятельный поиск в сети интернет</option>
                        <option>Из социальных сетей</option>
                        <option>Из рекламы</option>
                        <option>По рекомендации друзей и знакомых</option>
                        <option>Другое (укажите ->)</option>
                    </select>
                </div> 
                <div style="width: 120px; float: left; padding-left: 20px; margin-top: 10px">
                    <label>Свой вариант</label>
                    <input style="height: 33px" type="text" name="about_us1">
                </div>
                @error('about_us')
                </div>
                @enderror
                <!----------------------------------------------------->
                <div style="width: 500px">    
                    <div class="up" style="margin-top: 10px">
                        <label for="studied" class="col-form-label">Обучались ли вы ранее школах английского языка ?</label>
                        <select required style="width: 300px" class="form-control select2 @error('studied') is-invalid @enderror"  name="studied[]" multiple autofocus autocomplete="studied">
                            <option>Нигде не учился ранее</option>
                            <option>Частный репетитор</option>
                            <option>Онлайн-школа или онлайн-репетитор</option>
                            <option>Частная школа (укажите ->)</option>
                            <option>Другое (укажите ->)</option>
                        </select>
                    </div>
                    <br><br>
                    <div style="width: 120px; float: left; padding-left: 20px; margin-top: 30px">
                        <label>Свой вариант</label>
                        <input style="height: 33px" type="text" name="studied1">
                    </div>
                </div>
                <!----------------------------------------------------->
                <div class="form-group row fl" style="margin-top: 8px;">
                    <div class="col-md-6">
                        <label for="comment" class="col-form-label">Комментарий</label>
                        <textarea style="width: 475px;"  id="comment" type="email" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" autocomplete="comment" autofocus ></textarea>

                        @error('comment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ 'Поле должно текстовым' }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>    
                <!----------------------------------------------------->
                <div style="width: 100%; float: left; margin-bottom: 15px"></div>
                <div style="width: 100%; float: left; font-size: 22px;">
                    <span style="margin-left: 19%">Данные про контактное лицо</span><br><small style="margin-left: 10%">Заполнять только если вам меньше 16 лет</small>
                </div>
                <!----------------------------------------------------->
                @error('relations_s')
                <div class="invalid-feedback" role="alert">
                @enderror
                <div class="up" style="margin-top: 15px">
                    <label for="relations_s" class="col-form-label">Кем этот человек вам является?</label>
                    <select style="width: 475px" class="form-control select2 @error('relations_s') is-invalid @enderror"  name="relations_s" autofocus autocomplete="relations_s">
                        <option>Отец или мать</option>
                        <option>Брат или сестра</option>
                        <option>Дедушка или бабушка</option>
                        <option>Дядя или тетя</option>
                        <option>Работодатель</option>
                    </select>
                </div>
                @error('relations_s')
                </div>
                @enderror 
                <!----------------------------------------------------->
                <div class="form-group row fl" style="margin-top: 10px">
                    <div class="col-md-6">
                        <label for="surname_r" class="col-form-label">Фамилия</label>
                        <input style="width: 475px"  id="surname_r" type="text" class="form-control @error('surname_r') is-invalid @enderror" name="surname_r" value="{{ old('surname_r') }}"  autocomplete="surname_r" autofocus >

                        @error('surname_r')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!----------------------------------------------------->
                <div class="form-group row fl">
                    <div class="col-md-6">
                        <label for="name_r" class="col-form-label">Имя</label>
                        <input style="width: 475px"  id="name_r" type="text" class="form-control @error('name_r') is-invalid @enderror" name="name_r" value="{{ old('name_r') }}"  autocomplete="name_r" autofocus >

                        @error('name_r')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!----------------------------------------------------->
                <div class="form-group row fl">
                    <div class="col-md-6">
                        <label for="patronymic_r" class="col-form-label">Отчество</label>
                        <input style="width: 475px"  id="patronymic_r" type="text" class="form-control @error('patronymic_r') is-invalid @enderror" name="patronymic_r" value="{{ old('patronymic_r') }}"  autocomplete="patronymic_r" autofocus >

                        @error('patronymic_r')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!----------------------------------------------------->
                <div class="form-group row fl">
                    <div class="col-md-6">
                        <label for="date_of_birth_r" class="col-form-label">Дата рождения</label>
                        <input style="width: 475px"  id="date_of_birth_r" type="date" class="form-control @error('date_of_birth_r') is-invalid @enderror" name="date_of_birth_r" value="{{ old('date_of_birth_r') }}"  autocomplete="date_of_birth_r" autofocus >

                        @error('date_of_birth_r')
                            <span class="invalid-feedback" role="alert">
                                <strong>@php echo 'Поле должно быть заполненым в таком формате '.date('d-m-Y'); @endphp</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!----------------------------------------------------->
                <div class="form-group row fl">
                    <div class="col-md-6">
                        <label for="phone_number_r" class="col-form-label">Номер телефона</label>
                        <input style="width: 475px"  id="phone_number_r" type="text" class="form-control @error('phone_number_r') is-invalid @enderror" name="phone_number_r" value="{{ old('phone_number_r') }}" placeholder="0938337777"  autocomplete="phone_number_r" autofocus >

                        @error('phone_number_r')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ 'Поле должно быть заполненым в таком формате 093833777' }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!----------------------------------------------------->
                <div class="form-group row fl">
                    <div class="col-md-6">
                        <label for="email_r" class="col-form-label">Электронный адрес<small class="smal">не обязательно</small></label>
                        <input style="width: 475px;"  id="email_r" type="email" class="form-control @error('email_r') is-invalid @enderror" name="email_r" placeholder="tust@gmail.com" value="{{ old('email_r') }}" placeholder="0938337777"  autocomplete="email_r" autofocus >

                        @error('email_r')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ 'Поле должно быть заполненым в таком формате tust@gmail.com' }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!----------------------------------------------------->

                <!----------------------------------------------------->
                <div class="form-group row fl">
                    <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                        {{ __('Подтвердить') }}
                      </button>
                    </div>
                </div>
                <!----------------------------------------------------->
            </form>
        </div> 
    </section>
    <style>
        label{
            
        }
        .up{
            width: 280px;
            float: left;
        }

        .main{
            width: 500px; 
            margin: 0 auto;
        }
      .invalid-feedback
      {
        color: red;
      }
      .fl{
       float: left;
      }
      .smal{
        float: right;
        margin-top: -17px;
        margin-left: 30px;
        font-size: 11px;
      }

            /*.alternative
            {
                margin-right: 30px;
                float: right;
            }*/

            /*@media screen and (min-width: 1239px){
                .alternative
                {
                    margin-right: 30px; 
                    float: right;
                }
            }*/


    </style>
  </div>
@endsection

