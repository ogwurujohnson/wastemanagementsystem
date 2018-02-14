$(function () {
    $('.js-basic-example').DataTable();

    //Exportable table
    $('.js-exportable').DataTable({

        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax":{
            url :"https://localhost/gafista/api/client/clientproperty", // json datasource
            type: "post",  // method  , by default get

        }
    });
});