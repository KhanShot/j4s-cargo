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
                    <th scope="col">Номер пользвателя</th>
                    <th scope="col">Город</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Дата заказа</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trackings as $tracking)
                    <tr>
                        <th scope="row">{{$tracking->id}}</th>
                        <td>{{$tracking->number}}</td>
                        <td>{{$tracking->user ? $tracking->user->name . ' '. $tracking->user->surname : '-'}}</td>
                        <td>{{$tracking->user->phone ?? '-'}}</td>
                        <td>{{$tracking->city}}</td>
                        <td> <?php
                                 echo match ($tracking->status){
                                     "created" => 'Трекинг создан',
                                     "china_stock" => 'Доставлен в склад(Китай)',
                                     "kaz_stock" => 'Доставлен в Казахстан',
                                     default => '-',
                                 }

                                 ?> </td>
                        <td>{{$tracking->created_at}}</td>
                        <td>
                            <div class="d-flex">
                                <button href="#" class="btn btn-warning" data-toggle="modal" data-target="#editTrackModal"
                                        data-track-id="{{$tracking->id}}"
                                ><i class="icon-pencil"></i></button>

                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection

