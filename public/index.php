<?php
session_start();
$redirect_uri = 'http://localhost/apw/public/';
$step = 1;

// Set variables for step 2
if ( isset( $_GET['step'] ) ) {

	if ( $_GET['step'] == '2' && isset( $_SESSION['data'] ) ) {

		// Set current step
		$step = 2;

		// Set data from session
		$data = $_SESSION['data'];
	}
}

// Set auth data
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
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
	<title>Awkward Photo Widget</title>
	<!-- Open Graph (Facebook) -->
	<!-- https://developers.facebook.com/docs/opengraph/howtos/maximizing-distribution-media-content -->
	<meta property="og:title" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:url" content="" />
	<meta property="og:description" content="" />
	<meta property="og:image" content="" />
	<meta property="og:type" content="" />
	<meta property="fb:app_id" content="" />
	<!-- Styles -->
	<link rel="stylesheet" href="styles/main.min.css" />
	<!-- Scripts -->
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="scripts/main.js"></script>
</head>
<body>

<header>
	<div class="container">
		<h1>Awkward Photo Widget for Instagram</h1>
		<p>This is an easy to use widget for displaying Instagram photos on your website.</p>
	</div>
</header>

<section id="main">
	<div class="container">
		<section>
			<h2>Client Details</h2>
			<p>Either you create your own client <a href="http://instagram.com/developer/clients/manage/" target="_blank">here</a>. Important to use <u><?= $redirect_uri ?></u> as your Redirect URI.</p>
			<p>Or you can use our client details if you don't want to create your own client:</p>
			<table class="table-borders">
				<thead>
					<tr>
						<th colspan="2">Awkward Photo Widget</th>
					</tr>
				</thead>
				<tr>
					<td>Client ID</td>
					<td>fcb74b7d135b4d5bbe1b713b6d9ae437</td>
				</tr>
				<tr>
					<td>Client Secret</td>
					<td>cb4ecf2b56e7499a9cb33d735b12b8cf</td>
				</tr>
			</table>
		</section>
		<?php if ( $step == 1 ) : ?>
		<section>
			<h2>1. Authenticate Widget</h2>
			<p>Enter client details below to authenticate the widget:</p>
			<input type="text" id="client-id" placeholder="Client ID" />
			<input type="text" id="client-secret" placeholder="Client Secret" />
			<input type="hidden" id="redirect-uri" value="<?= $redirect_uri ?>" />
			<input type="submit" value="Authenticate" onclick="javascript:apwAuthenticateWidget();">
		</section>
		<?php elseif ( $step == 2 ) : ?>
		<section>
			<h2>2. Customize Widget</h2>
			<p>Well this went great <?= $data->user->full_name ?>. You have now succesfully authorized the widget.</p>
			<p>Your Access Token is: <u><?= $data->access_token ?></u></p>
			<label>Enter username (for example @<?= $data->user->username ?>) or a hashtag (#awkward)</label>
			<input type="text" placeholder="User name" />
		</section>
		<?php endif; ?>
	</div>
</section>

<footer>
	<div class="container">

	</div>
</footer>

</body>
</html>