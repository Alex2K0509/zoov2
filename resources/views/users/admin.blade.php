@extends('layouts.app2')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mt-0 mb-0 header-title">Centro de adminitradores</h5>
                        <br>
                        <h6 class="card-title mt-0 mb-0 header-title">En este apartado podras crear,bloquear o eliminar administradores.</h6>
                        <br>
                        <button type="button" data-target="#modal-crear"  data-toggle="modal" class="btn btn-outline-success btn-sm">Crear administrador</button>
                        <br>
                        <br>
                        <table id="adminTable" class="table table-striped table-bordered dataTable responsive" style="width:100%" role="grid" aria-describedby="example_info">
                            <thead>
                            <tr style="width: 100%">
                                <th  scope="col">Nombre del administrador</th>
                                <th class="contenido-tablas-descripcion" scope="col">Correo electronico</th>
                                <th scope="col">Estado de la cuenta</th>
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



        <!------Modal para crear administradores------->
        <div class="modal fade" id="modal-crear" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Crear administrador</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-12">

                                <form role="form" id="form-admin" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <p>Seleccione los atributos que desee actualizar</p>
                                        <label for="nameAdmin">Nombre:</label>
                                        <input type="text" class="form-control" id="nameAdmin" name="nameAdmin">
                                    </div>

                                    <div class="form-group">

                                        <label for="apepatAdmin">Apellido paterno:</label>
                                        <input type="text"  class="form-control" name="apepatAdmin" id="apepatAdmin">
                                    </div>

                                    <div class="form-group">

                                        <label for="apematAdmin">Apellido Materno:</label>
                                        <input type="text"  class="form-control" name="apematAdmin" id="apematAdmin">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailAdmin">Correo electronico:</label>
                                        <input type="email" class="form-control" name="emailAdmin" id="emailAdmin">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailAdmin">Contraseña:</label>
                                        <input type="password" class="form-control" name="paswordAdmin" id="paswordAdmin">
                                    </div>

                                </form>

                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" href="javascript:void(0)" onclick="createAdmin()" class="btn btn-outline-primary" data-id="" id="updateeve">Crear administrador.</button>

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
