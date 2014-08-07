//banner behavior
function bannerhover() {
	document.getElementById("bannermag").style.borderColor = "#eee";
}
function bannerout() {
	document.getElementById("bannermag").style.borderColor = "#ddd";
}
function bannerclick() {
	$('.ui.modal').modal('show');
}

// Facebook SDK init
window.fbAsyncInit = function() {
	FB.init({
		appId      : '267865553402572',
		xfbml      : true,
		version    : 'v2.0',
		status     : true,
	});
};

(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Facebook Share button
$('#fb-btn').on('click', function() {
	FB.ui({
		method: 'share',
		href: 'http://localhost/halkom/public/competition/1',
	}, function(response){});
});