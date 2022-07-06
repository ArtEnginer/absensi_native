  <!-- <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
     <b>Version</b> 0.1.0
    </div>
   
    <strong>Copyright &copy; 2022 <a href="#">Taufik Hidayat</a>.</strong> All rights reserved.
  </footer>
</div> -->


  

  <script src="js/main.js"></script>
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
  <script>
    function showTime2() {
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
      document.getElementById("MyClockDisplay2").innerText = time;
      document.getElementById("MyClockDisplay2").textContent = time;

      setTimeout(showTime2, 1000);

    }

    showTime2();
  </script>