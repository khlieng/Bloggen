<DOCTYPE html>
<html lang="no">
	<head>
		<title>Project Herp</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" href="master.css" />		
		<?php session_start(); ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
		<!--[if lte IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	</head> 
	<body>
		<header id="main_header">
			<div class="headerwrap">
				<div id="header_clock"></div>
				<h1>KEN-HÅVARD'S BLOGG</h1>
			</div>
		</header>
		<nav id="menu">
			<ul class="headerwrap">
				<li><a href="index.php">HJEM</a></li>
				<li><a href="#">OM MEG</a></li>
				<li><a href="#">PROSJEKTLOGG</a></li>
				<li><a href="#">KONTAKT</a></li>
			</ul>
		</nav>
		<div id="wrap">
			<section id="content">
				<article id="register" class="form_article">
					<header>
						<h1>Ny bruker</h1>
					</header>
					<form class="form1" id="registerform" name="registerform" method="post" action="register.php">
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
				<!-- Blogginnlegg blir satt inn her -->
				<div id="bottom_menu">
					<button id="button_show_more" onClick="getMorePosts()">Vis flere innlegg</button>
					<button>Tilbake til toppen</button>
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
					<p><a href="#">Tog</a></p>
					<p><a href="#">Bil</a></p>
					<p><a href="#">Fly</a></p>
					<p><a href="#">Hund</a></p>
					<p><a href="#">Kattemat</a></p>
					<p><a href="#">Bonanza</a></p>
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
						<li><a href="index.php">HJEM</a></li>
						<li><a href="#">OM MEG</a></li>
						<li><a href="#">PROSJEKTLOGG</a></li>
						<li><a href="#">KONTAKT</a></li>
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
				<p>Ken-Håvard Lieng (c) 2012</p>
			</div>
		</footer>
	</body>
	<script type="text/javascript">
	var start = 0;
	var postsPerGet = 5;
	
	$.extend($.validator.messages, { 
		required: "Dette feltet må fylles ut.", 
		email: "Må være en gyldig e-postadresse.",
		equalTo: "Passordene må være like."
	});
	
	$(document).ready(function() {
		$("#registerform").validate({
			highlight: function(element, errorClass) {},
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
				$("#password").slideUp();
				setTimeout('alert("Nytt passord sendt!")', 400);
			}
		});
		
		$("#main_header h1").fadeIn("slow");
		getMorePosts();
		tick();
	});

	function getMorePosts()
	{
		$.get('listposts.php', { from: start, n: postsPerGet },
			function(result) {
				$('#bottom_menu').before(result);
		});
		start += postsPerGet;		
	}

	function showId(id)
	{
		$('.blogpost').remove();
		$.get('listposts.php', { showid: id },
			function(result) {				
				$('#bottom_menu').before(result);
		});
	}

	function slideToggle(element)
	{
		$(element + ":visible").slideUp();
		$(element + ":hidden").slideDown();		
	}

	function checkEmail(form)
	{
		var email = $(form).find("input[name=email]").val();

		$.get('checkemail.php', { email: email }, 
			function(result) {
				$(form).find("label[name=email_result]").html(result);
		});		 
	}

	function checkPasswords(form)
	{
		var p1 = document.forms[form].pass.value;
		var p2 = document.forms[form].pass2.value;

		if (p1 != p2)
		{
			document.getElementById('password_result').innerHTML = 'Passordene er ikke like.'
		}
		else
		{
			document.getElementById('password_result').innerHTML = null;
		}	
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