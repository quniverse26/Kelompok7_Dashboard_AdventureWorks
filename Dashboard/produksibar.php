<?php

//menghubungkan ke database
include ('koneksi.php');

$produksi = mysqli_query($conn, "SELECT td.tahun, tf.ProductID FROM td_production_time td JOIN tf_produksi tf ON td.time_id = tf.TimeID GROUP BY td.tahun;");
while ($row = mysqli_fetch_array($produksi)) {
	$tahun[] = $row['tahun']; 

	$query = mysqli_query($conn, "SELECT td.tahun, COUNT(tf.ProductID) as TotalProduksi FROM td_production_time td JOIN tf_produksi tf ON td.time_id = tf.TimeID where td.tahun='". $row['tahun']."' GROUP BY td.tahun");
	$row = $query->fetch_array();
	$TotalProduksi[] = $row['TotalProduksi'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<title> AdventureWorks-dw </title>
	
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>


	<center><h3> Total Produksi per Tahun </h3></center>
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
				labels: <?php echo json_encode($tahun); ?>, datasets: [{
					label: 'Jumlah Produksi per Tahun',
					data: <?php echo json_encode($TotalProduksi); ?>,
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