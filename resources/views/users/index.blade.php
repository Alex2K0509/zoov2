@extends('layouts.app')

@section('content')
    @include('layouts.headers.header')

    <div class="container-fluid mt--7" style="background-color: white">

        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">

                        <form id="upload-image-form" enctype="multipart/form-data" method="post" >
                            @csrf
                            <div class="form-group">
                                <p>Catalogo de eventos</p>
                                <h5>Mediante este formulario podrá registrar un nuevo evento del zoologico</h5>
                              <label for="name">Nombre del evento:</label>
                              <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="name">Descripción del evento:</label>
                                <input type="text" class="form-control" id="descrip" name="descrip">
                            </div>
                            <div class="form-group">
                              <label for="dateini">Fecha de inico:</label>
                              <input type="date" class="form-control" id="dateini" name="dateini">
                            </div>
                            <div class="form-group">
                                <label for="datefin">Fecha de fin:</label>
                                <input type="date" class="form-control" id="datefin" name="datefin">
                              </div>

                              <div class="form-group">
                                <label for="timeini">Hora de inicio:</label>
                                <input type="time" class="form-control" id="timeini" name="timeini">
                              </div>
                              <div class="form-group">
                                <label for="timefin">Hora de fin:</label>
                                <input type="time" class="form-control" id="timefin" name="timefin">
                              </div>
                              <div class="form-group">
                                <label for="eventeimage">Imagen promocional del evento</label>
                                <input  type="file" class="form-control" id="eventeimage" name="eventeimage">
                              </div>
                              <button type="button" class="btn btn-primary" href="javascript:void(0)" onclick="addEvento()">Guardar evento</button>

                          </form>
                    </div>

                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <form role="form" id="upload-animal-form" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <p>Catalogo de animales</p>
                                <h5>Mediante este formulario podrás agregar registros de las especies de animales con las que cuente el zoo</h5>
                              <label for="nameAni">Nombre del animal:</label>
                              <input type="text" class="form-control" id="nameAni" name="nameAni">
                            </div>
                            <div class="form-group">
                              <label for="especieAni">Especie del animal:</label>
                              <input type="text" class="form-control" name="especieAni" id="especieAni">
                            </div>



                            <button type="button" href="javascript:void(0)" onclick="addAnimal()" class="btn btn-default">Guardar</button>
                          </form>
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
