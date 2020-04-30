function table(records)
{
    return $('#table'+records);
}

function resourceUrl(records, parent = null, parentId = null)
{
    return parentId
        ? '/admin/' + parent + '/' + parentId + '/' + records.toLowerCase() + '/list'
        : '/admin/' + records.toLowerCase() + '/list';
}

$.fn.rowsCount = function() {
    return $(this).data().count();
};

$.fn.columnCount = function() {
    return $('th', $(this).find('thead')).length;
};

$.fn.columnIndex = function(index = 1) {
    return $(this).columnCount() - index;
};

function reloadDataTable(datatable) {
    datatable.ajax.reload();
}

function counterFirstColumn (datatable) {
    return datatable.on( 'order.dt search.dt', function () {
            datatable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
        } );
    } ).draw();
}


