@extends('layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Ваши треки</h3>
                <button class="btn btn-success" data-toggle="modal" data-target="#createTracking">Добавить трекинг</button>
            </div>

            <div class=" d-flex flex-wrap mt-3">
                @foreach($trackings as $tracking)
                    <div class="card col-md-3 mr-2">
                        <div class="card-body">
                            <h5 class="card-title">Номер: {{$tracking->number}}</h5>
                            <p class="card-text">Описание: {{$tracking->description}}</p>
                            <p class="card-text">Статус: <?php
                                                             echo match ($tracking->status){
                                                                 "created" => 'Трекинг создан',
                                                                 "china_stock" => 'Доставлен в склад(Китай)',
                                                                 "kaz_stock" => 'Доставлен в Казахстан',
                                                                 default => '-',
                                                             }

                                                             ?></p>
                            <p class="card-text">Дата создание: {{$tracking->created_at}}</p>
                            <p class="card-text">Дата изменения статуса: {{$tracking->status_changed_time}}</p>
                            @if($tracking->weight)
                                <p class="card-text">Вес: {{ $tracking->weight }} кг</p>
                                <p class="card-text">Цена за кг: ${{ $price }}</p>
                                <p class="card-text">Конечная цена: {{ round($tracking->weight * $price * $dollar) }} Тг</p>
                            @endif

                        </div>
                    </div>
                @endforeach


            </div>


        </div>
    </div>



    <div class="modal fade" id="createTracking" tabindex="-1" role="dialog" aria-labelledby="createTrackingLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTrackingLabel">Добавить трекинг</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('tracks.create')}}">
                        @csrf
                        <div class="form-group">
                            <label for="tracking_number">Трек-номер</label>
                            <input class="form-control" name="number" required>
                        </div>
                        <div class="form-group">
                            <label for="weight">Вес товара (Кг)</label>
                            <input type="number" step="0.01" class="form-control" name="weight">
                        </div>
                        <div class="form-group">
                            <label for="tracking_number">Описание</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group d-flex justify-content-end">
                            <button class="btn btn-success" type="submit">Сохранить</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
