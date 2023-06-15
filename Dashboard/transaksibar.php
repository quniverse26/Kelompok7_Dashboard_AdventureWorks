<?php

//menghubungkan ke database
include ('koneksi.php');

$transaksi = mysqli_query($conn, "SELECT td.bulan, tf.JumlahTransaksi FROM td_time td JOIN tf_transaksi tf ON td.time_id = tf.TimeID GROUP BY td.bulan;");
while ($row = mysqli_fetch_array($transaksi)) {
	$bulan[] = $row['bulan'];

	$query = mysqli_query($conn, "SELECT td.bulan, COUNT(tf.JumlahTransaksi) as JumlahTransaksi FROM td_time td JOIN tf_transaksi tf ON td.time_id = tf.TimeID where td.bulan='". $row['bulan']."' GROUP BY td.bulan");
	$row = $query->fetch_array();
	$JumlahTransaksi[] = $row['JumlahTransaksi'];

}

?>

<!DOCTYPE html>
<html>
<head>
	<title> AdventureWorks-dw </title>
	
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>


	<center><h3> Jumlah Transaksi pada Tahun 2003 </h3></center>
<center>
	<div style="width: 800; height: 800">
		<canvas id="myChart"></canvas>
	</div></center>

	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			//mendefinisikan tipe chart
			type: 'bar',
			data: {
				labels: <?php echo json_encode($bulan); ?>, datasets: [{
					label: 'Jumlah Transaksi pada Tahun 2003',
					data: <?php echo json_encode($JumlahTransaksi); ?>,
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255, 99, 132, 1',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>

</body>
</html>