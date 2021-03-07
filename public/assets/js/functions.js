function addEvento() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let url = "{{route('eventoInsert')}}";
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

            // Swal.fire('Saved!', '', 'success')
        } else if (result.isDenied) {
            //Swal.fire('Changes are not saved', '', 'info')
            Swal.close();
        }
    })


}