<!DOCTYPE html>
<html lang="es">
<head>
@extends('layouts.plantilla')

@section('title', 'SmartWalls')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #1DC1D0;
            font-family: "Open Sans", sans-serif;
        }
        .container {
            padding-top: 20px;
            padding-bottom: 20px;
        }
        h2 {
            color: #070A1A;
            font-weight: bold;
        }
        .chart-container {
            width: 100%;
            height: 300px;
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .chart-title {
            font-size: 16px;
            font-weight: bold;
            color: #070A1A;
            margin-bottom: 10px;
            text-align: center;
        }
        .row {
            margin-top: 20px;
        }
        .alerta {
            background-color: #FF4500;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            text-align: center;
            font-weight: bold;
            display: none;
        }
        .casa-info {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .casa-nombre {
            font-size: 18px;
            font-weight: bold;
            color: #070A1A;
        }
        .casa-fecha {
            font-size: 14px;
            color: #6c757d;
        }
        .no-data {
            text-align: center;
            padding: 50px 0;
            color: #6c757d;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Gráficas</h2>
        <div class="casa-info text-center">
            <div class="casa-nombre">{{ $casaNombre }}</div>
            <div class="casa-fecha">Fecha: {{ $fechaActual }}</div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="chart-container">
                    <div class="chart-title">Modos Iniciados</div>
                    <canvas id="modosChart"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <div class="chart-title">Sensores Activados</div>
                    <canvas id="sensoresChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <div class="chart-title">Niveles de Gas</div>
                    <canvas id="gasChart"></canvas>
                    @if($alertaGas)
                        <div id="alertaGas" class="alerta" style="display: block;">ALERTA: Nivel alto de gas detectado</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };
        function createChart(ctx, type, labels, data, label, colors) {
            if (data.every(item => item === 0)) {
                const container = ctx.canvas.parentNode;
                ctx.canvas.style.display = 'none';
                const noDataMsg = document.createElement('div');
                noDataMsg.className = 'no-data';
                noDataMsg.textContent = 'No hay datos disponibles';
                container.appendChild(noDataMsg);
                return null;
            }
            return new Chart(ctx, {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: colors,
                        borderColor: colors.map(color => type === 'line' ? color : color),
                        borderWidth: 1
                    }]
                },
                options: chartOptions
            });
        }
        const modosLabels = {!! json_encode(array_keys($conteoModos)) !!};
        const modosData = {!! json_encode(array_values($conteoModos)) !!};
        const sensoresLabels = {!! json_encode(array_keys($conteoSensoresActivados)) !!};
        const sensoresData = {!! json_encode(array_values($conteoSensoresActivados)) !!};
        const nivelesGasLabels = {!! json_encode(array_keys($nivelesGas)) !!};
        const nivelesGasData = {!! json_encode(array_values($nivelesGas)) !!};
        const formattedModosLabels = modosLabels.map(label => 
            label.charAt(0).toUpperCase() + label.slice(1)
        );
        const formattedNivelesGasLabels = nivelesGasLabels.map(label => 
            label.charAt(0).toUpperCase() + label.slice(1)
        );
        createChart(
            document.getElementById('modosChart').getContext('2d'), 
            'bar', 
            formattedModosLabels, 
            modosData, 
            'Modos Activados', 
            ['#23E9BF', '#1E98D7', '#070A1A']
        );
        createChart(
            document.getElementById('sensoresChart').getContext('2d'), 
            'bar', 
            sensoresLabels, 
            sensoresData, 
            'Sensores Activados', 
            ['#1E98D7', '#070A1A']
        );
        createChart(
            document.getElementById('gasChart').getContext('2d'), 
            'bar', 
            formattedNivelesGasLabels, 
            nivelesGasData, 
            'Niveles de Gas', 
            ['#90EE90', '#FFD700', '#FF4500']
        );
    </script>
</body>
</html>