@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <div class="header bg-default-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mt-7 mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-white">{{ __('Bienvenido al zoo-control.') }}</h1>



                    </div>
<br>
                    <div class="card" style="width: 18rem; align-content: center;">
                        <div class="card-header">
                            El clima
                        </div>

                        <ul class="list-group list-group-flush"style="text-align: left;">
                            <li class="list-group-item">Fecha y Hora: {{$information['datehour']}} </li>
                            <li class="list-group-item">Temperatura: {{$information['temp']}} grados</li>
                            <li class="list-group-item">Humeda: {{$information['humedad']}} grados</li>
                            <li class="list-group-item">Velocidad del viento: {{$information['velocidadViento']}} km/h</li>
                            <li class="list-group-item">Temp minima: {{$information['temperatura_min']}} grados</li>
                            <li class="list-group-item">Temp maxima: {{$information['temperatura_max']}} grados</li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="container mt--10 pb-5"></div>

@include('layouts.footers.guest')
@endsection
