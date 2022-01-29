var datatable;
var DatatablesSearchOptionsColumnSearch = function () {
    $.fn.dataTable.Api.register("column().title()", function () {
        return $(this.header()).text().trim()
    });
    return {
        init: function () {
            (datatable = $("#m_table_1").DataTable({
                    responsive: !0,
                    dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                    pageLength: 100,
                    language: window.lang,
                    searchDelay: 500,
                    processing: !0,
                    serverSide: !0,
                    select: false,
                    order: [[0, "desc"]],
                    ajax: window.data_url,
                    columns: window.columns,
                    "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                        var index = iDisplayIndex +1;
                        $('td:eq(0)',nRow).html(index);
                        return nRow;
                    },
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
