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
	<?php flush(); ?>
	<body>
		<div id="dialog_container">
			<div id="confirm_dialog">
				<p>Er du sikker?</p>
				<button id="confirm_button_yes">Ja</button>
				<button id="confirm_button_no">Nei</button>
			</div>
		</div>
		<header id="main_header">
			<div class="headerwrap">
				<h1>KEN-HÅVARD'S BLOGG</h1>			
				<nav id="menu">
					<ul>
						<li>
							<a href="#hjem">HJEM</a>
						</li><li>
							<a href="#om-meg">OM MEG</a>
						</li><li>
							<a href="#logg">PROSJEKTLOGG</a>
						</li><li>
							<a href="#kontakt">KONTAKT</a>
						</li>
					</ul>
				</nav>
			</div>
		</header>		
		<div id="wrap">		
			<section id="content">
				<article id="register" class="form_article">
					<header>
						<h1>Ny bruker</h1>
					</header>
					<form class="form1" id="registerform" name="registerform">
						<p>
							<label for="name">Navn</label>
							<input type="text" id="name" name="name" class="required" />
						</p>
						<p>
							<label for="email">E-post</label>
							<input type="text" id="email" name="email" class="required email" />							
						</p>
				   		<p>
				   			<label for="pass">Passord</label>
				   			<input type="password" id="pass" name="pass" class="required" />
			   			</p>
			   			<p>
				   			<label for="pass">Bekreft passord</label>
				   			<input type="password" id="pass2" name="pass2" class="required" />
			   			</p>
			   			<p>
			   				<label></label>
							<input type="submit" value="Registrer" />
						</p>
					</form>					
				</article>
				<article id="password" class="form_article">
					<header>
						<h1>Glemt passord</h1>
					</header>
					<form class="form1" id="newpassform" name="newpassform">
						<p>
							<label for="email">E-post</label>
							<input type="text" id="email" name="email" class="required email" />							
						</p>
			   			<p>
			   				<label></label>
							<input type="submit" value="Send nytt passord" />
						</p>
					</form>
				</article>
				<article id="newpost" class="form_article">
					<header>
						<h1>Nytt innlegg</h1>
					</header>
					<form class="form1" id="newpostform" name="newpostform" method="post" action="newpost.php">
						<p>
							<label for="title">Tittel</label>
							<input type="text" id="title" name="title" />							
						</p>
						<p>
							<label for="content">Innhold</label>
							<textarea id="content" name="content"></textarea>
						</p>
						<p>
							<label for="tags">Tags</label>
							<input type="text" id="tags" name="tags" />
						</p>
			   			<p>
			   				<label></label>
							<input type="submit" value="OK" />
						</p>
					</form>
				</article>
				<div id="hjem">
					<!-- Blogginnlegg blir satt inn her -->
					<div id="loading"></div>
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
				<div id="logg" class="nosidebar" style="display: none;">
					<article>
						<header>
							<h1>Prosjektlogg</h1>
						</header>
						<p><p><h2>10.03.2012 – 15.03.2012</h2> (ca. 0,5-2 timer per dag)</p>
Glemte å gjøre daglig loggføring i starten av prosjektet, før oppgaven ble lagt ut jobbet jeg med et nytt design(utseende). Jeg jobbet deretter med å flytte eksisterende funksjonalitet over på database og begynte på registrering av brukere. Det finnes nå to brukergrupper, en hardkodet adminbruker og registrerte brukere. Ingen validering av input har blitt implementert så langt.</p>
<br />
<p><p><h2>16.03.2012</h2> (2 timer)</p>
Slettet ved et uhell hele prosjektet gjennom Eclipse, det havnet dermed ikke i papirkurven. Fikk gjenopprettet det meste ved å rulle tilbake mappen, mistet arbeidet jeg hadde gjort det siste døgnet (innlogging og registrering + en meny og noen inputformer). For å unngå at slike ting skjer om igjen har jeg nå tatt i bruk versjonskontroll(Mercurial). Begynte med å implementere noe av det jeg hadde mistet, i tillegg begynte jeg på visning av enkeltinnlegg hvor kommentarene skal listes opp under.</p>
<br />
<p><p><h2>20.03.2012</h2> (4 timer)</p>
Alt er tilbake der det var før jeg mistet prosjektet. Har i tillegg fått på plass sending av nytt passord, passordet sendes via en gmail-konto jeg opprettet kun for dette prosjektet. Har kommet godt i gang med validering av brukerinput, det sjekkes om e-postadressen er ledig ved hjelp av AJAX, om passordene som har blitt skrevet inn er like osv.</p>
<br />
<p><p><h2>21.03.2012</h2> (2 timer)</p>
Har i dag for det meste jobbet videre med designet, har laget en ny header og en knapp, og jeg har begynt å jobbe med diverse ikoner.</p>
<br />
<p><p><h2>23.03.2012</h2> (2 timer)</p>
Har i dag for det meste gjort mer designarbeid, har laget en ny footer og puttet hele sidekartet i footeren og gjort en del andre forandringer. Har også begynt å gjøre diverse forberedelser til visning av flere innlegg.</p>
<br />
<p><p><h2>25.03.2012</h2> (3 timer)</p>
Når brukeren ber om nytt passord blir dette nå faktisk oppdatert i databasen, har wrappet mailsendingen i en egen metode siden jeg nå vil få bruk for den flere plasser. Har lagt til aktivering av brukere, det sendes en mail til brukeren etter registrering med en link til et php-skript som gjør aktiveringen. En tabell i databasen lagrer mappingen mellom brukerid og aktiveringskode. Blogginnlegg hentes nå med AJAX, flere innlegg hentes inn ved å trykke på en knapp, det kan også tenkes at dette kan skje automatisk når det scrolles til bunnen av siden. jQuery gjør det å jobbe med AJAX til en drøm. Har også begynt på kommentarer i dag.</p>
<br />
<p><p><h2>27.03.2012</h2> (1 time)</p>
Tatt i bruk jQuery Validation for validering av input.</p>
<br />
<p><p><h2>30.03.2012</h2></p>
All navigering på siden skjer nå via hashtags, siden lastes kun på nytt når det logges inn/ut, ellers baserer siden seg på skjul/vis av elementer og henting av data via AJAX. Har lagt til et bilde for å illustrere at det skjer noe når data blir lastet inn. Alt bortsett fra gradients, tekstskygge og placeholderteksten i innloggingsformen fungerer nå i Internet Explorer 9.</p>
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
				<div id="statistikk" class="nosidebar" style="display: none;">
					<article>
						<p><div class="l">3295</div><div class="r">KLIKK</div></p>
						<p><div class="l">34</div><div class="r">VISNINGER</div></p>
						<p><div class="l">13</div><div class="r">INNLOGGINGER</div></p>
						<p><div class="l">245</div><div class="r">KOMMENTARER</div></p>
						<p><div class="l">13</div><div class="r">BLOGGINNLEGG</div></p>
					</article>
				</div>
				<div id="showid"></div>
				<div id="logg-inn" class="nosidebar nofooter" style="display: none;">
					
				</div>
			</section>
			<aside id="sidebar">
				<section id="info">
					<header>
						<h1>Informasjon</h1>
					</header>
					<p>Nam orci diam, tempor eget malesuada a, feugiat vel magna. Aenean hendrerit, nulla at pharetra tristique, augue nulla condimentum magna, id feugiat purus nisl et tortor. Quisque dapibus est vel dolor iaculis hendrerit.</p>
				</section>
				<section id="userinfo">
				<?php include('userinfo.php'); ?>
	    		</section>
				<section id="archive">
					<header>
						<h1>Arkiv</h1>
					</header>
					<p><a href="#">Mars 2012</a></p>
					<p><a href="#">Februar 2012</a></p>
					<p><a href="#">Januar 2012</a></p>
					<p><a href="#">November 2011</a></p>
				</section>
				<section id="tags">
					<header>
						<h1>Tags</h1>
					</header>
					<p><a href="#">Tog (3)</a></p>
					<p><a href="#">Bil (1)</a></p>
					<p><a href="#">Fly (43)</a></p>
					<p><a href="#">Hund (13)</a></p>
					<p><a href="#">Kattemat (2)</a></p>
					<p><a href="#">Bonanza (4)</a></p>
				</section>
				<section id="search">
					<header>
						<h1>Søk</h1>
					</header>
					<form class="form1">
						<input type="text" />
					</form>
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
						<li><a href="#hjem">Hjem</a></li>
						<li><a href="#om-meg">Om meg</a></li>
						<li><a href="#logg">Prosjektlogg</a></li>
						<li><a href="#kontakt">Kontakt</a></li>
					</ul>
				</section>				
				<section id="footer_archive">
					<header>
						<h1>ARKIV</h1>
					</header>
					<ul>
						<li><a href="#">Mars 2012</a></li>
						<li><a href="#">Februar 2012</a></li>
						<li><a href="#">Januar 2012</a></li>
						<li><a href="#">November 2011</a></li>
					</ul>
				</section>
				<section id="footer_tags">
					<header>
						<h1>TAGS</h1>
					</header>
					<ul>
						<li><a href="#">Tog</a></li>
						<li><a href="#">Bil</a></li>
						<li><a href="#">Fly</a></li>
						<li><a href="#">Hund</a></li>
						<li><a href="#">Kattemat</a></li>
						<li><a href="#">Bonanza</a></li>
					</ul>
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