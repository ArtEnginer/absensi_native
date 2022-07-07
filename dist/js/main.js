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

$(document).ready(async function () {
  const koppp = await getBase64FromUrl("dist/img/kopsurat.png");

  $(".datatables-init").DataTable({
    responsive: true,
    dom: "Bfrtip",
    buttons: [
      "copyHtml5",
      "excelHtml5",
      "csvHtml5",
      {
        extend: "pdfHtml5",
        customize: function (doc) {
          doc.content.splice(1, 0, {
            margin: [0, 0, 0, 12],
            alignment: "center",
            image: koppp,
            width: 560,
          });
        },
      },
    ],
  });
});
