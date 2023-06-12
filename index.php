<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard-DWO</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Charts
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="transaksi.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Chart 1</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/charts/chartjs.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Chart 2</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="pivot.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Pivot Table
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "adventureworks-dw");

// Periksa koneksi database
if (mysqli_connect_errno()) {
  echo "Koneksi database gagal: " . mysqli_connect_error();
  exit();
}

// Query untuk mendapatkan jumlah transaksi
$sqlTransaksi = "SELECT COUNT(JumlahTransaksi) AS jumlah_transaksi FROM tf_transaksi";
$resultTransaksi = mysqli_query($koneksi, $sqlTransaksi);

// Periksa hasil query transaksi
if ($resultTransaksi) {
    $rowTransaksi = mysqli_fetch_assoc($resultTransaksi);
    $jumlahTransaksi = $rowTransaksi['jumlah_transaksi'];
} else {
    echo "Error: " . mysqli_error($koneksi);
}

// Query untuk mendapatkan jumlah produksi
$sqlProduksi = "SELECT COUNT(JumlahProduksi) AS jumlah_produksi FROM tf_produksi";
$resultProduksi = mysqli_query($koneksi, $sqlProduksi);

// Periksa hasil query produksi
if ($resultProduksi) {
    $rowProduksi = mysqli_fetch_assoc($resultProduksi);
    $jumlahProduksi = $rowProduksi['jumlah_produksi'];
} else {
    echo "Error: " . mysqli_error($koneksi);
}

echo "Jumlah Transaksi: " . $jumlahTransaksi . "<br>";
echo "Jumlah Produksi: " . $jumlahProduksi . "<br>";

// Query untuk mendapatkan jumlah transaksi tiap bulan
$sqlTotalTransaksiBulan = "SELECT MONTH(bulan) AS bulan, COUNT(JumlahTransaksi) AS jumlah_transaksi_bulan FROM tf_transaksi GROUP BY MONTH(bulan)";
$resultTotalTransaksiBulan = mysqli_query($koneksi, $sqlTotalTransaksiBulan);

// Periksa hasil query transaksi per bulan
if ($resultTotalTransaksiBulan) {
  // Buat array untuk menyimpan data bulan dan jumlah transaksi
  $dataTransaksiBulan = array();

  while ($row = mysqli_fetch_assoc($resultTotalTransaksiBulan)) {
      $dataTransaksiBulan[] = array(
          'bulan' => $row['bulan'],
          'jumlah_transaksi_bulan' => $row['jumlah_transaksi_bulan']
      );
  }

  // Tampilkan grafik bar chart jumlah transaksi per bulan
  foreach ($dataTransaksiBulan as $data) {
      echo "Bulan " . $data['bulan'] . ": " . $data['jumlah_transaksi_bulan'] . "<br>";
      // Tampilkan grafik sesuai dengan data transaksi
      // ...
  }
} else {
  echo "Error: " . mysqli_error($koneksi);
}

// Periksa hasil query produksi per bulan
if ($resultTotalProduksiBulan) {
  // Buat array untuk menyimpan data bulan dan jumlah produksi
  $dataProduksiBulan = array();

  while ($row = mysqli_fetch_assoc($resultTotalProduksiBulan)) {
      $dataProduksiBulan[] = array(
          'tahun' => $row['bulan'],
          'jumlah_produksi_bulan' => $row['jumlah_produksi_bulan']
      );
  }

  // Tampilkan grafik bar chart jumlah produksi per bulan
  foreach ($dataProduksiTahun as $data) {
      echo "Tahun " . $data['tahun'] . ": " . $data['jumlah_produksi_tahun'] . "<br>";
      // Tampilkan grafik sesuai dengan data produksi
      // ...
  }
} else {
  echo "Error: " . mysqli_error($koneksi);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div>
        <h1>Total Transaksi: <?php echo $jumlahTransaksi; ?></h1>
        <h1>Total Produksi: <?php echo $jumlahProduksi; ?></h1>
    </div>

    <div>
        <canvas id="chartTransaksiBulan"></canvas>
    </div>

    <div>
        <canvas id="chartTotalProduksiTahun"></canvas>
    </div>

    <script>
        // Chart Jumlah Transaksi Tiap Bulan
        var ctxTransaksiBulan = document.getElementById('chartTransaksiBulan').getContext('2d');
        var chartTransaksiBulan = new Chart(ctxTransaksiBulan, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_keys($jumlahTransaksiBulan)); ?>,
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: <?php echo json_encode(array_values($jumlahTransaksiBulan)); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });

        // Chart Total Produksi per Bulan
        var ctxTotalProduksiBulan = document.getElementById('chartTotalProduksiBulan').getContext('2d');
        var chartTotalProduksiBulan = new Chart(ctxTotalProduksiBulan, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_keys($totalProduksiBulan)); ?>,
                datasets: [{
                    label: 'Total Produksi',
                    data: <?php echo json_encode(array_values($totalProduksiBulan)); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });
    </script>
</body>
</html>

      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>