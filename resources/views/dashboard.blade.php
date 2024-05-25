<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased flex-1 relative bg-gray-100">
    @include('layouts.navigation')
    <div class="m-6">
        <h1 class="font-bold text-2xl">Bienvenido a Construmanager, {{Auth::user()->name}}</h1>
    </div>
    <div class="flex">
    <div class="m-6 bg-white rounded p-4">
        <p>El material más solicitado es:</p>
        <p class="font-bold text-4xl">{{$fMaterial->name}}</p>
    </div>
    <div class="m-6 bg-white rounded p-4">
        <p>El material menos solicitado es:</p>
        <p class="font-bold text-4xl">{{$lMaterial->name}}</p>
    </div>
</div>
    <div class="bg-white m-6 mt-0 p-3">
        <div class="grid grid-cols-2 gap-3">
            <div class="h-64">
                <canvas id="low-materials-graph" ></canvas>
            </div>
            <div class="h-64">
                <canvas id="time-contracts-graph" ></canvas>
            </div>
        </div>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const materialGraph = document.getElementById('low-materials-graph').getContext('2d');
        const barGraph = new Chart(materialGraph, {
            type: 'bar',
            data: {
                labels: @json($lMaterials->pluck('name')),
                datasets: [{
                    label: "Materiales con menos existencias",
                    data: @json($lMaterials->pluck('quantity')),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad'
                        },
                    }
                }
            }
        });

        const contractsGraph = document.getElementById('time-contracts-graph').getContext('2d');
        const timeGraph = new Chart(contractsGraph, {
            type: 'line',
            data: {
                labels: @json($tContracts->pluck('date')),
                datasets: [{
                    label: "Cantidad de contratos en el tiempo",
                    data: @json($tContracts->pluck('amount')),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: true,
                    tension: 0
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad'
                        },
                        ticks: {
                        stepSize: 1
                        }
                    }
                }
            }
        });
    });
</script>

</html>
