<?php session_start(); ?>
<!DOCTYPE html>
<html lang="no">
	<head>
		<title>Ken-H�vard's Blogg</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" href="master.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
		<script src="jquery.scrollTo-1.4.2-min.js"></script>
		<!--[if lte IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	</head> 
	<body>
		<header id="main_header">
			<div class="headerwrap">
				<div id="header_clock"></div>
				<h1>KEN-H�VARD'S BLOGG</h1>
			</div>
		</header>
		<nav id="menu">
			<ul class="headerwrap">
				<li><a href="#hjem">HJEM</a></li>
				<li><a href="#om-meg">OM MEG</a></li>
				<li><a href="#logg">PROSJEKTLOGG</a></li>
				<li><a href="#kontakt">KONTAKT</a></li>
			</ul>
		</nav>
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
				<div id="logg" style="display: none;">
					<article>
						<header>
							<h1>Prosjektlogg</h1>
						</header>
						<p><p><h3>10.03.2012 � 15.03.2012</h3> (ca. 0,5-2 timer per dag)</p>
Glemte � gj�re daglig loggf�ring i starten av prosjektet, f�r oppgaven ble lagt ut jobbet jeg med et nytt design(utseende). Jeg jobbet deretter med � flytte eksisterende funksjonalitet over p� database og begynte p� registrering av brukere. Det finnes n� to brukergrupper, en hardkodet adminbruker og registrerte brukere. Ingen validering av input har blitt implementert s� langt.</p>
<br />
<p><p><h3>16.03.2012</h3> (2 timer)</p>
Slettet ved et uhell hele prosjektet gjennom Eclipse, det havnet dermed ikke i papirkurven. Fikk gjenopprettet det meste ved � rulle tilbake mappen, mistet arbeidet jeg hadde gjort det siste d�gnet (innlogging og registrering + en meny og noen inputformer). For � unng� at slike ting skjer om igjen har jeg n� tatt i bruk versjonskontroll(Mercurial). Begynte med � implementere noe av det jeg hadde mistet, i tillegg begynte jeg p� visning av enkeltinnlegg hvor kommentarene skal listes opp under.</p>
<br />
<p><p><h3>20.03.2012</h3> (4 timer)</p>
Alt er tilbake der det var f�r jeg mistet prosjektet. Har i tillegg f�tt p� plass sending av nytt passord, passordet sendes via en gmail-konto jeg opprettet kun for dette prosjektet. Har kommet godt i gang med validering av brukerinput, det sjekkes om e-postadressen er ledig ved hjelp av AJAX, om passordene som har blitt skrevet inn er like osv.</p>
<br />
<p><p><h3>21.03.2012</h3> (2 timer)</p>
Har i dag for det meste jobbet videre med designet, har laget en ny header og en knapp, og jeg har begynt � jobbe med diverse ikoner.</p>
<br />
<p><p><h3>23.03.2012</h3> (2 timer)</p>
Har i dag for det meste gjort mer designarbeid, har laget en ny footer og puttet hele sidekartet i footeren og gjort en del andre forandringer. Har ogs� begynt � gj�re diverse forberedelser til visning av flere innlegg.</p>
<br />
<p><p><h3>25.03.2012</h3> (3 timer)</p>
N�r brukeren ber om nytt passord blir dette n� faktisk oppdatert i databasen, har wrappet mailsendingen i en egen metode siden jeg n� vil f� bruk for den flere plasser. Har lagt til aktivering av brukere, det sendes en mail til brukeren etter registrering med en link til et php-skript som gj�r aktiveringen. En tabell i databasen lagrer mappingen mellom brukerid og aktiveringskode. Blogginnlegg hentes n� med AJAX, flere innlegg hentes inn ved � trykke p� en knapp, det kan ogs� tenkes at dette kan skje automatisk n�r det scrolles til bunnen av siden. jQuery gj�r det � jobbe med AJAX til en dr�m. Har ogs� begynt p� kommentarer i dag.</p>
<br />
<p><p><h3>27.03.2012</h3> (1 time)</p>
Tatt i bruk jQuery Validation for validering av input.</p>
<br />
<p><p><h3>30.03.2012</h3></p>
All navigering p� siden skjer n� via hashtags, siden lastes kun p� nytt n�r det logges inn/ut, ellers baserer siden seg p� skjul/vis av elementer og henting av data via AJAX. Har lagt til et bilde for � illustrere at det skjer noe n�r data blir lastet inn. Alt bortsett fra gradients, tekstskygge og placeholderteksten i innloggingsformen fungerer n� i Internet Explorer 9.</p>
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
			</aside>		
		</div>
		<footer id="footer">
			<div class="headerwrap">
				<section id="footer_sitemap">
					<header>
						<h1>MENY</h1>
					</header>
					<ul>
						<li><a href="#hjem">HJEM</a></li>
						<li><a href="#om-meg">OM MEG</a></li>
						<li><a href="#logg">PROSJEKTLOGG</a></li>
						<li><a href="#kontakt">KONTAKT</a></li>
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
				<p>Ken-H�vard Lieng (c) 2012</p>
			</div>
		</footer>
	</body>
	<script type="text/javascript">
	var start = 0;
	var postsPerGet = 5;
	var currentPage = "#hjem";
	
	$.extend($.validator.messages, { 
		required: "Dette feltet m� fylles ut.", 
		email: "M� v�re en gyldig e-postadresse.",
		equalTo: "Passordene m� v�re like."
	});
	
	$(document).ready(function() {
		$("#registerform").validate({
			highlight: function(element, errorClass) {},
			submitHandler: function() {
				$.post('register.php', $("#registerform").serialize());
				document.location = 'index.php';
			},
			rules: {
				email: {
					remote: "checkemail.php"
				},
				pass2: {
					equalTo: "#pass"
				}
			},
			messages: {
				email: {
					remote: "Mailen er allerede i bruk."
				}
			}			
		});

		$("#newpassform").validate({
			highlight: function(element, errorClass) {},
			submitHandler: function() {
				$.post('newpass.php', $("#newpassform").serialize());
				$("#password").slideUp(function() {
					alert('Nytt passord sendt!');
					document.forms['newpassform'].reset();
				});
			}
		});

		window.onhashchange = function() {
			if (window.location.hash == '')
			{
				swapPage('#hjem');
			}
			else if (window.location.hash.indexOf('showid') != -1)
			{
				showId(window.location.hash.split('-')[1]);
			}
			else
			{
				swapPage(window.location.hash);
			}
		};
		
		$("#main_header h1").fadeIn("slow");
		getMorePosts();
		tick();
	});
	
	function swapPage(page)
	{
		/*$(currentPage).fadeOut("fast", function() {
			$(page).fadeIn("fast");
			currentPage = page;
		});	*/
		$(currentPage).hide();
		$(page).show();
		currentPage = page;
	}

	function getMorePosts()
	{
		$('#loading').insertBefore('#bottom_menu');
		$('#bottom_menu').hide();
		$('#loading').fadeIn();
		$.get('listposts.php', { from: start, n: postsPerGet },
			function(result) {
				$('#bottom_menu').before(result);				
				$('#loading').hide();
				$('#bottom_menu').show();
		});
		start += postsPerGet;		
	}

	function showId(id)
	{
		$('#showid').html('');
		swapPage('#showid');
		$.get('listposts.php', { showid: id },
			function(result) {		
				$('#showid').html(result);
		});		
	}

	function tick()
	{
		var now = new Date();

		document.getElementById('header_clock').innerHTML =
			pad(now.getHours()) + ':' +
			pad(now.getMinutes()) + ':' +
			pad(now.getSeconds());

		setTimeout('tick()', 1000);
	}

	function pad(n)
	{
		if (n < 10)
			return '0' + n;
		return n;
	}
	</script>
</html>