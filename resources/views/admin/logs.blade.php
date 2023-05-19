@extends('layouts.app')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Логи</h3>
            </div>
            @include('layouts.alert')
            <table class="table mt-4" id="dataTable">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Трек код</th>
                    <th scope="col">Пользователь</th>
                    <th scope="col">Город</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Дата заказа</th>
                </tr>
                </thead>
                <tbody>
                @foreach($logs as $log)
                    <tr>
                        <th scope="row">{{$log->id}}</th>
                        <td>{{$log->scanned_code}}</td>
                        <td>{{$log->user ? $log->user->name . ' '. $log->user->surname : '-'}}</td>
                        <td>{{$log->city?? '-'}}</td>
                        <td>
                            @if($log->status == 'fail')
                                <i class="icon-ban text-danger"></i> Не прошел
                            @else
                                <i class="icon-check text-success"></i> Прошел
                            @endif

                        </td>
                        <td>{{$log->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection

