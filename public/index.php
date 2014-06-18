<?php include( 'functions.php' ); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
	<title>Awkward Photo Widget for Instagram</title>
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
		<h1><a href="<?= $redirect_uri ?>">Awkward Photo Widget for Instagram</a></h1>
		<p class="intro">This free service makes it easy for developers and designers to display  Instagram photos in any type of application.</p>
	</div>
</header>

<section id="main">
	<div class="container">
		<!-- STEP 0 (START) -->
		<?php if ( $step == 0 ) : ?>
		<p>The service delivers a <u>Widget</u> that can be customized to your preferences. It is embeded in your application as HTML and JavaScript.</p>
		<p>You can also use the <u>JSON link</u> with JSON data instead of the widget. This is usefull if you're a more exprienced developer and want total control of the front-end structure.</p>
		<div class="buttons">
			<a class="button" href="?step=1">Let's get started</a>
		</div>
		<!-- STEP 1 (CHOOSE CLIENT) -->
		<?php elseif ( $step == 1 ) : ?>
		<section>
			<h2>1. Choose Client</h2>
			<p>First you need to choose a client so that the widget can access the Instagram API. We recommend that you create your own client in the <a href="http://instagram.com/developer/clients/manage/" target="_blank">Instagram Developer Panel</a>. It is important that you use <u><?= $redirect_uri ?></u> as Redirect URI.</p>
			<p>You can also use our default client if you don't want to create your own.</p>
		</section>
		<section>
			<label></label>
			<select id="client-select">
				<option value="client-settings-new" selected="selected">I want to use my own client (recommended)</option>
				<option value="client-settings-default">I want to use the default client</option>
			</select>
			<input type="hidden" id="redirect-uri" value="<?= $redirect_uri ?>" />
		</section>
		<section>
			<div class="client-settings" id="client-settings-new">
				<label>Enter your client details below:</label>
				<input type="text" id="client-settings-new-id" placeholder="Client ID" />
				<input type="text" id="client-settings-new-secret" placeholder="Client Secret" />
			</div>
			<div class="buttons">
				<span class="button" onclick="javascript:apwAuthenticateWidget();">Authenticate Client</span>
			</div>
		</section>
		<!-- STEP 2 (GENERATE WIDGET) -->
		<?php elseif ( $step == 2 ) : ?>
		<section>
			<h2>2. Generate Widget</h2>
			<p>Your Username is <u><?= $data->user->username ?></u> and your User ID is <u><?= $data->user->id ?></u>.</p>
			<p>Lookup other User IDs: <a href="http://jelled.com/instagram/lookup-user-id" target="_blank">http://jelled.com/instagram/lookup-user-id</a></p>
		</section>
		<section>
			<!-- WIDGET SETTINGS -->
			<input type="hidden" id="access-token" value="<?= $data->access_token ?>" />
			<label>1. Media Type</label>
			<select id="widget-select">
				<option value="widget-settings-user">User - Media related to a user</option>
				<option value="widget-settings-tag">Tag - Media related to a tag</option>
			</select>
			<div class="widget-settings" id="widget-settings-user">
				<label>2. User ID</label>
				<input type="text" id="widget-settings-user-id" value="<?= $data->user->id ?>" />
				<label>3. Parameters</label>
				<input type="text" id="widget-settings-user-parameter" value="count=8" />
				<p>Read more about user media feeds <a href="http://instagram.com/developer/endpoints/users/" target="_blank">here</a>.</p>
			</div>
			<div class="widget-settings" id="widget-settings-tag" style="display: none;">
				<label>2. Tag</label>
				<input type="text" id="widget-settings-tag-key" value="awkward" />
				<label>3. Parameters</label>
				<input type="text" id="widget-settings-tag-parameter" value="count=8" />
				<p>Read more about tag media feeds <a href="http://instagram.com/developer/endpoints/tags/" target="_blank">here</a>.</p>
			</div>
			<div class="_buttons">
				<span class="button" onclick="javascript:apwGenerateJSON();">Generate Widget</span>
			</div>
		</section>
		<div id="generated-widget">
			<section class="widget">
				<h3>Widget</h3>
				<ul class="apw-list"></ul>
			</section>
			<section>
				<h3>Embed Code</h3>
				<p>Copy the code below and paste it into your HTML application.</p>
				<p>You must use <a href="https://jquery.com/" target="_blank">jQuery</a> for this widget to work.</p>
				<code>
					<?php include( 'embed-code.php' ); ?>
				</code>
			</section>
			<section>
				<h3>JSON Link</h3>
				<p>Use this link if you want to access the pure JSON data.</p>
				<textarea id="widget-json-link" rows="4"></textarea>
			</section>
		</div>
		<?php endif; ?>
	</div>
</section>

<footer>
	<div class="container">

	</div>
</footer>

</body>
</html>