function addEvento() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    let formEvento = new FormData();
    formEvento.append('name', $('#name').val());
    formEvento.append('eventeimage', $('#eventeimage')[0].files[0]);
    formEvento.append('descrip', $('#descrip').val());
    formEvento.append('dateini', $('#dateini').val());
    formEvento.append('datefin', $('#datefin').val());
    formEvento.append('timeini', $('#timeini').val());
    formEvento.append('timefin', $('#timefin').val());

    //console.log(formJavier.foto);
    Swal.fire({
        title: '¿Estas seguro que deseas crear este evento?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Crear`,
        denyButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Procesando...",
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/evento/add",
                data: formEvento,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.success){
                        $("#upload-image-form").trigger('reset');
                        Swal.fire(response.message, '', 'success')
                    }else{
                        Swal.close();
                        Swal.fire(
                            "Error",
                            response.message,
                            "error"
                        );
                        // alert(response.message)
                    }
                },
            })
            // Swal.fire('Saved!', '', 'success')
        } else if (result.isDenied) {
            //Swal.fire('Changes are not saved', '', 'info')
            Swal.close();
        }
    })


}


function addAnimal(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let formEvento = new FormData();
    formEvento.append('nameAni', $('#nameAni').val());
    formEvento.append('especieAni', $('#especieAni').val());

    //console.log(formJavier.foto);
    Swal.fire({
        title: '¿Estas seguro que deseas almacenar este animal?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Guardar`,
        denyButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Procesando...",
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/animal/add",
                data: formEvento,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.success){
                        $("#upload-animal-form").trigger('reset');
                        //alert(response.message) //Message come from controller
                        Swal.fire(response.message, '', 'success')
                    }else{
                        Swal.close();
                        Swal.fire(
                            "Error",
                            response.message,
                            "error"
                        );
                        // alert(response.message)
                    }
                },
            })
            // Swal.fire('Saved!', '', 'success')
        } else if (result.isDenied) {
            //Swal.fire('Changes are not saved', '', 'info')
            Swal.close();
        }
    })

}

function addPost(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let bar = $('.bar');
    let percent = $('.percent');
    let formPost = new FormData();

    formPost.append('select', $('#select').val());
    formPost.append('title', $('#title').val());
    formPost.append('contenido', $('#contenido').val());
    formPost.append('imageanimal', $('#imageanimal')[0].files[0]);
    //formPost.append('videoanimal', $('#videoanimal')[0].files[0]);


    Swal.fire({
        title: '¿Estas seguro que deseas crear esta publicación?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Crear`,
        denyButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Procesando...",
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/insert/post",
                data: formPost,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.success){
                        //alert(response.message) //Message come from controller
                        $("#upload-information-form").trigger('reset');
                        Swal.fire(response.message, '', 'success')
                    }else{
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo ha salido mal, intente más tarde.!',

                        })
                        // alert(response.message)
                    }
                },
            })
            // Swal.fire('Saved!', '', 'success')
        } else if (result.isDenied) {
            //Swal.fire('Changes are not saved', '', 'info')
            Swal.close();
        }
    })

}

function infoEvento(id){

    Swal.fire({
        title: "Procesando...",
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });
    $.ajax({
        url: "http://127.0.0.1:8000/info/eventos",
        type: "GET",
        dataType: "JSON",
        data: {
            code:id
        }
    })
        .done(function(response) {
            $("#nameEve").val(response.nombre);
            $("#descripEve").val(response.descripcion);
            $("#Horaini").val(response.horaini);
            $("#Horafin").val(response.horafin);
            $("#Fechaini").val(response.fechaini);
            $("#Fechafin").val(response.fechafin);
            //$("#descripEve").val(response.descripcion);
            //$("#descripEve").val(response.image);
            $('#eveimage').attr('src', response.image);
            $('#updateeve').data('id', id);
            $("#modal-evento").modal();
        })
        .fail(function(error) {
            Swal.fire(
                "Error",
                "algo salio mal",
                "error"
            );
        })
        .always(function() {
            Swal.close();
        });
}

function InfoPubli(id){
    Swal.fire({
        title: "Procesando...",
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });
    $.ajax({
        url: "http://127.0.0.1:8000/info/publicaciones",
        type: "GET",
        dataType: "JSON",
        data: {
            code:id
        }
    })
        .done(function(response) {
            $("#titlepubli").val(response.title);
            $("#decrippubli").val(response.descripcion);
            $('#imagepubli').attr('src', response.image);
            $('#updatePubli').data('id', id);

            $("#modal-publis").modal();
        })
        .fail(function(error) {
            Swal.fire(
                "Error",
                "algo salio mal alv",
                "error"
            );
        })
        .always(function() {
            Swal.close();
        });
}

function editEvento(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let id = $('#updateeve').data('id');
    console.log(id);
    let formEvento = new FormData();
    formEvento.append('name', $('#nameEve').val());
    formEvento.append('descrip', $('#descripEve').val());
    formEvento.append('dateini', $('#Fechaini').val());
    formEvento.append('datefin', $('#Fechaini').val());
    formEvento.append('timeini', $('#Horaini').val());
    formEvento.append('timefin', $('#Horafin').val());
    formEvento.append('eventeimage', $('#updafile')[0].files[0]);
    formEvento.append('id', id);
    Swal.fire({
        title: '¿Estas seguro que deseas actulizar este evento?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Actualizar`,
        denyButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Procesando...",
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/edit/eventos",
                data: formEvento,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.success){
                        $("#updafile").trigger('reset');
                        $('#modal-evento').modal('hide');
                        $('#example').DataTable().ajax.reload();
                        Swal.fire(response.message, '', 'success')
                    }else{
                        Swal.close();
                        Swal.fire(
                            "Error",
                            response.message,
                            "error"
                        );
                        // alert(response.message)
                    }
                },
            })

        } else if (result.isDenied) {

            Swal.close();
        }
    })


}

function deleteEvento(id){
    //console.log(id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
//let codigo = id;
    Swal.fire({
        title: '¿Estas seguro que deseas eliminar este evento?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Eliminar`,
        denyButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Procesando...",
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                type: "DELETE",
                url: "http://127.0.0.1:8000/delete/evento",
                dataType: "JSON",
                data: {
                   code: id
                },
                success:function(response){
                    if(response.success){
                        //$("#upload-animal-form").trigger('reset');
                        //alert(response.message) //Message come from controller
                        $('#example').DataTable().ajax.reload();
                        Swal.fire(response.message, '', 'success')
                    }else{
                        Swal.close();
                        Swal.fire(
                            "Error",
                            response.message,
                            "error"
                        );
                        // alert(response.message)
                    }
                },
            })
            // Swal.fire('Saved!', '', 'success')
        } else if (result.isDenied) {
            //Swal.fire('Changes are not saved', '', 'info')
            Swal.close();
        }
    })





}


function updatePubli(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let id = $('#updatePubli').data('id');
    //console.log(id);
    let formPubli = new FormData();
    formPubli.append('titlepubli', $('#titlepubli').val());
    formPubli.append('decrippubli', $('#decrippubli').val());
    formPubli.append('updaimagefile', $('#updaimagefile')[0].files[0]);
    formPubli.append('id', id);
    Swal.fire({
        title: '¿Estas seguro que deseas actulizar esta publicación?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Actualizar`,
        denyButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Procesando...",
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/edit/pubs",
                data: formPubli,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.success){
                        //$("#updafile").trigger('reset');
                        $('#modal-publis').modal('hide');
                        $('#example2').DataTable().ajax.reload();
                        Swal.fire(response.message, '', 'success')
                    }else{
                        Swal.close();
                        Swal.fire(
                            "Error",
                            response.message,
                            "error"
                        );
                        // alert(response.message)
                    }
                },
            })

        } else if (result.isDenied) {

            Swal.close();
        }
    })
}

function deletePub(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    Swal.fire({
        title: '¿Estas seguro que deseas eliminar esta publicación?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Eliminar`,
        denyButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Procesando...",
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                type: "DELETE",
                url: "http://127.0.0.1:8000/delete/pub",
                dataType: "JSON",
                data: {
                    code: id
                },
                success:function(response){
                    if(response.success){
                        //$("#upload-animal-form").trigger('reset');
                        //alert(response.message) //Message come from controller
                        $('#example2').DataTable().ajax.reload();
                        Swal.fire(response.message, '', 'success')
                    }else{
                        Swal.close();
                        Swal.fire(
                            "Error",
                            response.message,
                            "error"
                        );
                        // alert(response.message)
                    }
                },
            })
            // Swal.fire('Saved!', '', 'success')
        } else if (result.isDenied) {
            //Swal.fire('Changes are not saved', '', 'info')
            Swal.close();
        }
    })

}

function infoAnimals(id){
    Swal.fire({
        title: "Procesando...",
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });
    $.ajax({
        url: "http://127.0.0.1:8000/info/animals",
        type: "GET",
        dataType: "JSON",
        data: {
            code:id
        }
    }).done(function(response) {
        $("#animalname").val(response.nombre);
        $("#especieanimal").val(response.especie);
        $('#updaanimal').data('id', id);
        $("#modal-animales").modal();
    }).fail(function(error) {
            Swal.fire(
                "Error",
                "algo salio mal",
                "error"
            );
        })
        .always(function() {
            Swal.close();
        });

}

function updateAnimal(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let id = $('#updaanimal').data('id');
    let formAnimal = new FormData();
    formAnimal.append('animalname', $('#animalname').val());
    formAnimal.append('especieanimal', $('#especieanimal').val());
    formAnimal.append('id', id);
    Swal.fire({
        title: '¿Estas seguro que deseas actulizar esta animal?',
        text: "En caso de que el animal tenga publicaciones creadas, los datos del animal igual se modificaran en ella.",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Actualizar`,
        denyButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Procesando...",
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/edit/animals",
                data: formAnimal,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.success){
                        //$("#updafile").trigger('reset');
                        $('#modal-animales').modal('hide');
                        $('#example3').DataTable().ajax.reload();
                        Swal.fire(response.message, '', 'success')
                    }else{
                        Swal.close();
                        Swal.fire(
                            "Error",
                            response.message,
                            "error"
                        );
                        // alert(response.message)
                    }
                },
            })

        } else if (result.isDenied) {

            Swal.close();
        }
    })



}

function deleteAnimals(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    Swal.fire({
        title: '¿Estas seguro que deseas eliminar este animal?',
        text: "En caso de que el animal tenga publicaciones creadas, estas igual se eliminaran.",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Eliminar`,
        denyButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Procesando...",
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                type: "DELETE",
                url: "http://127.0.0.1:8000/delete/animals",
                dataType: "JSON",
                data: {
                    code: id
                },
                success:function(response){
                    if(response.success){
                        //$("#upload-animal-form").trigger('reset');
                        //alert(response.message) //Message come from controller
                        $('#example3').DataTable().ajax.reload();
                        $('#example2').DataTable().ajax.reload();
                        Swal.fire(response.message, '', 'success')
                    }else{
                        Swal.close();
                        Swal.fire(
                            "Error",
                            response.message,
                            "error"
                        );
                        // alert(response.message)
                    }
                },
            })
            // Swal.fire('Saved!', '', 'success')
        } else if (result.isDenied) {
            //Swal.fire('Changes are not saved', '', 'info')
            Swal.close();
        }
    })

}

function notiEvento(id){
    //console.log(id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    Swal.fire({
        title: '¿Estas seguro que deseas enviar notificación de este evento?',

        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Enviar`,
        denyButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Procesando...",
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/notification/eventos",
                dataType: "JSON",
                data: {
                    code: id
                },
                success:function(response){
                    if(response.success){
                        //$("#upload-animal-form").trigger('reset');
                        //alert(response.message) //Message come from controller
                        //$('#example3').DataTable().ajax.reload();
                        //$('#example2').DataTable().ajax.reload();
                        Swal.fire(response.message, '', 'success')
                    }else{
                        Swal.close();
                        Swal.fire(
                            "Error",
                            response.message,
                            "error"
                        );
                        // alert(response.message)
                    }
                },
            })
            // Swal.fire('Saved!', '', 'success')
        } else if (result.isDenied) {
            //Swal.fire('Changes are not saved', '', 'info')
            Swal.close();
        }
    })

}

function notiPost(id){
   // console.log(id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    Swal.fire({
        title: '¿Estas seguro que deseas enviar notificación de esta publicación?',

        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Enviar`,
        denyButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Procesando...",
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/notification/post",
                dataType: "JSON",
                data: {
                    code: id
                },
                success:function(response){
                    if(response.success){


                        Swal.fire(response.message, '', 'success')
                    }else{
                        Swal.close();
                        Swal.fire(
                            "Error",
                            response.message,
                            "error"
                        );
                        // alert(response.message)
                    }
                },
            })
            // Swal.fire('Saved!', '', 'success')
        } else if (result.isDenied) {
            //Swal.fire('Changes are not saved', '', 'info')
            Swal.close();
        }
    })

}

$(document).ready(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    //tabla para editar eventos
    const table = $('#example').DataTable({
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        processing: true,
        serverSide: true,
        ajax:  '/table/eventos',
        autoWidth: false,
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columns: [
            {
                data: 'eventonombre',
                name: 'eventonombre'
            },
            {
                data: 'eventodescrip',
                name: 'eventodescrip'
            },
            {
                data: 'eventohoraini',
                name: 'eventohoraini'
            },{
                data: 'eventohorafin',
                name: 'eventohorafin'
            },
            {
                data: 'eventofechaini',
                name: 'eventofechaini'
            }, {
                data: 'eventofechafin',
                name: 'eventofechafin'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        columnDefs: [{
            "targets": 1, // your case first column
            "className": "contenido-tablas-descripcion"

        }],
        drawCallback: function () {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
    //select2 para los animales
    const select2 = $( "#select" ).select2({

        ajax: {
            url: "http://127.0.0.1:8000/all/animals",
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    _token: CSRF_TOKEN,
                    search: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });
    //tabla para edotar publicaciones
    const table2 = $('#example2').DataTable({
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        processing: true,
        serverSide: true,
        ajax:  '/table/pubs',
        autoWidth: false,
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columns: [
            {
                data: 'animalpub',
                name: 'animalpub'
            },
            {
                data: 'titulopub',
                name: 'titulopub'
            },
            {
                data: 'contenidopub',
                name: 'contenidopub'
            },{
                data: 'createdpub',
                name: 'createdpub'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        columnDefs: [{
            "targets": 1, // your case first column
            "className": "contenido-tablas-descripcion"

        }],
        drawCallback: function () {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
    //tabla para editar animales
    const table3 = $('#example3').DataTable({
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        processing: true,
        serverSide: true,
        ajax:  '/table/animals',
        autoWidth: false,
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columns: [
            {
                data: 'animalname',
                name: 'animalname'
            },
            {
                data: 'especieAnimal',
                name: 'especieAnimal'
            },
            {
                data: 'dateAnimal',
                name: 'dateAnimal'
            },{
                data: 'action',
                name: 'action'
            }
        ],
        columnDefs: [{
            "targets": 1, // your case first column
            "className": "contenido-tablas-descripcion"

        }],
        drawCallback: function () {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });

    //configuración para el envio de notificaciones
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyDNXPU2AOpPbxSs69xsycsxeN8mVTDA1RY",
        authDomain: "zooprueba-c9677.firebaseapp.com",
        projectId: "zooprueba-c9677",
        storageBucket: "zooprueba-c9677.appspot.com",
        messagingSenderId: "56957819674",
        appId: "1:56957819674:web:042c79611cb6cae493eaa3",
        measurementId: "G-5JCB1G60TE"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    //firebase.analytics();
    const messaging = firebase.messaging();
    messaging
        .requestPermission()
        .then(function() {
            //MsgElem.innerHTML = "Notification permission granted."
            console.log("Notification permission granted.");

            // get the token in the form of promise
            return messaging.getToken()
        })
        .then(function(token) {
            // print the token on the HTML page
            console.log(token);



        })
        .catch(function(err) {
            console.log("Unable to get permission to notify.", err);
        });

    messaging.onMessage(function(payload) {
        console.log(payload);
        var notify;
        notify = new Notification(payload.notification.title, {
            body: payload.notification.body,
            icon: payload.notification.icon,
            tag: "Dummy"
        });
        console.log(payload.notification);
    });

    //firebase.initializeApp(config);
    var database = firebase.database().ref().child("/users/");

    database.on('value', function(snapshot) {
        renderUI(snapshot.val());
    });

    // On child added to db
    database.on('child_added', function(data) {
        console.log("Comming");
        if (Notification.permission !== 'default') {
            var notify;

            notify = new Notification('CodeWife - ' + data.val().username, {
                'body': data.val().message,
                'icon': 'bell.png',
                'tag': data.getKey()
            });
            notify.onclick = function() {
                alert(this.tag);
            }
        } else {
            alert('Please allow the notification first');
        }
    });

    self.addEventListener('notificationclick', function(event) {
        event.notification.close();
    });

});

