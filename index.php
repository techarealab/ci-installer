<?php

require_once 'config/config.php';
require_once 'class/Core.php';

$isCompleted = FALSE;
$core = new Core;
$check = $core->init($config);

if ($_POST) :
	$core->setInput($_POST);
	
	if ($core->checkDB()) :
		$core->createTables();

		if ($core->reWrite()) $isCompleted = TRUE;
	endif;
endif;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Instal Aplikasi</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style type="text/css">.flat{border-radius: 0;}.panel{margin-top: 60px;}</style>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
				<div class="panel panel-success flat floating">
					<div class="panel-heading">Instal Aplikasi</div>
					<?php
						if ($isCompleted) :
							echo "<div class=\"panel-body\"><div class=\"alert alert-info flat\" role=\"alert\">Instalasi <strong>berhasil</strong>, jangan lupa untuk menghapus folder install.</div></div>";
						else :
							if ($check) :
								echo "<div class=\"panel-body\"><div class=\"alert alert-danger flat\" role=\"alert\"><ul>";
								foreach ($check as $item) :
									echo "<li>$item</li>";
								endforeach;
								echo "</ul></div></div>";
							else :
					?>
					<div class="panel-body">
						<form id="form_install" action="" method="POST">
							<?php
								if ($core->getError()) :
									echo "<div class=\"alert alert-danger flat\" role=\"alert\"><ul>";
									foreach ($core->getError() as $item) :
										echo "<li>$item</li>";
									endforeach;
									echo "</ul></div>";
								endif;
							?>
							<div class="form-group">
								<label for="base_url">Base URL</label>
								<input name="base_url" type="text" class="form-control flat" id="base_url" placeholder="Contoh: http://domain.com/" required>
								<p class="help-block">Base URL harus diakhiri dengan tanda '<strong>/</strong>'</p>
							</div>
							<div class="form-group">
								<label for="hostname">DB Hostname</label>
								<input name="hostname" type="text" class="form-control flat" id="hostname" placeholder="Hostname Database" required>
							</div>
							<div class="form-group">
								<label for="username">DB Username</label>
								<input name="username" type="text" class="form-control flat" id="username" placeholder="Username Database" required>
							</div>
							<div class="form-group">
								<label for="password">DB Password</label>
								<input name="password" type="password" class="form-control flat" id="password" placeholder="Password Database">
							</div>
							<div class="form-group">
								<label for="database">DB Name</label>
								<input name="database" type="text" class="form-control flat" id="database" placeholder="Nama Database" required>
							</div>
						</form>
					</div>
					<div class="panel-footer">
						<button type="submit" form="form_install" class="btn btn-primary flat">Instal</button>
					</div>
					<?php endif; endif; ?>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
