@extends('layouts.app')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="d-flex justify-content-between mb-3">
                <select class="form-control form-select col-md-3" id="selectUsers"  onchange="getUsers()">
                    <option value="" @if(request()->get('user') == '') selected @endif>Все</option>
                    <option value="user" @if(request()->get('user') == 'user') selected @endif >Пользователи</option>
                    <option value="manager" @if(request()->get('user') == 'manager') selected @endif>Менеджеры</option>
                </select>
                <div class="">
                    <a href="{{route('admin.users.create')}}" class="btn btn-success"><i class="icon-plus"></i></a>
                </div>
            </div>
            @include('layouts.alert')
            <table class="table mt-4" id="dataTable">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Имя Фамилия</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Город</th>
                    <th scope="col">Почта</th>
                    <th scope="col">Код</th>
                    <th scope="col">Кол-во трекингов</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name . ' ' . $user->surname}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->city}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->code}}</td>
                        <td>{{$user->tracking_count}}</td>
                        <td>
                            <div class="d-flex">
                                <form method="post" action="{{route('admin.users.delete', $user->id)}}"
                                onsubmit="return confirm('Вы действительно хотите удалить пользователя ?')">
                                    @csrf @method('delete')
                                    <button type="submit" class="btn btn-danger" @if($user->type != 'user') disabled @endif ><i class="icon-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function getUsers(){
            let selected = document.getElementById('selectUsers');
            location.href = '/admin/users?user=' +selected.value;
            console.log(selected.value)
        }
    </script>
@endsection
