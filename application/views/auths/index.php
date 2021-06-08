<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Login | Assets Management</title>

	<link rel="shortcut icon" sizes="16x16 24x24 32x32 48x48 64x64" href="<?= base_url('assets/images/favicons/apple-touch-icon.png') ?>">
	<style>
		* {
			margin: 0;
			padding: 0;
			outline: 0;
			font-family: 'Open Sans', sans-serif;
		}

		body {
			height: 100vh;
			background-image: url('./assets/images/2560x1440/bg.jpg');
			background-size: cover;
			background-position: center;
		}

		p {
			color: white;
			font-family: 'Open Sans', sans-serif;
			padding-top: 10px;
		}

		h1 {
			text-align: center;
			padding-bottom: 20px;
		}

		a {
			color: white;
			font-family: 'Open Sans', sans-serif;
		}

		.container {
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
			padding: 20px 25px;
			width: 300px;

			background-color: rgba(0, 0, 0, .7);
			box-shadow: 0 0 10px rgba(255, 255, 255, .3);
		}

		.container h1 {
			color: #fafafa;
			margin-bottom: 30px;
			text-transform: uppercase;
			border-bottom: 4px solid #0653C7;
		}

		.container label {
			text-align: left;
			color: #90caf9;
		}

		.container form input {
			width: calc(100% - 20px);
			padding: 8px 10px;
			margin-bottom: 15px;
			border: none;
			background-color: transparent;
			border-bottom: 2px solid #0653C7;
			color: #fff;
			font-size: 20px;
		}

		.container form button {
			width: 100%;
			height: 40px;
			padding: 5px 0;
			border: none;
			background-color: #0653C7;
			font-size: 18px;
			color: #fafafa;
			border-radius: 20px;
		}

		.container form button:hover {
			font-size: 20px;
			border-radius: 10px;
		}
	</style>

	<!-- Javascript Assets -->
	<script src="<?= base_url('assets/datetimepicker/jquery.js') ?>"></script>
	<script src="<?= base_url('assets/sweetalert/dist/sweetalert2.all.min.js') ?>"></script>
</head>

<body>
	<?= $this->session->flashdata('flash'); ?>
	<div class="container">
		<h1>Assets Management</h1>
		<form action="<?= base_url('auth/login') ?>" method="POST">
			<label for="email">Email</label>
			<br>
			<input type="email" id="email" name="email" required autocomplete="off">
			<br>
			<label for="password">Password</label>
			<br>
			<input type="password" id="password" name="password" required autocomplete="off">
			<br>
			<button type="submit">Log in</button>
		</form>
	</div>
</body>

</html>