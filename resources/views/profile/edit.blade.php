@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Bienvenido') . ' '. auth()->user()->name,
        'description' => __('En esta sección podrás modificar tu información personal, como tu imagen, contraseña o datos privados.'),
        'class' => 'col-lg-7'
    ])

    <div  class="container-fluid mt--7" style="background-color: white">
        <div class="row" >
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image" id="divImage">
                                <a>
                                    <img src="{{empty(auth()->user()->getPic()) ?"/assets/img/default.jpg":auth()->user()->getPic()   }}"  alt="Image placeholder" id="picimage">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">

                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">

                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 id="h3-name">
                                {{ auth()->user()->name }}<span class="font-weight-light"></span>
                            </h3>
                            <form role="form"  id="formPic" enctype="multipart/form-data" method="post" >

                                <input type="file" class="form-control" id="imagep" name="imagep" >

                              </form>
                            <br>
                            <button href="javascript:void(0)" onclick="editPic()"
                                    class="btn btn-outline-primary"
                                    title="Actualizar imagen">
                                Actualizar imagen</button>
                        </div>
                        <img>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card card-profile shadow">
                    <div class="text-center">
                        <h3 id="h3-name">
                           <span class="font-weight-light">Información</span>
                        </h3>
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <form>
                            <div class="form-group">
                                <label class="form-control-label" for="input-current-password">Nombre:</label>
                                <input type="text" name="nombre" id="input-name" class="form-control form-control-alternative"  placeholder=" {{ auth()->user()->name }}" value="" required="">

                            </div>

                        </form>
                        <br>
                        <div class="text-center">
                            <button href="javascript:void(0)" onclick="editInfo()"
                                    class="btn btn-outline-primary"
                                    title="Actualizar información">
                                Actualizar información</button>
                        </div>


                </div>
            </div>

        </div>
            <br>
            <div class="col-xl-4">
                <br>
                <div class="card card-profile shadow">
                    <div class="text-center">
                        <h3 id="h3-name">
                           <span class="font-weight-light">Contraseña</span>
                        </h3>
                    </div>
                    <form >

                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-current-password">{{ __('Contraseña actual') }}</label>
                                <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Contraseña actual') }}"  required>

                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="input-password">{{ __('Nueva contraseña') }}</label>
                                <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Nueva contraseña') }}"  required>

                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="input-password-confirmation">{{ __('Confirma la contraseña') }}</label>
                                <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirmar nueva contraseña') }}"  required>
                            </div>


                        </div>
                    </form>
                    <div class="text-center">
                        <button href="javascript:void(0)" onclick="editPass()"
                                class="btn btn-outline-primary"
                                title="Actualizar contraseña">
                            Actualizar contraseña</button>
                    </div>


                </div>
            </div>

        </div>




    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/functions.js') }}"> </script>

@endpush
