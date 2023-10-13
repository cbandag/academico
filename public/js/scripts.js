$(document).ready(function() {

  //Datatable
/*
  $("#users").DataTable({
    "responsive": true,
    "lengthChange": false,
    "autoWidth": true,
    "buttons": ["colvis"],

    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }

  }).buttons().container().appendTo('#users_wrapper .col-md-6:eq(0)');

  $('#accounts').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,

    "language":{
      "lengthMenu": "Mostrar _MENU_ registros por página.",
      "zeroRecords": "No se encuentra el registro.",
      "info":"Mostrando página _PAGE_ de _PAGES_",
      "InfoEmpty":"Ningun registro disponible",
      "infoFiltered": "(Mostrando de _MAX_ registros totales.)",
      "search": "Buscar:",
      "paginate":{
        "next":"siguiente",
        "previus": "anterior"
      }
    }
  });
*/



//Date picker
/*
$('#datetimepicker-year').datetimepicker({
    viewMode: 'years',
    format: 'YYYY'
});

$('#datetimepicker-today').datetimepicker({
  date: 'null',

});*/



//Date and time picker
//$('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

//Date range picker
//$('#reservation').daterangepicker()

//Date range picker with time picker
/*$('#reservationtime').daterangepicker({
  timePicker: true,
  timePickerIncrement: 30,
  locale: {
    format: 'MM/DD/YYYY hh:mm A'
  }
})*/
//Date range as a button
/*$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Today'       : [moment(), moment()],
      'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month'  : [moment().startOf('month'), moment().endOf('month')],
      'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate  : moment()
  },
  function (start, end) {
    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
  }
)
*/
//Timepicker
/*
$('#timepicker').datetimepicker({
  format: 'LT'
})*/
















/*
    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Guardado con éxito')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
*/

});
