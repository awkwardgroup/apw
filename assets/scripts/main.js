$( document ).ready( function() {

	// Step 1 - Client Select
	$( '#client-select' ).change( function() {

		var id = $( this ).val();
		$( '.client-settings' ).hide();
		$( '#' + id ).show();
	});

	// Step 2 - Widget Select
	$( '#widget-select' ).change( function() {

		var id = $( this ).val();
		$( '.widget-settings' ).hide();
		$( '#' + id ).show();
	});

	// Example widget step 1
	 apwGenerateWidget( 'https://api.instagram.com/v1/tags/wc2014/media/recent?access_token=7844502.fcb74b7.1ec5839ceb1142e3aea84585a0440cdf&count=8' );
});

function apwAuthenticateWidget() {

	// If user created a new client
	if ( $( '#client-select' ).val() == 'client-settings-new' ) {
		
		var client_id = $( '#client-settings-new-id' ).val();
		var client_secret = $( '#client-settings-new-secret' ).val();
	}
	// Default client details
	else {

		var client_id = $( '#client-settings-default-id' ).val();
		var client_secret = $( '#client-settings-default-secret' ).val();
	}
	
	// Build redirect URL
	var redirect_uri = $( '#redirect-uri' ).val() + '?client_details=' + client_id + ':' + client_secret ;

	// Redirect for authentication
	location.href = 'https://api.instagram.com/oauth/authorize/?client_id=' + client_id + '&redirect_uri=' + redirect_uri + '&response_type=code';
}

function apwGenerateJSON() {

	var media_type = $( '#widget-select' ).val();
	var access_token = $( '#access-token' ).val();

	if ( media_type == 'widget-settings-user' ) {

		var user_id = $( '#widget-settings-user-id' ).val();
		var user_parameter = '&' + $( '#widget-settings-user-parameter' ).val();
		var url = 'https://api.instagram.com/v1/users/' + user_id + '/media/recent?access_token=' + access_token + user_parameter
	}
	else if ( media_type ==  'widget-settings-tag' ) {

		var tag_key = $( '#widget-settings-tag-key' ).val();
		var tag_parameter = '&' + $( '#widget-settings-tag-parameter' ).val();
		var url = 'https://api.instagram.com/v1/tags/' + tag_key + '/media/recent?access_token=' + access_token + tag_parameter
	}

	$( '#generated-widget' ).fadeIn(500, function() {

		var html = $( 'code.embed' ).html();
		html = html.replace( 'INSERT_JSON_LINK', url );
		$( 'code.embed' ).html( html );
	});

	var target = $( '#generated-widget' );
	target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	if ( target.length ) {
		$('html,body').animate({
			scrollTop: target.offset().top - 30
		}, 1000);
	}

	$( '#widget-json-link' ).text( url );
	apwGenerateWidget( url );
}

function apwGenerateWidget( json_link ) {
	
	// Get JSON data
	var request = jQuery.ajax({
		type: 'GET',
		dataType: 'jsonp',
		url: json_link
	});

	request.done( function( data ) {
		
		var items = [];

		jQuery.each( data['data'], function( key, item ) {
			
			// Set caption
			var caption = '';
			if ( typeof item['caption']['text'] != 'undefined' ) { caption = item['caption']['text']; }

			// Build list item
			var li = '<li id="image-' + item['id'] + '">';
			li += '<a href="' + item['link'] + '" target="_blank" title="' + caption + '">';
			li += '<img src="' + item['images']['low_resolution']['url'] + '" alt="' + caption + '" />';
			if ( caption !== '' ) { li += '<p>' + caption + '</p>'; }
			li += '</a></li>';
			items.push( li );
		});

		jQuery( '.apw-list' ).html( '' );
		jQuery( '.apw-list' ).append( items.join('') );
	});
}