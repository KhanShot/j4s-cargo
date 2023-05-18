@extends('layouts.app')

@section('content')
        <div class="app-content mt-5">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <section id="account-login" class="flexbox-container">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <!-- image -->
                            <div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-12 p-0 text-center d-none d-md-block">
                                <div class="border-grey border-lighten-3 m-0 box-shadow-0 card-account-left height-400">
                                    <img src="log.png" class="card-account-img width-500 mt-5" alt="card-account-img">
                                </div>
                            </div>
                            <!-- login form -->
                            <div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-12 p-0">
                                <div class="card border-grey border-lighten-3 m-0 box-shadow-0 card-account-right height-400">
                                    <div class="card-content">
                                        <div class="card-body p-3">
                                            <p class="mb-3 text-center h5">Вход в систему</p>

                                            <form class="form-horizontal form-signin" action="{{route('login')}}" method="post">
                                                @csrf
                                                <fieldset class="form-label-group">
                                                    <input type="email" placeholder="Почта" class="form-control @error('email') is-invalid @enderror" id="user-name" required="" autofocus
                                                           value="{{ old('email') }}"
                                                           name="email">
                                                    <label for="user-name">Почта</label>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </fieldset>
                                                <fieldset class="form-label-group">
                                                    <input type="password" placeholder="Пароль" id="user-password" name="password" class="form-control @error('password') is-invalid @enderror" autofocus required="">
                                                    <label for="user-password">Пароль</label>
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </fieldset>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-12 text-center text-sm-left">
                                                        <fieldset>

                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="#" class="card-link">Забыл пароль?</a></div>
                                                </div>
                                                <button type="submit" class="btn-gradient-primary btn-block my-1">Вход</button>
                                                <p class="text-center"><a href="{{route('register')}}" class="card-link">Регистрация</a></p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
@endsection
