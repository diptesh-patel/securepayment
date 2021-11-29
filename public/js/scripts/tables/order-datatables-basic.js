$((function() {
    "use strict";
    var e = $(".datatables-basic"),
        o = "../../../app-assets/";
    if ("laravel" === $("body").attr("data-framework") && (o = $("body").attr("data-asset-path")), e.length) {
        var n = e.DataTable({
            ajax: o + "data/table-datatable.json",
            columns: [{
                data: "responsive_id"
            }, {
                data: "id"
            }, {
                data: "id"
            }, {
                data: "full_name"
            }, {
                data: "email"
            }, {
                data: "start_date"
            }, {
                data: "salary"
            },  {
                data: ""
            }],
            columnDefs: [{
                className: "control",
                orderable: !1,
                responsivePriority: 2,
                targets: 0
            }, {
                targets: 1,
                orderable: !1,
                responsivePriority: 3,
                render: function(e, t, a, s) {
                    return '<div class="form-check"> <input class="form-check-input dt-checkboxes" type="checkbox" value="" id="checkbox' + e + '" /><label class="form-check-label" for="checkbox' + e + '"></label></div>'
                },
                checkboxes: {
                    selectAllRender: '<div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="form-check-label" for="checkboxSelectAll"></label></div>'
                }
            }, {
                targets: 2,
                visible: !1
            }, {
                targets: 3,
                responsivePriority: 4,
                render: function(e, t, a, s) {
                    var l = a.avatar,
                        n = a.full_name,
                        r = a.post;
                    if (l) var d = '<img src="' + o + "images/avatars/" + l + '" alt="Avatar" width="32" height="32">';
                    else {
                        var i = ["success", "danger", "warning", "info", "dark", "primary", "secondary"][a.status],
                            c = (n = a.full_name).match(/\b\w/g) || [];
                        d = '<span class="avatar-content">' + (c = ((c.shift() || "") + (c.pop() || "")).toUpperCase()) + "</span>"
                    }
                    return '<div class="d-flex justify-content-left align-items-center"><div class="avatar ' + ("" === l ? " bg-light-" + i + " " : "") + ' me-1">' + d + '</div><div class="d-flex flex-column"><span class="emp_name text-truncate fw-bold">' + n + '</span><small class="emp_post text-truncate text-muted">' + r + "</small></div></div>"
                }
            }, {
                responsivePriority: 1,
                targets: 4
            }, {
                targets: -1,
                title: "Actions",
                orderable: !1,
                render: function(e, t, a, s) {
                    return '<div class="d-inline-flex"><a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' + feather.icons["more-vertical"].toSvg({
                        class: "font-small-4"
                    }) + '</a><div class="dropdown-menu dropdown-menu-end"><a href="javascript:;" class="dropdown-item">' + feather.icons["file-text"].toSvg({
                        class: "font-small-4 me-50"
                    }) + 'Details</a><a href="javascript:;" class="dropdown-item">' + feather.icons.archive.toSvg({
                        class: "font-small-4 me-50"
                    }) + 'Archive</a><a href="javascript:;" class="dropdown-item delete-record">' + feather.icons["trash-2"].toSvg({
                        class: "font-small-4 me-50"
                    }) + 'Delete</a></div></div><a href="javascript:;" class="item-edit">' + feather.icons.edit.toSvg({
                        class: "font-small-4"
                    }) + "</a>"
                }
            }],
            order: [
                [2, "desc"]
            ],
            dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            buttons: [{
                extend: "collection",
                className: "btn btn-outline-secondary dropdown-toggle me-2",
                text: feather.icons.share.toSvg({
                    class: "font-small-4 me-50"
                }) + "Export",
                buttons: [{
                    extend: "print",
                    text: feather.icons.printer.toSvg({
                        class: "font-small-4 me-50"
                    }) + "Print",
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [3, 4, 5, 6, 7]
                    }
                }, {
                    extend: "csv",
                    text: feather.icons["file-text"].toSvg({
                        class: "font-small-4 me-50"
                    }) + "Csv",
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [3, 4, 5, 6, 7]
                    }
                }, {
                    extend: "excel",
                    text: feather.icons.file.toSvg({
                        class: "font-small-4 me-50"
                    }) + "Excel",
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [3, 4, 5, 6, 7]
                    }
                }, {
                    extend: "pdf",
                    text: feather.icons.clipboard.toSvg({
                        class: "font-small-4 me-50"
                    }) + "Pdf",
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [3, 4, 5, 6, 7]
                    }
                }, {
                    extend: "copy",
                    text: feather.icons.copy.toSvg({
                        class: "font-small-4 me-50"
                    }) + "Copy",
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [3, 4, 5, 6, 7]
                    }
                }],
                init: function(e, t, a) {
                    $(t).removeClass("btn-secondary"), $(t).parent().removeClass("btn-group"), setTimeout((function() {
                        $(t).closest(".dt-buttons").removeClass("btn-group").addClass("d-inline-flex")
                    }), 50)
                }
            }],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(e) {
                            return "Details of " + e.data().full_name
                        }
                    }),
                    type: "column",
                    renderer: function(e, t, a) {
                        var s = $.map(a, (function(e, t) {
                            return "" !== e.title ? '<tr data-dt-row="' + e.rowIdx + '" data-dt-column="' + e.columnIndex + '"><td>' + e.title + ":</td> <td>" + e.data + "</td></tr>" : ""
                        })).join("");
                        return !!s && $('<table class="table"/>').append("<tbody>" + s + "</tbody>")
                    }
                }
            },
            language: {
                paginate: {
                    previous: "&nbsp;",
                    next: "&nbsp;"
                }
            }
        });
        $("div.head-label").html('<h6 class="mb-0">Orders List</h6>')
    }
    
    
    
    
}));