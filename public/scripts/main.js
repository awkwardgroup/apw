function apwAuthenticateWidget() {

	var client_id = $( '#client-id' ).val();
	var client_secret = $( '#client-secret' ).val();
	var redirect_uri = $( '#redirect-uri' ).val() + '?client_details=' + client_id + ':' + client_secret ;

	location.href = 'https://api.instagram.com/oauth/authorize/?client_id=' + client_id + '&redirect_uri=' + redirect_uri + '&response_type=code';
}