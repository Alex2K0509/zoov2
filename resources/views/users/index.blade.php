@extends('layouts.app')

@section('content')
    @include('layouts.headers.header')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

    <style>
        .progress { position:relative; width:100%; }
        .bar { background-color: #00ff00; width:0%; height:20px; }
        .percent { position:absolute; display:inline-block; left:50%; color: #040608;}
    </style>
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
                                <label for="eventeimage">Imagen promocional del evento (Opcional):</label>
                                <input  type="file" class="form-control" id="eventeimage" name="eventeimage">
                              </div>
                              <button type="button" class="btn btn-primary" href="javascript:void(0)" onclick="addEvento()">Publicar evento</button>

                          </form>
                    </div>

                </div>
            </div>            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <form role="form" id="upload-animal-form" enctype="multipart/form-data" method="post">
                            @csrf
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
                            <div class="form-group">
                                <label for="imageAni">Imagen del animal (Opcional):</label>
                                <input type="file" class="form-control" name="imageAni" id="imageAni">
                            </div>


                            <button type="button" href="javascript:void(0)" onclick="addAnimal()" class="btn btn-default">Almacenar animal</button>
                          </form>
                    </div>

                </div>
            </div>


        </div>
        <div class="row mt-5">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">

                    <form id="upload-information-form" enctype="multipart/form-data" method="post" >
                        @csrf
                        <div class="form-group">
                            <p>publicaciones para los animales</p>
                            <h5>Mediante este formulario podras crear publicaciones de algun animales que haya creado previamente,</h5>
                        </div>
                        <div class="form-group">
                            <label for="select">Lista de animales disponibles:</label>
                            <br>
                            <select name="select" id='select' style='width: 200px;' class="form-control">
                                <option value=''> Seleccione un animal</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Titulo de la publiación:</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="name">Contenido de la publicación:</label>
                            <input type="text" class="form-control" id="contenido" name="contenido">
                        </div>

                        <div class="form-group">
                            <label for="eventeimage">Imagen de la publicación (Opcional):</label>
                            <input  type="file" class="form-control" id="imageanimal" name="imageanimal">
                        </div>

              <button type="button" class="btn btn-primary" href="javascript:void(0)" onclick="addPost()">Crear publicación</button>

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
