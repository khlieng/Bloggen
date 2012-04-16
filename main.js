//
// jQuery
//	
$.extend($.validator.messages, { 
	required: "*", 
	email: "Må være en gyldig e-postadresse.",
	equalTo: "Passordene må være like."
});

$(document).ready(function() {	
	$("#main_header h1").fadeIn("slow");
	//tick();
	
	window.onhashchange = hashHandler;		
	hashHandler(); // Kaller denne en gang i tilfelle siden blir navigert til med et hashtag initielt
		
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

	$("#newpostform").submit(function() {
		$.post('newpost.php', $("#newpostform").serialize());
		$("#newpost").slideToggle();
		reloadPosts();
		document.forms["newpostform"].reset();
		return false;
	});

	$("#confirm_button_yes").click(function() {
		confirmed = true;
		closeDialog('#confirm_dialog');
	});

	$("#confirm_button_no").click(function() {
		closeDialog('#confirm_dialog');
	});

	$(".tabnav a").click(function(e) {
		$(this).parent().parent().parent().children(".tab").removeClass("current");
		$(this).parent().parent().children("li").children("a").removeClass("current");
		$(this.hash).addClass("current");
		$(this).addClass("current");
		return false;
	});
});

//
// Navigering
//	
var currentPage = "#hjem";

function hashHandler()
{
	currentPostId = -1;

	var split = window.location.hash.split("!/");
	var hash = split[0] + split[1];
	
	if (window.location.hash == '' || split == null)
	{
		swapPage('#hjem');
	}
	else if (hash.indexOf('vis') != -1)
	{
		showId(hash.split('/')[1]);
	}
	else
	{
		swapPage(hash);
	}
}

function swapPage(page)
{
	if ($(page).hasClass('nosidebar'))
	{
		hideSidebar();
	}
	else
	{
		showSidebar();
	}
	if ($(page).hasClass('nofooter'))
	{
		$("#footer").hide();
	}
	else
	{
		$("#footer").show();
	}

	if (page == '#hjem' && !initialPostLoadDone)
	{
		$('#hjem').append('<div class="loading"></div>');
		$('#hjem .loading').fadeIn();
		getMorePosts();
		initialPostLoadDone = true;
	}

	$(currentPage).hide();
	$(page).show();
	currentPage = page;
	if (page != '#hjem')
	{
		$.scrollTo('#main_header', 250);
	}
}

function hideSidebar()
{
	//$("#sidebar").hide();
	//$("#content").css("width", 960);
}

function showSidebar()
{
	//$("#content").css("width", 660);
	//$("#sidebar").show();	
}

//
// Innhold
//
var start = 0;
var postsPerGet = 5;
var currentPostId;
var initialPostLoadDone = false;

function getMorePosts()
{
	//$('#loading').insertBefore('#bottom_menu');
	//$('#bottom_menu').before('<div id="loading"></div>');
	//$('#bottom_menu').hide();
	//$('#loading').fadeIn();
	$('#button_show_more').text('Henter innlegg...');
	$.get('listposts.php', { from: start, n: postsPerGet },
		function(result) {
			$('#bottom_menu').before(result);				
			$('#hjem .loading').remove();
			$('#bottom_menu').show();
			$('#button_show_more').text('Vis flere innlegg');
	});
	start += postsPerGet;		
}

function reloadPosts()
{
	$('#hjem .blogpost').remove();
	start = 0;
	getMorePosts();
}

function showId(id)
{
	currentPostId = id;
	$('#showid article').remove();		
	swapPage('#showid');
	$('#showid').append($('<div class="loading"></div>'));	
	$('#showid .loading').fadeIn();
	$.get('listposts.php', { postid: id },
		function(result) {		
			$('#showid').html(result);
			$('#showid .loading').remove();
			updateComments(id);
	});		
}

function updateComments(id)
{
	$.get('listcomments.php', { postid: id },
		function(result) {
			if (id == currentPostId)
			{
				$('#comments').html(result);
				setTimeout('updateComments(' + id + ')', 1000);
			}
	});
}

function deletePost(id)
{
	openDialog('#confirm_dialog', function() {
		if (confirmed)
		{
			$('#blogpost-id-' + id).fadeOut();
			$.get('delete.php', { type: 'post', id: id });
			start--;	
			confirmed = false;
		}
	});			
}

function deleteComment(id)
{
	$('#comment-id-' + id).remove();
	$.get('delete.php', { type: 'comment', id: id });
}

//
// Brukerstuff
//
function resendActivation()
{
	$.get('sendactivation.php');
}

//
// Dialoger
//
var confirmed = false;
var onDialogClose;

function openDialog(dialog, onClose)
{
	$('#overlay').click(function(e) {
		closeDialog(dialog);
	});
	$('#overlay').fadeIn();
	$(dialog).show();
	onDialogClose = onClose;
}

function closeDialog(dialog)
{
	$('#overlay').hide();
	$(dialog).hide();
	onDialogClose();
}

//
// Klokke
//
function tick()
{
	var now = new Date();

	$('#header_clock').html(
		pad(now.getHours()) + ':' +
		pad(now.getMinutes()) + ':' + 
		pad(now.getSeconds()));

	setTimeout('tick()', 1000);
}

function pad(n)
{
	if (n < 10)
		return '0' + n;
	return n;
}