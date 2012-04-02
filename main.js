//
// jQuery
//	
$.extend($.validator.messages, { 
	required: "*", 
	email: "Må være en gyldig e-postadresse.",
	equalTo: "Passordene må være like."
});

$(document).ready(function() {
	getMorePosts();
	$("#main_header h1").fadeIn("slow");
	tick();
	
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

	$("#confirm_button_yes").click(function() {
		confirmed = true;
		closeDialog('#confirm_dialog');
	});

	$("#confirm_button_no").click(function() {
		closeDialog('#confirm_dialog');
	});
});

//
// Navigering
//	
var currentPage = "#hjem";

function hashHandler()
{
	currentPostId = -1;
	
	if (window.location.hash == '')
	{
		swapPage('#hjem');
	}
	else if (window.location.hash.indexOf('vis') != -1)
	{
		showId(window.location.hash.split('/')[1]);
	}
	else
	{
		swapPage(window.location.hash);
	}
}

function swapPage(page)
{
	$(currentPage).hide();
	$(page).show();
	currentPage = page;
	if (page != '#hjem')
	{
		$.scrollTo('#main_header', 250);
	}
}

//
// Innhold
//
var start = 0;
var postsPerGet = 5;
var currentPostId;

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
	currentPostId = id;
	$('#showid article').remove();
	$('#showid').append($('#loading'));		
	swapPage('#showid');
	$('#loading').fadeIn();
	$.get('listposts.php', { postid: id },
		function(result) {		
			$('#showid').html(result);
			$('#loading').hide();
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
// Dialoger
//
var confirmed = false;
var onDialogClose;

function openDialog(dialog, onClose)
{
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