<?php

include('koneksi.php');

$produksi = mysqli_query($conn, "SELECT td.tahun, tf.ProductID FROM td_production_time td JOIN tf_produksi tf ON td.time_id = tf.TimeID GROUP BY td.tahun;");
while ($row = mysqli_fetch_array($produksi)) {
	$tahun[] = $row['tahun'];

	$query = mysqli_query($conn, "SELECT td.tahun, COUNT(tf.ProductID) as TotalProduksi FROM td_production_time td JOIN tf_produksi tf ON td.time_id = tf.TimeID where td.tahun='". $row['tahun']."' GROUP BY td.tahun");
	$row = $query->fetch_array();
	$TotalProduksi[] = $row['TotalProduksi'];
}
?>
<!doctype html>
<html>

<head>
	<title> Pie Chart - Total Produksi per Tahun </title>
	<script type="text/javascript" src="Chart.js"></script>
</head>

<body>
	<center><h3> Total Produksi per Tahun </h3></center>
<center>
	<center>
	<div id="canvas-holder" style="width:200%">
		<canvas id="chart-area"></canvas>
	</div></center>
	<script>
		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data:<?php echo json_encode($TotalProduksi); ?>,
					backgroundColor: [
					'rgb(0, 0, 205)',
					'rgb(252, 165, 3)',
					'rgb(178, 34, 33)',
					'rgb(34, 139, 35)',
					'rgb(253, 215, 3)',
					'rgb(135, 206, 250)',
					'rgb(128, 0, 128)',
					'rgb(64, 224, 208)',
					'rgb(127, 255, 1)',
					'rgb(255, 0, 0)'
					],
					label: 'Total Produksi per Tahun'
				}],
				labels: <?php echo json_encode($tahun); ?>},
			options: {
				responsive: true
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};

		document.getElementById('randomizeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});
			});

			window.myPie.update();
		});

		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var newDataset = {
				backgroundColor: [],
				data: [],
				label: 'New dataset ' + config.data.datasets.length,
			};

			for (var index = 0; index < config.data.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());

				var colorName = colorNames[index % colorNames.length];
				var newColor = window.chartColors[colorName];
				newDataset.backgroundColor.push(newColor);
			}

			config.data.datasets.push(newDataset);
			window.myPie.update();
		});

		document.getElementById('removeDataset').addEventListener('click', function() {
			config.data.datasets.splice(0, 1);
			window.myPie.update();
		});
	</script>
</body>

</html>