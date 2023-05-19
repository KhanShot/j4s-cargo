@extends('layouts.app')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Трекинги</h3>
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
                                     "kaz_pvz_stock" => 'Доставлен в ПВЗ Казахстан',
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

    <!-- Modal -->
    <div class="modal fade" id="editTrackModal" tabindex="-1" role="dialog" aria-labelledby="editTrackModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTrackModalLabel">Изменить статус</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.tracks.edit')}}">
                        @csrf
                        <input type="hidden" name="tracking_id" id="tracking_id" >

                        <select class="form-control" name="status">
                            <option value="china_stock">Доставлен в склад(Китай)</option>
                            <option value="kaz_stock">Доставлен в Казахстан</option>
                            <option value="kaz_pvz_stock">Доставлен в ПВЗ Казахстан</option>
                        </select>
                        <button type="submit" class="btn btn-success">Изменить статус</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("js")
    <script>
        $('#editTrackModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let recipient = button.data('track-id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this)
            modal.find('#tracking_id').val(recipient)
        })
    </script>
@endsection
