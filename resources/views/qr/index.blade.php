@extends('layouts.app2')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mt-0 mb-0 header-title">Centro de códigos</h5>
                        <br>
                        <h6 class="card-title mt-0 mb-0 header-title">En este apartado podrás crear, editar o eliminar códigos QR.</h6>
                        <br>
                        <button type="button" data-target="#modal-crear"  data-toggle="modal" class="btn btn-outline-success btn-sm">Crear QR</button>
                        <br>
                        <br>
                        <table id="qrTable" class="table table-striped table-bordered dataTable responsive" style="width:100%" role="grid" aria-describedby="example_info">
                            <thead>
                            <tr style="width: 100%">
                                <th  scope="col">Nombre</th>
                                <th class="contenido-tablas-descripcion" scope="col">Imagen</th>
                                <th scope="col">QR</th>
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
                        <h5 class="modal-title" id="myLargeModalLabel">Crear QR</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-12">

                                <form role="form" id="form-admin" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <label for="nameQR">Nombre:</label>
                                        <input type="text" class="form-control" id="nameQR" name="nameQR">
                                    </div>

                                    <div class="form-group">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col">
                                        <label for="imageQR">Imagen:</label>
                                        <input type='file' class="form-control" id="imageQR" name="imageQR"/>
                                            </div>
                                                <div class="col">
                                        <img id="preImage" src="#" alt="Aun no has cargado una imagen" style="width: 200px; height: 200px"/>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" href="javascript:void(0)" onclick="createQr()" class="btn btn-outline-primary" data-id="" id="updateeve">Crear QR.</button>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-diaflog -->

        </div>

    </div>

    <script>
        imageQR.onchange = evt => {
            const [file] = imageQR.files
            if (file) {
                preImage.src = URL.createObjectURL(file)
            }
        }
    </script>

@endsection


@push('js')
    <script src="{{ asset('assets/js/functions.js') }}"> </script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
