// Data Table Export for Stock Barang

$(document).ready(function () {
  var table = $("#stock").DataTable({
    buttons: [
      "excel",

      {
        extend: "pdf",
        customize: function (doc) {
          doc.content[1].table.widths = Array(
            doc.content[1].table.body[0].length + 1
          )
            .join("*")
            .split("");
        },
      },

      "print",
    ],
  });

  table.buttons().container().appendTo("#stock_wrapper .col-md-6:eq(0)");
});
