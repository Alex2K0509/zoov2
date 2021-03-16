@extends('layouts.app2')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mt-0 mb-0 header-title">Evento creados</h5>
                        <br>
                        <h6 class="card-title mt-0 mb-0 header-title">En este apartado podra editar un evento,eliminar o modificar en caso de ser necesario.</h6>


                            <table id="example" class="table table-striped table-bordered dataTable responsive" style="width:100%" role="grid" aria-describedby="example_info">
                                <thead>
                                <tr style="width: 100%">
                                    <th  scope="col">Nombre del evento</th>
                                    <th class="contenido-tablas-descripcion" scope="col">Descripción del evento</th>
                                    <th scope="col">Hora de inicion del evento</th>
                                    <th scope="col">Hora de finalización del evento</th>
                                    <th scope="col">Fecha inicial del evento</th>
                                    <th scope="col">Feche final del evento</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>


                    </div>
                    </div>
                    </div>

            </div>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mt-0 mb-0 header-title">Publicaciones creadas</h5>
                        <br>
                        <h6 class="card-title mt-0 mb-0 header-title">En este apartado podra editar una publicación,eliminar o modificar en caso de ser necesario.</h6>


                        <table id="example2" class="table table-striped table-bordered dataTable responsive" style="width:100%" role="grid" aria-describedby="example_info">
                            <thead>
                            <tr style="width: 100%">
                                <th  scope="col">Animal de la publicación</th>
                                <th  scope="col">Titulo de la publicación</th>
                                <th class="contenido-tablas-descripcion" scope="col">Contenido de la publicación</th>
                                <th scope="col">Fecha de creación</th>
                                <th scope="col">Acciones</th>

                            </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>


                    </div>
                </div>
            </div>

        </div>



    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/functions.js') }}"> </script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
