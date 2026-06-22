$(function () {

    let id = document.querySelector("table").id;

    $('#'+id).DataTable({

        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        language: {
            "paginate": {
                "first": lang.first,
                "last": lang.last,
                "next": lang.next,
                "previous": lang.previous
            },
            "lengthMenu": lang.lengthMenu,
            "zeroRecords": lang.zeroRecords,
            "info": lang.info,
            "infoEmpty": lang.infoEmpty,
            "infoFiltered": lang.infoFiltered,
            "search": lang.search,
            "loadingRecords": lang.loadingRecords,
            "processing":   lang.processing,
            "emptyTable": lang.emptyTable,
        },
    });


    $("#checkAll").on("click", function () {
        $(".dt-checkbox").prop("checked", this.checked);
    });
    
});