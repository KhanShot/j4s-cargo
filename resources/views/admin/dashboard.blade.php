@extends('layouts.app')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="chart-container mt-5 mb-5">
                    <div class="chart-bar">
                        <canvas height="60" id="track-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(function(){
            //get the pie chart canvas
            let ctx = $("#track-chart");
            let label = JSON.parse('<?php echo $label ;?>')
            let tracks = JSON.parse('<?php echo $tracks; ?> ');

            let data = {
                labels: label,
                datasets: [
                    {
                        label: "Кол-во пользователей",
                        data: tracks,
                        backgroundColor: '#f3b3b3',
                        borderColor: '#ff0000',
                    },
                ]
            };

            let lineOptions = {
                responsive: true,
                scales: {
                    x: {
                        // x options
                    },
                    y: {
                        display: true,
                        min: 0,
                        ticks: {
                            stepSize: 1,
                        }
                    }
                },
                plugins:{
                    title: {
                        display: true,
                        position: "top",
                        text: "Общие данные",
                        font:{
                            size: 28,
                        },
                        fontColor: "#111"
                    },
                },
                legend: {
                    display: true,
                    position: "top",
                    labels: {
                        fontColor: "#333",
                        fontSize: 16
                    }
                },
            };

            //create Pie Chart class object
            let chart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: lineOptions
            });

        });
    </script>
@endsection
