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
});

function apwAuthenticateWidget() {

	// Default client details
	var client_id = 'fcb74b7d135b4d5bbe1b713b6d9ae437';
	var client_secret = 'cb4ecf2b56e7499a9cb33d735b12b8cf';

	// If user created a new client
	if ( $( '#client-select' ).val() == 'client-settings-new' ) {
		
		client_id = $( '#client-settings-new-id' ).val();
		client_secret = $( '#client-settings-new-secret' ).val();
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

		var html = $( 'code' ).html();
		html = html.replace( 'INSERT_JSON_LINK', url );
		$( 'code' ).html( html );
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

	// Build list
	request.done( function( data ) {
		
		var items = [];

		jQuery.each( data['data'], function( key, item ) {
			
			var li = '<li id="image-' + item['id'] + '">';
			li += '<a href="' + item['link'] + '" target="_blank" title="' + item['caption']['text'] + '">';
			li += '<img src="' + item['images']['low_resolution']['url'] + '" alt="' + item['caption']['text'] + '" />';
			li += '<p>' + item['caption']['text'] + '</p>';
			li += '</a></li>';
			items.push( li );
		});

		jQuery( '.apw-list' ).html( '' );
		jQuery( '.apw-list' ).append( items.join('') );
	});
}

// Tabs
$(document).ready(function () {
  $('.accordion-tabs-minimal').each(function(index) {
    $(this).children('li').first().children('a').addClass('is-active').next().addClass('is-open').show();
  });

  $('.accordion-tabs-minimal').on('click', 'li > a', function(event) {
    if (!$(this).hasClass('is-active')) {
      event.preventDefault();
      var accordionTabs = $(this).closest('.accordion-tabs-minimal')
      accordionTabs.find('.is-open').removeClass('is-open').hide();

      $(this).next().toggleClass('is-open').toggle();
      accordionTabs.find('.is-active').removeClass('is-active');
      $(this).addClass('is-active');
    } else {
      event.preventDefault();
    }
  });
});
