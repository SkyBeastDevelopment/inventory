// Data Table Export for Barang Keluar
$(document).ready(function () {
  var table = $("#barluar").DataTable({
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

  table.buttons().container().appendTo("#barluar_wrapper .col-md-6:eq(0)");
});
