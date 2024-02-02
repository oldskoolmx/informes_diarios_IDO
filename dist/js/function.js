
function fntAddPersona(id){

    Swal.fire(
        'Good job!',
        'You clicked the button!',
        'success'
      );
}


function fntDelPersona(id){

Swal.fire({
    title: 'Relamente quiere eleminar el registro?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminando registro!'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
      )
    } else {
        Swal("Se a cancelado la accion")
    }
  });
}