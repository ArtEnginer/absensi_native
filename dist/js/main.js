const getBase64FromUrl = async (url) => {
  const data = await fetch(url);
  const blob = await data.blob();
  return new Promise((resolve) => {
    const reader = new FileReader();
    reader.readAsDataURL(blob);
    reader.onloadend = () => {
      const base64data = reader.result;
      resolve(base64data);
    };
  });
};
function printDiv(divName) {
  const koppp = "dist/img/kopsurat.png";
  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;

  document.body.innerHTML = printContents;
  const head = document.createElement("div");
  head.id = "head";
  head.innerHTML = `<div class="row">
        <div class="col-md-12"> <img src="${koppp}" width="100%">
    </div> </div>
    <div class="row">
        <div class="col-md-12">
        <h1 style="text-align:center; font-size:20px;">Slip Gaji Karyawan

        </h1>
        </div> </div>`;
  $(document.body).prepend(head);
  setTimeout(() => {
    window.print();
    document.body.innerHTML = originalContents;
  }, 1000);
}
$(document).ready(async function () {
  const koppp = await getBase64FromUrl("dist/img/kopsurat.png");

  $(".datatables-init").DataTable({
    responsive: true,
    dom: "Bfrtip",
    buttons: [
      "copyHtml5",
      "excelHtml5",
      "csvHtml5",
      // {
      //   extend: "pdfHtml5",
      //   customize: function (doc) {
      //     doc.content.splice(1, 0, {
      //       margin: [0, 0, 0, 12],
      //       alignment: "center",
      //       image: koppp,
      //       width: 560,
      //     });
      //   },
      // },
      {
        extend: "print",
        title: "",
        pageSize: "A4",
        footer: false,
        header: false,
        customize: function (win) {
          const head = document.createElement("div");
          head.id = "head";
          head.innerHTML = `<div class="row"> 
          <div class="col-md-12"> <img src="${koppp}" width="100%">
          
      </div> </div>
      <div class="row"> 
          <div class="col-md-12">
          <h1 style="text-align:center; font-size:20px;">Laporan Absensi Karyawan
         
          </h1>
          </div> </div>`;
          $(win.document.body).prepend(head);
        },
      },
    ],
  });
});
