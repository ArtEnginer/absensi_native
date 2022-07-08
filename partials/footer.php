  <!-- <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
          <b id="MyClockDisplay"></b>
      </div>

      <strong>Copyright &copy; 2022 <a href="#">Taufik Hidayat</a>.</strong> All rights reserved.
  </footer>
  </div> -->



  <script type="text/javascript" src="dist/datatables/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="dist/datatables/pdfmake.min.js"></script>
  <script type="text/javascript" src="dist/datatables/vfs_fonts.js"></script>
  <script type="text/javascript" src="dist/datatables/datatables.min.js">
  </script>
  <script src="dist/js/printThis.js"></script>
  <script src="dist/js/main.js"></script>
  <script>
function showTime() {
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";

    if (h == 0) {
        h = 12;
    }

    if (h > 12) {
        h = h - 12;
        session = "PM";
    }

    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;

    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;

    setTimeout(showTime, 1000);

}

showTime();
  </script>