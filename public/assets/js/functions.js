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

$(document).ready(function() {
//tabla para editar eventos
    const table = $('#example').DataTable({
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        processing: true,
        serverSide: true,
        ajax:  '/table/eventos',
        autoWidth: false,
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

        drawCallback: function () {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });


} );

