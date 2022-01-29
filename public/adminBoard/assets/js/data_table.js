var datatable;
var DatatablesSearchOptionsColumnSearch = function () {
    $.fn.dataTable.Api.register("column().title()", function () {
        return $(this.header()).text().trim()
    });
    return {
        init: function () {
            (datatable = $("#m_table_1").DataTable({
                    /*dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],*/
                    responsive: !0,
                    dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                    lengthMenu: [5, 10, 25, 50],
                    pageLength: 10,
                    language: window.lang,
                    searchDelay: 500,
                    processing: !0,
                    serverSide: !0,
                    select: false,
                    order: [[0, "desc"]],
                    ajax: window.data_url,
                    columns: window.columns,

                })
            )
        }
    }
}();
jQuery(document).ready(function () {
    DatatablesSearchOptionsColumnSearch.init()
});

function updateDataTable() {
    datatable.ajax.reload();
}

jQuery(document).on("keyup", '#generalSearch', function () {
    datatable.column(0).search($(this).val(), !1, !1)
    datatable.table().draw()
});
