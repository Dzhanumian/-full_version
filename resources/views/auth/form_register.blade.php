@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Регистрация пользователя') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Фамилия') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" placeholder="Фамилия" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Имя" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Поле должно быть заполненым и его длинна не должна быть более 255 символов' }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="patronymic" class="col-md-4 col-form-label text-md-right">{{ __('Отчество') }}</label>

                            <div class="col-md-6">
                                <input id="patronymic" placeholder="Отчество (не обязательно)" type="text" class="form-control @error('patronymic') is-invalid @enderror" name="patronymic" value="{{ old('patronymic') }}" autocomplete="patronymic" autofocus>

                                @error('patronymic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Длинна поля не должна превышать 255 символов' }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Дата рождения') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" autocomplete="date_of_birth">

                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Дата должна быть записана так ( '10.08.2019' )</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Номер телефона') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" placeholder="0938660771" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Номер может состоять только из цифр' }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Электронный адрес') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="test@test.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Возможно пользователь с такой почтой уже зарегестрирован, длинна почты не должна превышать 500 символов, в адрессе должен быть символ '@' </strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="level_and_language" class="col-md-4 col-form-label text-md-right">{{ __('Языки и уровень') }}</label>

                            <div class="col-md-6">
                                <input id="level_and_language" placeholder="Английский А1, Немецкий A1..." type="text" class="form-control @error('level_and_language') is-invalid @enderror" name="level_and_language" value="{{ old('level_and_language') }}" required autocomplete="level_and_language">

                                @error('level_and_language')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Поле должно быть заполненым и его длинна не должна быть более 500 символов' }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Роль') }}</label>

                            <div class="col-md-6">
                                <input id="role" type="text" placeholder="owner или admin или teacher" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" required autocomplete="role">

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Запишите в поле одну из этих ролей: admin , teacher, owner' }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="employment_date" class="col-md-4 col-form-label text-md-right">{{ __('Дата приёма на работу') }}</label>

                            <div class="col-md-6">
                                <input id="employment_date" type="date" class="form-control @error('employment_date') is-invalid @enderror" name="employment_date" value="{{ old('employment_date') }}" autocomplete="employment_date">

                                @error('employment_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Дата должна быть записана так ( '10.08.2019' )</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Комментарий') }}</label>

                            <div class="col-md-6">
                                <input id="comment" type="text" placeholder="Комментарий (не обязательно)" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" autocomplete="comment">

                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Длинна комментария не должна превышать 1000 символов' }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="my_password_12345" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Пароль не должен быть короче 10 символов.<br>Значение этого поля должно совпадать с полем "Повторный пароль"</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Повторный пароль') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" placeholder="Должно совпадать с полем 'Пароль'" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Регистрация') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection