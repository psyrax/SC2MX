<?php 
//Define feed URL
$feed_url = 'http://www.sc2mx.com/forums/external.php?do=rss&type=newcontent&days=120&count=9';
//Get content of the URL
$handler = curl_init($feed_url);
curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handler, CURLOPT_HEADER, 0);
$response = curl_exec ($handler);
curl_close($handler);
//Prase feeds into class
$feeds = new SimpleXmlElement($response, LIBXML_NOCDATA);

$calendar="https://www.google.com/calendar/feeds/fi6qgmpb0669gfecm97albjufk%40group.calendar.google.com/public/basic?singleevents=true&orderby=starttime&max-results=5";
$calendarcurl = curl_init($calendar);
curl_setopt($calendarcurl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($calendarcurl, CURLOPT_HEADER, 0);
$calendarxml = curl_exec ($calendarcurl);
curl_close($calendarcurl);
//Prase feeds into class
$events = new SimpleXmlElement($calendarxml, LIBXML_NOCDATA);
//print_r($events);
?>

<!doctype html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<title>SC2MX</title>
		<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css" />
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
						<li><a href="#">Foros</a></li>
						<li><a href="#">Nexus</a></li>
						<li><a href="#">LMS</a></li>
						<li><a href="#">Facebook</a></li>
					</ul>
    			</div>
  			</div>
		</div>
	</header>
	<section>
		<div class="container">
			<div class="row">
			<div class="span12">
				<div id="streams">
					<ul class="nav nav-pills">
					</ul>
					<div class="row">
						<div class="span8" id="stream_content"></div>
						<div class="span4" id="stream_chat"></div>
					</div>
					<hr />
				</div>
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
							foreach($feeds->channel->item as $feed) {
								preg_match_all('/<img[^>]+>/i',$feed->description, $img);
								preg_match_all('/(src)=("[^"]*")/i',$img[0][0], $img_src);
								?>
    							<div class="span9">
	    							<div class="row">
	    								<div class="span3">
	    									<?= date("Y-m-d H:i", strtotime($feed->pubDate)); ?>
		    								<a href="<?= $feed->link; ?>" class="thumbnail">
		    									<?php if($img_src[2][0]!=""):?>
		    										<img src=<?= stripslashes($img_src[2][0]);?> />

		    									<?php else: ?>
		    										<img src="http://placehold.it/210x100" />
		    									<?php endif; ?>
		    								</a>
	    								</div>
	    								<div class="span6">
		    								<h4><a href="<?= $feed->link; ?>"><?= $feed->title; ?></a></h4>
		    								<p ><?= strip_tags($feed->description); ?></p>
		    								<a href="<?= $feed->link ?>">Ver mas</a>
	    								</div>
	    							</div>
	    							<hr />
    							</div>
							<?php }; ?>
							</div>
			  			</div>
			  			<div class="span3">
			  				<h3>Proximos eventos</h3>
			  				<ul>
			  				<?php foreach ($events->entry as $entry) {
      						$title = stripslashes($entry->title);
      						$summary = stripslashes($entry->summary);
      						$summary_pre=str_replace('á', '&aacute;', $summary);
      						$summary_lol=explode('<br>', $summary_pre);
      						$summary_final=$summary_lol[0];
      						?>
      							<li>
      								<h5><?= $title; ?></h5>
      								<span><?= $summary_final; ?></span><br />
      								<a href="<?= $entry->link->attributes()->href; ?>" target="_blank">Guardar en mi calendario</a>
      							</li>
      						<?php }; ?>
			  				</ul>
			  				<object width="100%" height="600" id="obj_1297019226277"><param name="movie" value="http://chatsc2mx.chatango.com/group"><param name="wmode" value="transparent"><param name="AllowScriptAccess" value="always"><param name="AllowNetworking" value="all"><param name="AllowFullScreen" value="true"><param name="flashvars" value="cid=1297019226277&amp;a=CCCCCC&amp;b=51&amp;f=43&amp;i=87&amp;k=999999&amp;l=FFFFFF&amp;m=FFFFFF&amp;o=30&amp;r=100&amp;s=1"><embed id="emb_1297019226277" src="http://chatsc2mx.chatango.com/group" width="100%" height="600" wmode="transparent" allowscriptaccess="always" allownetworking="all" type="application/x-shockwave-flash" allowfullscreen="true" flashvars="cid=1297019226277&amp;a=CCCCCC&amp;b=51&amp;f=43&amp;i=87&amp;k=999999&amp;l=FFFFFF&amp;m=FFFFFF&amp;o=30&amp;r=100&amp;s=1"></object>
			  				<h3>Patrocinios</h3>
			  				<hr />
			  				<img src="http://placehold.it/220x700" />
			  			</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer>
		<div class="container">
			<div class="row">
				<div class="span12">
					<hr />
					<h3>Streams participantes:</h3>
					<ul class="nav nav-pills">
						<li><a href="http://twitch.tv/horusstv" target="_blank">horusstv</a></li>
						<li><a href="http://twitch.tv/fenixcoaching" target="_blank">fenixcoaching</a></li>
						<li><a href="http://twitch.tv/rommeltj" target="_blank">rommeltj</a></li>
						<li><a href="http://twitch.tv/jimrsng" target="_blank">jimrsng</a></li>
						<li><a href="http://twitch.tv/famousc2" target="_blank">famousc2</a></li>
						<li><a href="http://twitch.tv/zafhir" target="_blank">zafhir</a></li>
						<li><a href="http://twitch.tv/beefchief3" target="_blank">beefchief3</a></li>
						<li><a href="http://twitch.tv/lowcloud1" target="_blank">lowcloud1</a></li>
						<li><a href="http://twitch.tv/xesk1e" target="_blank">xesk1e</a></li>
						<li><a href="http://twitch.tv/day9tv" target="_blank">day9tv</a></li>
						<li><a href="http://twitch.tv/zapo_colorado" target="_blank">zapo_colorado</a></li>
						<li><a href="http://twitch.tv/xgsrevenge" target="_blank">xgsrevenge</a></li>
						<li><a href="http://twitch.tv/angryzergc" target="_blank">angryzergc</a></li>
						<li><a href="http://twitch.tv/fritangatv" target="_blank">fritangatv</a></li>
					</ul>
					<div class="well">
						Hecho con cari&ntilde;o por <a href="http://twitter.com/oso96_2000" target="_blank">@oso96_2000</a> y <a href="http://twitter.com/psyrax" target="_blank">@psyrax</a> usando <a href="http://twitter.github.com/bootstrap" target="_blank">bootstrap</a> para el CSS, <a href="http://bootswatch.com/" target="_blank">bootswatch</a> para el tema y <a href="http://jquery.com/" target="_blank">jQuery</a> para el JS. <a href="https://github.com/psyrax/SC2MX" target="_blank">Ve nuestro c&oacute;digo fuente.</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script src="./js/bootstrap.js"></script>
		<script src="./js/core.js"></script>

	</body>
</html>
		
