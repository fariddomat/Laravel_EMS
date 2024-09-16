$(document).ready(function() {
    var categoriesTable = $("#categoriesTable").DataTable({
        searching: false,
        paging: false,
        info: false,
        columnDefs: [{ orderable: false, targets: [3] }],
        rowReorder: true
    });

    categoriesTable.on("row-reorder", function(e, diff, edit) {
        var length = diff.length - 1;
        if (length > 0) {
            var to = [];
            to[diff[0].oldData] = diff[0].newData;
            to[diff[length].oldData] = diff[length].newData;
            var from = edit.triggerRow.data()[0];
            var token = $("meta[name=csrf-token]").attr("content");
            $.ajax({
                url: CategoriesReorderRoute,
                type: "POST",
                data: {
                    _token: token,
                    from: from,
                    to: to[from]
                },
                cache: false,
                datatype: "JSON",
                success: function(data) {
                    if (data.status != 1) {
                        alert("error occurred in reordering.");
                        location.reload(true);
                    } else {
                        alert("reorder done.");
                    }
                },
                error: function() {
                    alert("error.");
                    location.reload(true);
                }
            });
        }
    });
});
