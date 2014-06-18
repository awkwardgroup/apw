<?php/*
<ul class="apw-list"></ul>

<script>
jQuery( document ).ready( function() {
	apwGenerateWidget( 'INSERT_JSON_LINK' );
});

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
</script>
*/?>
<pre>&lt;ul <span style=' color: Blue;'>class</span>=<span style=' color: Maroon;'>"apw-list"</span>&gt;&lt;/ul&gt; 

&lt;script&gt; 
jQuery( document ).ready( <span style=' color: Blue;'>function</span>() { 
    apwGenerateWidget( <span style=' color: Maroon;'>'INSERT_JSON_LINK'</span> ); 
}); 

<span style=' color: Blue;'>function</span> apwGenerateWidget( json_link ) { 
     
    <span style=' color: Green;'>// Get JSON data</span> 
    <span style=' color: Blue;'>var</span> request = jQuery.ajax({ 
        type: <span style=' color: Maroon;'>'GET'</span>, 
        dataType: <span style=' color: Maroon;'>'jsonp'</span>, 
        url: json_link 
    }); 

    request.done( <span style=' color: Blue;'>function</span>( data ) { 
         
        <span style=' color: Blue;'>var</span> items = []; 

        jQuery.each( data[<span style=' color: Maroon;'>'data'</span>], <span style=' color: Blue;'>function</span>( key, item ) { 
             
            <span style=' color: Green;'>// Set caption</span> 
            <span style=' color: Blue;'>var</span> caption = <span style=' color: Maroon;'>''</span>;
            <span style=' color: Blue;'>if</span> ( <span style=' color: Blue;'>typeof</span> item[<span style=' color: Maroon;'>'caption'</span>][<span style=' color: Maroon;'>'text'</span>] != <span style=' color: Maroon;'>'undefined'</span> ) { caption = item[<span style=' color: Maroon;'>'caption'</span>][<span style=' color: Maroon;'>'text'</span>]; } 

            <span style=' color: Green;'>// Build list item</span> 
            <span style=' color: Blue;'>var</span> li = <span style=' color: Maroon;'>'&lt;li id="image-'</span> + item[<span style=' color: Maroon;'>'id'</span>] + <span style=' color: Maroon;'>'"&gt;'</span>;
            li += <span style=' color: Maroon;'>'&lt;a href="'</span> + item[<span style=' color: Maroon;'>'link'</span>] + <span style=' color: Maroon;'>'" target="_blank" title="'</span> + caption + <span style=' color: Maroon;'>'"&gt;'</span>;
            li += <span style=' color: Maroon;'>'&lt;img src="'</span> + item[<span style=' color: Maroon;'>'images'</span>][<span style=' color: Maroon;'>'low_resolution'</span>][<span style=' color: Maroon;'>'url'</span>] + <span style=' color: Maroon;'>'" alt="'</span> + caption + <span style=' color: Maroon;'>'" /&gt;'</span>;
            <span style=' color: Blue;'>if</span> ( caption !== <span style=' color: Maroon;'>''</span> ) { li += <span style=' color: Maroon;'>'&lt;p&gt;'</span> + caption + <span style=' color: Maroon;'>'&lt;/p&gt;'</span>; }
            li += <span style=' color: Maroon;'>'&lt;/a&gt;&lt;/li&gt;'</span>; 
            items.push( li ); 
        }); 

        jQuery( <span style=' color: Maroon;'>'.apw-list'</span> ).html( <span style=' color: Maroon;'>''</span> ); 
        jQuery( <span style=' color: Maroon;'>'.apw-list'</span> ).append( items.join(<span style=' color: Maroon;'>''</span>) ); 
    }); 
} 
&lt;/script&gt;</pre>