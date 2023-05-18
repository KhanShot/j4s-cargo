@extends('layouts.app')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <h3>Добавить менеджера</h3>

            <div class="col-md-4 mt-3">
                <form action="{{route('admin.users.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Имя</label>
                        <input type="text" name="name" required class="form-control" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label>Почта</label>
                        <input type="email" name="email" required class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" >
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Локация менеджера</label>
                        <select name="manager_location" class="form-control">
                            <option value="china">Склад(Китай)</option>
                            <option value="kaz">Казахстан</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Пароль</label>
                        <input type="text" required name="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Создать</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
