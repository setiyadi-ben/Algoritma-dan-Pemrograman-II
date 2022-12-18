<!DOCTYPE html>
<html>
<head>
	<title>IoT Dashboard</title>
	<style>
		body {
			background-color: #ccc;
		}
		.dashboard {
			width: 600px;
			height: 400px;
			background-color: #fff;
			margin: auto;
			margin-top: 100px;
			border-radius: 3px;
			box-shadow: 0 0 10px rgba(0,0,0,0.5);
			display: grid;
			grid-template-columns: repeat(3, 1fr);
			grid-gap: 20px;
			padding: 20px;
		}
		.box {
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 2em;
			color: #333;
		}
		.box:nth-child(odd) {
			background-color: #f5f5f5;
		}
	</style>
</head>
<body>
	<div class="dashboard">
		<div class="box">Temperature</div>
		<div class="box">Humidity</div>
		<div class="box">Pressure</div>
		<div class="box">Light</div>
		<div class="box">Sound</div>
		<div class="box">Movement</div>
	</div>
</body>
</html>
