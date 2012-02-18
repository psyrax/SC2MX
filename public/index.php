<?php 
//Define feed URL
$feed_url = 'http://www.sc2mx.com/forums/external.php?do=rss&type=newcontent&days=120&count=18';
//Get content of the URL
$handler = curl_init($feed_url);
curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handler, CURLOPT_HEADER, 0);
$response = curl_exec ($handler);
curl_close($handler);

//Prase feeds into class
$feeds = new SimpleXmlElement($response, LIBXML_NOCDATA);
?>

<!doctype html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<title>SC2MX</title>
		<link rel="stylesheet" type="text/css" href="./css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="./css/style.css" />
		
	</head> 
	<body>
	
	<header>
		<div class="navbar">
			<div class="navbar-inner">
    			<div class="container">
      				<a class="brand" href="#">
  						SC2MX
					</a>
					<ul class="nav">
						<li class="dropdown">
							<a href="#"
							      class="dropdown-toggle"
							      data-toggle="dropdown">
							      Streams Estelares
							      <b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
							 	<li>Offline	horusstv<li>
								<li>Offline	fenixcoaching<li>
								<li>Offline	rommeltj<li>
								<li>Offline	jimrsng<li>
								<li>Offline	famousc2<li>
								<li>Offline	zafhir<li>
								<li>Offline	beefchief3<li>
								<li>Offline	lowcloud1<li>
								<li>Offline	xesk1e<li>
								<li>Offline	day9tv<li>
								<li>Offline	zapo_colorado<li>
								<li>Offline	xgsrevenge<li>
								<li>Offline	angryzergc<li>
							</ul>
						</li>
						<li><a href="#">Foros</a></li>
						<li><a href="#">Nexus</a></li>
						<li><a href="#">LMS</a></li>
						<li><a href="#">Facebook</a></li>
					</ul>
    			</div>
  			</div>
		</div>
		<div class="container">
			<div class="row">
			<div class="span12">
				<h2>Fancy ad</h2>
				<img src="http://placehold.it/940x50" />
					<div class="row">
			  			<div class="span9">
			  				<div class="row">
			  					<div class="span7">
			  						<h1>Destacado principal</h1>
			  						<img src="http://placehold.it/540x400" />
			  					</div>
			  					<div class="span2 otros">
			  						<h3>Otros videos</h3>
			  						<img src="http://placehold.it/140x100" />
			  						<img src="http://placehold.it/140x100" />
			  						<img src="http://placehold.it/140x100" />
			  						<img src="http://placehold.it/140x100" />
			  					</div>
			  				</div>
			  				<h3>Noticias</h3>
			  				<hr />
			  				<div class="row">
			  				<?php 
			  				//Output feeds
							foreach($feeds->channel->item as $feed) {?>
    							<div class="span3 anteriores">
    								<h4 class="n-title"><?= $feed->title; ?></h4>
    								<img src="http://placehold.it/220x150" /><br />
    								<a href="<?= $feed->link ?>">Ver mas</a>
    							</div>
							<?php }; ?>
							</div>
			  			</div>
			  			<div class="span3">
			  				<h3>Proximos eventos</h3>
			  				<hr />
			  				<ul>;
			  					<li>
			  						<span class="label label-info">Fecha y hora</span>
			  						<img src="http://placehold.it/195x50" />
			  						<a href="btn btn-small btn-primary">Enviame un recordatorio</a>
			  					</li>
			  					<li>
			  						<span class="label label-info">Fecha y hora</span>
			  						<img src="http://placehold.it/195x50" />
			  						<a href="btn btn-small btn-primary">Enviame un recordatorio</a>
			  					</li>
			  								  					<li>
			  						<span class="label label-info">Fecha y hora</span>
			  						<img src="http://placehold.it/195x50" />
			  						<a href="btn btn-small btn-primary">Enviame un recordatorio</a>
			  					</li>
			  								  					<li>
			  						<span class="label label-info">Fecha y hora</span>
			  						<img src="http://placehold.it/195x50" />
			  						<a href="btn btn-small btn-primary">Enviame un recordatorio</a>
			  					</li>
			  				</ul>
			  				<h3>Patrocinios</h3>
			  				<hr />
			  				<img src="http://placehold.it/220x700" />
			  			</div>
					</div>
				</div>
			</div>
		</div>
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script src="./js/bootstrap.js"></script>
	</body>
</html>
		