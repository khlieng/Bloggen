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
	
	window.onhashchange = hashHandler;		
	hashHandler(); // Kaller denne en gang i tilfelle siden blir navigert til med et hashtag initielt
		
	/*$("#registerform").validate({
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
	});*/

	$("#registerform").submit(function() {
		$.post('register.php', $("#registerform").serialize());
		closeDialog('#register_dialog');
		document.forms["registerform"].reset();
		return false;
	});

	/*$("#newpassform").validate({
		highlight: function(element, errorClass) {},
		submitHandler: function() {
			$.post('newpass.php', $("#newpassform").serialize());
			$("#password").slideUp(function() {
				alert('Nytt passord sendt!');
				document.forms['newpassform'].reset();
			});
		}
	});*/

	$("#newpassform").submit(function() {
		$.post('newpass.php', $("#newpassform").serialize());
		$("#newpassform").fadeOut();
		document.forms["newpassform"].reset();
		return false;
	});

	$("#newpostform").submit(function() {
		$.post('newpost.php', $("#newpostform").serialize());
		closeDialog('#newpost_dialog');
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

	$("#searchform").submit(function() {
		searchPosts($('#searchform input[name="search"]').val());
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
	else if (hash.indexOf('tag') != -1)
	{
		resetState();
		initialPostLoadDone = true;
		swapPage('#hjem');
		tag = hash.split('/')[1];

		$('#content_header h2').text('Innlegg tagget med "' + tag + '"');
		$('#content_header').show();
		
		reloadPosts();
		$.scrollTo('#main_header', 250);
	}
	else if (hash.indexOf('arkiv') != -1)
	{
		resetState();
		initialPostLoadDone = true;
		swapPage('#hjem');
		month = hash.split('/')[1];
		year = hash.split('/')[2];

		var m = new Array("","Januar", "Februar", "Mars", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Desember");

		$('#content_header h2').text('Innlegg fra ' + m[month] + ' ' + year);
		$('#content_header').show();
		
		reloadPosts();
		$.scrollTo('#main_header', 250);
	}
	else if (hash.indexOf('sok') != -1)
	{
	}
	else
	{
		swapPage(hash);
	}
}

function swapPage(page)
{
	if (page == '#hjem' && (!initialPostLoadDone || tag != -1 || search != "" || month != -1 || year != -1))
	{
		$('#content_header').hide();
		$('#hjem .blogpost').remove();
		$('#bottom_menu').hide();		
		$('#hjem').append('<div class="loading"></div>');
		$('#hjem .loading').fadeIn();		
		resetState();
		start = 0;
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

//
// Innhold
//
var start = 0;
var postsPerGet = 5;
var currentPostId;
var initialPostLoadDone = false;
var tag = -1;
var search = "";
var month = -1;
var year = -1;

function getMorePosts()
{
	$('#button_show_more').text('Henter innlegg...');
	params = { from: start, n: postsPerGet };
	if (tag != -1)
	{
		params.tag = tag;
	}
	if (search != "")
	{
		params.search = search;
	}
	if (month != -1)
	{
		params.month = month;
	}
	if (year != -1)
	{
		params.year = year;
	}

	$.get('listposts.php', params,
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
	$('#bottom_menu').hide();
	$('#hjem').append('<div class="loading"></div>');
	$('#hjem .loading').fadeIn();
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
	$('#comment-id-' + id).fadeOut();
	$.get('delete.php', { type: 'comment', id: id });
}

function searchPosts(searchphrase)
{
	window.location.hash = "#!/sok";
	resetState();
	initialPostLoadDone = true;
	swapPage('#hjem');
	search = searchphrase;
	$('#content_header h2').text('Søkeresultater for "' + searchphrase + '"');
	$('#content_header').show();	
	reloadPosts();
}

function resetState()
{
	tag = -1;
	search = "";
	month = -1;
	year = -1;
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
	$(dialog + ' .dialog_close').click(function(e) {
		closeDialog(dialog);
	});
	$('#overlay').click(function(e) {
		closeDialog(dialog);
	});
	$('#overlay').fadeIn();
	$('#dialog_container').width($(dialog).width());
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