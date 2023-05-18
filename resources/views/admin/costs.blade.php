@extends('layouts.app')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Цены</h3>
            </div>
            @include('layouts.alert')

            <div class="card col-md-4">
                <div class="card-header"><div class="card-title">Назначить цену за кг</div></div>

                <div class="card-body ">
                    <form action="{{route('admin.costs.create')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Цена $: </label>
                            <input type="number" step="0.01" class="form-control" name="price" required value="{{$cost->price ?? null}}" >
                        </div>
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-success" > Сохранить </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

