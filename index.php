<DOCTYPE html>
<html lang="no">
	<head>
		<title>Project Herp</title>
		<link rel="stylesheet" href="master.css" />
		<?php session_start(); ?>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript">
		window.onscroll = foo;

		function foo()
		{
			if (window.pageYOffset >= window.innerHeight)
			{
				alert('Bunnen er nådd!');
			}
		}
		</script>
	</head> 
	<body id="b">
		<header id="main_header">
			<div class="headerwrap">
				<h1>KEN-HÅVARD'S BLOGG</h1>
			</div>
		</header>
		<nav id="menu">
			<ul class="headerwrap">
				<li><a href="#">Hjem</a></li>
				<li><a href="#footer">Om meg</a></li>
			</ul>
		</nav>
		<div id="wrap">
			<section id="content">
				<article id="register">
					<header>
						<h1>Ny bruker</h1>
					</header>
					<form class="form1" id="registerform" name="registerform" method="post" action="register.php">
						<p>
							<label for="name">Navn</label>
							<input type="text" id="name" name="name" />
						</p>
						<p>
							<label for="email">E-post</label>
							<input type="text" id="email" name="email" onKeyUp="checkEmail('registerform')" onChange="checkEmail('registerform')" />
							<label id="result" class="email_result"></label>
						</p>
				   		<p>
				   			<label for="pass">Passord</label>
				   			<input type="password" id="pass" name="pass" onKeyUp="checkPasswords('registerform')" onChange="checkPasswords('registerform')" />
				   			<label id="password_result"></label>
			   			</p>
			   			<p>
				   			<label for="pass">Bekreft passord</label>
				   			<input type="password" id="pass2" name="pass2" onKeyUp="checkPasswords('registerform')" onChange="checkPasswords('registerform')" />
			   			</p>
			   			<p>
			   				<label></label>
							<input type="submit" value="Registrer" />
						</p>
					</form>
				</article>
				<article id="password">
					<header>
						<h1>Glemt passord</h1>
					</header>
					<form class="form1" id="newpassform" name="newpassform" method="post" action="newpass.php">
						<p>
							<label for="email">E-post</label>
							<input type="text" id="email" name="email" onChange="checkEmail('newpassform')" />
						</p>
			   			<p>
			   				<label></label>
							<input type="submit" value="Send nytt passord" />
						</p>
					</form>
				</article>
				<article id="newpost">
					<header>
						<h1>Nytt innlegg</h1>
					</header>
					
				</article>
				<?php include('listposts.php') ?>
				<article>
					<header>
						<h1><a href="#">Første innlegg</a></h1>
						<p class="date">10.03.2012 16:13</p>
					</header>
							
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed hendrerit, diam eu convallis dignissim, turpis eros convallis eros, luctus malesuada felis est id libero.</p>
					<figure><img src="http://www.bablotech.com/wp-content/uploads/2009/09/White_night.jpg" width="400" height="300"></figure>
					<p>Integer dignissim urna non justo vulputate iaculis. Ut placerat massa sed neque bibendum viverra. Aliquam erat volutpat. Vivamus ligula odio, feugiat sed mollis vitae, ornare id neque. Ut ullamcorper dictum dui, in vehicula urna hendrerit vel. Nam orci diam, tempor eget malesuada a, feugiat vel magna. Aenean hendrerit, nulla at pharetra tristique, augue nulla condimentum magna, id feugiat purus nisl et tortor. Quisque dapibus est vel dolor iaculis hendrerit.</p>
					<footer>
						<div class="floatleft">Postet 10.03.2012 16:13 | <a href="#">0 kommentarer</a></div><div class="floatright">Tags: <a href="#">Bil</a> | <a href="#">Båt</a> | <a href="#">Bonanza</a></div>
					</footer>
				</article>
				<article>
					<header>
						<h1>Andre innlegg</h1>
						<p class="date">10.03.2012 16:39</p>
					</header>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed hendrerit, diam eu convallis dignissim, turpis eros convallis eros, luctus malesuada felis est id libero. Integer dignissim urna non justo vulputate iaculis. Ut placerat massa sed neque bibendum viverra. Aliquam erat volutpat. Vivamus ligula odio, feugiat sed mollis vitae, ornare id neque. Ut ullamcorper dictum dui, in vehicula urna hendrerit vel. Nam orci diam, tempor eget malesuada a, feugiat vel magna. Aenean hendrerit, nulla at pharetra tristique, augue nulla condimentum magna, id feugiat purus nisl et tortor. Quisque dapibus est vel dolor iaculis hendrerit.</p>
					<footer>
						<div class="floatleft">Postet 10.03.2012 16:39 | <a href="#">4 kommentarer</a></div><div class="floatright">Tags: <a href="#">Bil</a> | <a href="#">Bonanza</a></div>
					</footer>
				</article>
				<article>
					<header>
						<h1>Tredje innlegg</h1>
						<p class="date">10.03.2012 16:40</p>
					</header>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed hendrerit, diam eu convallis dignissim, turpis eros convallis eros, luctus malesuada felis est id libero. Integer dignissim urna non justo vulputate iaculis. Ut placerat massa sed neque bibendum viverra. Aliquam erat volutpat. Vivamus ligula odio, feugiat sed mollis vitae, ornare id neque. Ut ullamcorper dictum dui, in vehicula urna hendrerit vel. Nam orci diam, tempor eget malesuada a, feugiat vel magna. Aenean hendrerit, nulla at pharetra tristique, augue nulla condimentum magna, id feugiat purus nisl et tortor. Quisque dapibus est vel dolor iaculis hendrerit.</p>
					<footer>
						<div class="floatleft">Postet 10.03.2012 16:40 | <a href="#">13 kommentarer</a></div><div class="floatright">Tags: <a href="#">Bil</a></div>
					</footer>
				</article>
				<div id="pagenav"><a href="#" class="floatleft">&#60; Eldre innlegg</a><a href="#" class="floatright">Nyere innlegg &#62;</a></div>
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
			<p>Ken-Håvard Lieng (c) 2012</p>
		</footer>
	</body>
	<script type="text/javascript">
	$(document).ready(function() {
		$("#main_header h1").fadeIn("slow");
	});

	function slideToggle(element)
	{
		$(element + ":visible").slideUp();
		$(element + ":hidden").slideDown();		
	}

	function checkEmail(form)
	{
		var email = document.forms[form].email.value;
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4)
			{
				document.getElementById('result').innerHTML = xmlHttp.responseText;	
			}
		}
		xmlHttp.open('GET', 'checkemail.php?m=' + document.forms[form].email.value, true);
		xmlHttp.send();			
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
	</script>
</html>