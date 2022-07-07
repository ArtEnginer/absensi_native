$(document).ready(function () {
  $(".datatables-init").DataTable({
    responsive: true,
    dom: "Bfrtip",
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
  });
});
