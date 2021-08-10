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
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mt-0 mb-0 header-title">Animales creados</h5>
                        <br>
                        <h6 class="card-title mt-0 mb-0 header-title">En este apartado podra editar un animal,eliminar o modificar en caso de ser necesario.</h6>


                        <table id="example3" class="table table-striped table-bordered dataTable responsive" style="width:100%" role="grid" aria-describedby="example_info">
                            <thead>
                            <tr style="width: 100%">
                                <th  scope="col">Nombre del animal</th>
                                <th  scope="col">Especie del animal</th>
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

        <!------Modal del los eventos------->
        <div class="modal fade" id="modal-evento" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Editar evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-12">

                                <form role="form" id="form-eve" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <p>Seleccione los atributos que desee actualizar</p>
                                        <label for="nameEve">Nombre del evento:</label>
                                        <input type="text" class="form-control" id="nameEve" name="nameEve">
                                    </div>

                                    <div class="form-group">

                                        <label for="descripEve">Descripción del evento:</label>
                                        <input type="text"  class="form-control" name="descripEve" id="descripEve">
                                    </div>
                                    <div class="form-group">
                                        <label for="Horaini">Hora de inicio del evento:</label>
                                        <input type="time" class="form-control" name="Horaini" id="Horaini">
                                    </div>
                                    <div class="form-group">
                                        <label for="Horafin">Hora de finalización del evento:</label>
                                        <input type="time" class="form-control" name="Horafin" id="Horafin">
                                    </div>
                                    <div class="form-group">
                                        <label for="Fechaini">Fecha inicial del evento:</label>
                                        <input type="date" class="form-control" name="Fechaini" id="Fechaini">
                                    </div>
                                    <div class="form-group">
                                        <label for="Fechafin">Fecha final del evento:</label>
                                        <input type="date" class="form-control" name="Fechafin" id="Fechafin">
                                    </div>
                                    <div class="form-group">
                                        <label for="eveimage">Imagen actual del evento:</label>
                                        <br>
                                        <img id="eveimage" name="eveimage" src="" class="img img-thumbnail" width="360px">
                                    </div>
                                    <div class="form-group">
                                        <label for="updafile">Imagen promocional del evento:</label>
                                        <input type="file" class="form-control" name="updafile" id="updafile">
                                    </div>



                                </form>

                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" href="javascript:void(0)" onclick="editEvento()" class="btn btn-outline-primary" data-id="" id="updateeve">Actualizar evento</button>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div>

        <!------Modal del las publicaciones------->
        <div class="modal fade" id="modal-publis" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Editar publicación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-12">

                                <form role="form" id="fomr-publi" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <p>Seleccione los atributos que desee actualizar</p>
                                        <label for="titlepubli">Titulo de la publicación:</label>
                                        <input type="text" class="form-control" id="titlepubli" name="titlepubli">
                                    </div>

                                    <div class="form-group">

                                        <label for="decrippubli">Contenido de la publicación:</label>
                                        <input type="text"  class="form-control" name="decrippubli" id="decrippubli">
                                    </div>

                                    <div class="form-group">
                                        <label for="imagepubli">Imagen actual de la publicación:</label>
                                        <br>
                                        <img id="imagepubli" name="imagepubli" src="" class="img img-thumbnail" width="360px">
                                    </div>


                                    <div class="form-group">
                                        <label for="updaimagefile">Imagen promocional de la publicación:</label>
                                        <input type="file" class="form-control" name="updaimagefile" id="updaimagefile">
                                    </div>



                                </form>

                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" href="javascript:void(0)" data-id="" id="updatePubli" onclick="updatePubli()" class="btn btn-outline-primary">Actualizar Publicación</button>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div>

        <!------Modal del los animales------->
        <div class="modal fade" id="modal-animales" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Editar animal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-12">

                                <form role="form" id="fomr-animal" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <p>Seleccione los atributos que desee actualizar</p>
                                        <label for="animalname">Nombre del animal de la publicación:</label>
                                        <input type="text" class="form-control" id="animalname" name="animalname">
                                    </div>

                                    <div class="form-group">

                                        <label for="especieanimal">Especie del animal:</label>
                                        <input type="text"  class="form-control" name="especieanimal" id="especieanimal">
                                    </div>

                                </form>

                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" href="javascript:void(0)" data-id="" id="updaanimal" onclick="updateAnimal()" class="btn btn-outline-primary">Actualizar Animal</button>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div>

        <!------Modal para el pdf de los eventos------->
        <div class="modal fade" id="modal-evento-pdf" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <iframe src="" style="background-color: #050107" id="pdf-evento" width="100%" height="600px" class="embed-responsive-item" frameborder="0"></iframe>

                        </div>


                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div>

    </div>

@endsection


@push('js')
    <script src="{{ asset('assets/js/functions.js') }}"> </script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
