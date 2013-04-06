<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php echo $welcome; ?> &mdash; Nano</title>
		<meta name="author" content="">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">

		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<link rel="stylesheet" href="<?php echo asset('assets/css/style.css'); ?>" type="text/css">
	</head>
	<body>

		<section role="main">
			<header>
				<h1><?php echo $welcome; ?></h1>
			</header>

			<p>This is the default home page. All routes can be found at:</p>

			<code>APP/routes.php</code>

			<p>And the view can be found at:</p>

			<code>APP/views/home.php</code>

			<p><a href="https://github.com/rwarasaurus/nano">Fork me on github</a></p>
		</section>

    </body>
</html>