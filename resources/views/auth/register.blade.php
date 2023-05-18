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
                            <div class="border-grey border-lighten-3 m-0 box-shadow-0 card-account-left">
                                <img src="log.png" class="card-account-img width-500 mt-5" alt="card-account-img">
                            </div>
                        </div>
                        <!-- login form -->
                        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-12 p-0">
                            <div class="card border-grey border-lighten-3 m-0 box-shadow-0 card-account-right ">
                                <div class="card-content">
                                    <div class="card-body p-3">
                                        <p class="mb-3 text-center h5">Регистрация</p>
                                        @if($errors->any())
                                            {{ implode('', $errors->all('<div>:message</div>')) }}
                                        @endif
                                        <form class="form-horizontal form-signin" action="{{route('register')}}" method="post">
                                            @csrf
                                            <fieldset class="form-label-group">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" required autofocus=""
                                                       value="{{ old('name') }}"
                                                       name="name">
                                                <label for="name">Имя</label>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-label-group">
                                                <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" placeholder="surname" required autofocus=""
                                                       value="{{ old('surname') }}"
                                                       name="surname">
                                                <label for="surname">Фамилия</label>
                                                @error('surname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-label-group">
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email" required autofocus=""
                                                       value="{{ old('email') }}"
                                                       name="email">
                                                <label for="email">Почта</label>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-label-group">
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="phone" required autofocus=""
                                                       value="{{ old('phone') }}"
                                                       name="phone">
                                                <label for="phone">Телефон</label>
                                                @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-label-group">
                                                <select class="form-control" name="state" id="state" required>
                                                    <option value="">Выбрать область</option>
                                                </select>
                                                @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }} asdasd</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-label-group">
                                                <select class="form-control" name="city" id="city" disabled required>
                                                    <option value="">Выбрать Город</option>
                                                </select>
                                                @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }} asdas</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-label-group">
                                                <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" placeholder="code" required autofocus=""
                                                       value="{{ old('code') }}"
                                                       name="code">
                                                <label for="code">Код пользователя</label>
                                                @error('code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-label-group">
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="1"  required="" autofocus="">
                                                <label for="password">Пароль</label>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                            <button type="submit" class="btn-gradient-primary btn-block my-1">Регистрация</button>
                                            <p class="text-center"><a href="{{route('login')}}" class="card-link">Войти</a></p>
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
@section('js')
    <script>
        $(document).ready(function () {


        async function getStates() {
            const response = await fetch("https://namaztimes.kz/ru/api/states?id=99");
            const jsonData = await response.json();
            let select = document.getElementById('state');
            for (const [key, value] of Object.entries(jsonData)) {
                $("#state").append($('<option />')  // Create new <option> element
                    .val(value)            // Set value as "Hello"
                    .text(value)           // Set textContent as "Hello"
                    .attr('data-key', key)
                )
            }
        }
        async function getCities(state){
            const response = await fetch("https://namaztimes.kz/ru/api/cities?id="+state);
            const jsonData = await response.json();
            let city = document.getElementById('city');
            removeOptions(city);
            for (const [key, value] of Object.entries(jsonData)) {
                city.add(new Option(value,value))
            }
        }

        $("#state").on('change', function () {
            let selectedState = $(this).find(':selected').data('key');
            if(selectedState!== ""){
                $('#city').removeAttr('disabled')
                getCities(selectedState)
            }else{
                removeOptions($('#city'))
                $('#city').attr('disabled', '')
            }
        });




        function removeOptions(selectElement) {
            let i, L = selectElement.options.length - 1;
            for(i = L; i >= 1; i--) {
                selectElement.remove(i);
            }
        }

        function selectCity(){
            let select = document.getElementById('state');
            let city = document.getElementById('city');
            if(select.getAttribute("data-key") !== ""){
                city.removeAttribute('disabled')
                getCities(select.value)
            }else{
                removeOptions(city)
                city.setAttribute('disabled', '')
            }
        }
        getStates();
        })


    </script>
@endsection
