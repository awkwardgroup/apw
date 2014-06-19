<?php
$version = 'Beta Version 0.1.1';
$updated = '2014-06-19';

// Start session for storing data
session_start();

// Define variables
if ( $_SERVER['HTTP_HOST'] == 'localhost' ) {

	$client_id = '4da3dafe25cf4ee48c7a7a9b967d4009';
	$client_secret = '4fe4ac3567f64858bdb3ba8971891b7a';
	$redirect_uri = 'http://localhost/apw/public/';
}
else {

	$client_id = 'fcb74b7d135b4d5bbe1b713b6d9ae437';
	$client_secret = 'cb4ecf2b56e7499a9cb33d735b12b8cf';
	$redirect_uri = 'https://apw.awkwardgroup.com';
}
$step = 0;

// Set variables for step 2
if ( isset( $_GET['step'] ) ) {

	if ( $_GET['step'] == '2' && isset( $_SESSION['data'] ) ) {

		// Set current step
		$step = 2;

		// Set data from session
		$data = $_SESSION['data'];
	}
	elseif ( $_GET['step'] == '1' ) {

		// Set current step
		$step = 1;
	}
}

// Set data after authentication
if ( isset( $_GET['client_details'] ) && isset( $_GET['code'] ) ) {

	// Get client details
	$client_details = split( ':', $_GET['client_details'] );
	
	// Set URL
	$url = 'https://api.instagram.com/oauth/access_token';

	// Query
	$access_token_parameters = array(
		'client_id' => $client_details[0],
		'client_secret' => $client_details[1],
		'grant_type' => 'authorization_code',
		'redirect_uri' => $redirect_uri . '?client_details=' . $_GET['client_details'],
		'code'		=> $_GET['code']
	);

	// Execute cURL
	$curl = curl_init( $url );
	curl_setopt( $curl, CURLOPT_POST, true );
	curl_setopt( $curl, CURLOPT_POSTFIELDS, $access_token_parameters );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
	$data = json_decode( curl_exec( $curl ) );
	curl_close( $curl );

	// Save data to session
	if ( isset( $data->access_token ) ) {
		
		$_SESSION['data'] = $data;
		header( 'Location: ' . $redirect_uri . '?step=2' );
	}
	else {
		header( 'Location: ' . $redirect_uri );
	}
}
?>