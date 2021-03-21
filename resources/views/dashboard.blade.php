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

                                <form role="form" id="upload-animal-form" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <p>Seleccione los atributos que desee actualizar</p>
                                        <label for="nameEve">Nombre del evento:</label>
                                        <input type="text" class="form-control" id="nameEve" name="nameEve">
                                    </div>

                                    <div class="form-group">
                                        
                                        <label for="descripEve">Descripción del evento:</label>
                                        <input type="text" class="form-control" name="descripEve" id="descripEve">
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
                                        <label for="eveimage">Imagen promocional del evento:</label>
                                        <input type="file" class="form-control" name="eveimage" id="eveimage">
                                    </div>



                                </form>

                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" href="javascript:void(0)" onclick="updateEve()" class="btn btn-outline-primary">Actualizar evento</button>

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
