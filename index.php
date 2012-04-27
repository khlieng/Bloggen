<?php session_start(); ?>
<!DOCTYPE html>
<html lang="no">
	<head>
		<title>Ken-Håvard's Blogg</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans|Oswald">
		<link rel="stylesheet" href="master.css">
		<!--[if lte IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->		
	</head>
	<body>
		<div id="dialog_container">
			<div id="confirm_dialog">
				<div class="dialog_close">x</div>
				<p>Er du sikker?</p>
				<button id="confirm_button_yes">Ja</button>
				<button id="confirm_button_no">Nei</button>
			</div>
			<div id="login_dialog">
				<div class="dialog_close">x</div>
				<p>Logg inn</p>
				<form id="loginform" class="form1" method="post" action="login.php">
					<p><input type="text" id="user" name="user" placeholder="Brukernavn" /></p>
   					<p><input type="password" id="pass" name="pass" placeholder="Passord" /></p>

					<input type="submit" value="Logg inn" />
					<p><a href="javascript:void(0)" onClick="$('#newpassform').fadeToggle()" style="float:left; color:#FFF; margin-left: 0px; margin-bottom: 6px;">Glemt passordet?</a></p>	
				</form>
				<form class="form1" id="newpassform" name="newpassform">
					<p>
						<input type="text" id="email" name="email" class="required email" placeholder="E-post" />							
					</p>
		   			<p>
						<input type="submit" value="Send nytt passord" />
					</p>
				</form>
			</div>
			<div id="register_dialog">
				<div class="dialog_close">x</div>
				<p>Ny bruker</p>
				<form class="form1" id="registerform" name="registerform">
					<p>
						<label for="name">Navn</label>
						<input type="text" id="name" name="name" class="required" required="required" />
						<label></label>
					</p>
					<p>
						<label for="email">E-post</label>
						<input type="email" id="email" name="email" class="required email" required="required" />
						<label></label>
					</p>
			   		<p>
			   			<label for="pass">Passord</label>
			   			<input type="password" id="pass" name="pass" class="required" required="required" />
						<label></label>
		   			</p>
		   			<p>
			   			<label for="pass">Bekreft passord</label>
			   			<input type="password" id="pass2" name="pass2" class="required" required="required" />
						<label></label>
		   			</p>
		   			<p>
		   				<label></label>
						<input type="submit" value="Registrer" />						
						<label></label>
					</p>
				</form>	
			</div>
			<div id="newpost_dialog">
				<div class="dialog_close">x</div>
				<p>Nytt innlegg</p>
				<form class="form1" id="newpostform" name="newpostform">
					<p>
						<label for="title">Tittel</label>
						<input type="text" id="title" name="title" />
						<label></label>						
					</p>
					<p>
						<label for="content">Innhold</label>
						<textarea id="content" name="content"></textarea>
						<label></label>
					</p>
					<p>
						<label for="tags">Tags</label>
						<input type="text" id="tags" name="tags" placeholder="Tags oppgis som en kommaseparert liste" />
						<label></label>
					</p>
		   			<p>
		   				<label></label>
						<input type="submit" value="OK" />
						<label></label>
					</p>
				</form>
			</div>
		</div>
		<header id="main_header">
			<div class="headerwrap">
				<h1>KEN-HÅVARD'S BLOGG</h1>			
				<nav id="menu">
					<ul>
						<li>
							<a href="#!/hjem">HJEM</a>
						</li><li>
							<a href="#!/om-meg">OM MEG</a>
						</li><li>
							<a href="#!/kontakt">KONTAKT</a>
						</li>
					</ul>
				</nav>
			</div>
		</header>		
		<div id="wrap">		
			<section id="content">
				<div id="hjem">
					<div id="content_header"><article><h2></h2></article></div>
					<!-- Blogginnlegg blir satt inn her -->
					<div id="bottom_menu">
						<button id="button_show_more" onClick="getMorePosts()">Vis flere innlegg</button>
						<button onClick="$.scrollTo('#main_header', 1000)">Tilbake til toppen</button>
					</div>
				</div>				
				<div id="om-meg" style="display: none;">
					<article>
						<header>
							<h1>Om meg</h1>
						</header>
						<p>TEKST</p>
					</article>
				</div>
				<div id="kontakt" style="display: none;">
					<article>
						<header>
							<h1>Kontakt</h1>
						</header>
						<p>TEKST</p>
					</article>
				</div>
				<div id="showid"></div>
				<div style="height: 1px;"></div>
			</section>
			<aside id="sidebar">				
				<section id="userinfo">
					<?php include('userinfo.php'); ?>
	    		</section>
				<section id="info">					
					<header>
						<h1>Informasjon</h1>
					</header>
					<p>Nam orci diam, tempor eget malesuada a, feugiat vel magna. Aenean hendrerit, nulla at pharetra tristique, augue nulla condimentum magna, id feugiat purus nisl et tortor. Quisque dapibus est vel dolor iaculis hendrerit.</p>
				</section>
				<section id="search">
					<form id="searchform" class="form1">
						<input name="search" type="text" placeholder="Søk" />
					</form>
				</section>				
	    		<section id="findstuff" class="clearfix">
	    			<ul class="tabnav">
	    				<li>
	    					<a href="#tab-archive" class="current"><h1>Arkiv</h1></a>
	    				</li><li>
	    					<a href="#tab-tags"><h1>Tags</h1></a>
	    				</li>
	    			</ul>
	    			<div style="height: 5px;background: #B8FF11;"></div>
	    			<div id="tab-archive" class="sidemenu tab current">
						<?php include('listarchive.php'); ?>
					</div>
					<div id="tab-tags" class="sidemenu tab">
						<?php include('listtags.php'); ?>
					</div>
	    		</section>				
				<section id="feed">
					<a href="rss"><img src="images/feed-icon-28x28.png"></a>
				</section>
			</aside>		
		</div>
		<footer id="footer">
			<div class="clearfix headerwrap">
				<section id="footer_sitemap">
					<header>
						<h1>MENY</h1>
					</header>
					<ul>
						<li><a href="#!/hjem">Hjem</a></li>
						<li><a href="#!/om-meg">Om meg</a></li>
						<li><a href="#!/kontakt">Kontakt</a></li>
					</ul>
				</section>				
				<section id="footer_archive">
					<header>
						<h1>ARKIV</h1>
					</header>
					<?php include('listarchive.php'); ?>
				</section>
				<section id="footer_tags">
					<header>
						<h1>TAGS</h1>
					</header>
					<?php include('listtags.php'); ?>
				</section>
			</div>
		</footer>
		<div id="overlay"></div>
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
	<script src="jquery.scrollTo-1.4.2-min.js"></script>
	<script src="main.js"></script>
</html>