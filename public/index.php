<?php include( 'functions.php' ); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
	<title>Awkward Photo Widget for Instagram</title>
	<!-- Open Graph (Facebook) -->
	<!-- https://developers.facebook.com/docs/opengraph/howtos/maximizing-distribution-media-content -->
	<meta property="og:title" content="Awkward Photo Widget for Instagram" />
	<meta property="og:site_name" content="Awkward Group" />
	<meta property="og:url" content="<?= $redirect_uri ?>" />
	<meta property="og:description" content="A free service that makes it easy for developers and designers to display  Instagram photos in any type of web application." />
	<meta property="og:image" content="<?= $redirect_uri ?>images/share-facebook.png" />
	<meta property="og:type" content="website" />
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
		<p class="small"><?= $version ?> - Last updated <?= $updated ?></p>
		<p class="intro">A free service that makes it easy for developers and designers to display  Instagram photos in any type of web application.</p>
	</div>
</header>

<section id="main">
	<div class="container">
		<!-- STEP 0 (START) -->
		<?php if ( $step == 0 ) : ?>
		<p>The service delivers a <u>Widget</u> that can be embeded in your application as HTML and JavaScript. You can also use the <u>JSON link</u> instead of the widget. This is usefull if you want full control of the front-end structure.</p>
		<h3>Example Widget</h3>
		<ul class="apw-list example"></ul>
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
			<div class="client-settings" id="client-settings-default">
				<input type="hidden" id="client-settings-default-id" value="<?= $client_id; ?>" />
				<input type="hidden" id="client-settings-default-secret" value="<?= $client_secret; ?>" />
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
				<p>You must use <a href="https://jquery.com/" target="_blank">jQuery</a> for this widget to work.</p>
				<p>Copy the code below and paste it into your HTML application.</p>
				<code class="embed">
					<?php include( 'embed-code.php' ); ?>
				</code>
				<label>Example CSS</label>
				<code>
					<?php include( 'embed-css.php' ); ?>
				</code>
			</section>
			<section>
				<h3>JSON Link</h3>
				<p>Use this link if you want to access the JSON data directly.</p>
				<textarea id="widget-json-link" rows="4"></textarea>
			</section>
		</div>
		<?php endif; ?>
	</div>
</section>

<footer>
	<div class="container">
		Developed by <a href="http://www.awkwardgroup.com" target="_blank">Awkward Group</a>. Feel free to follow us on <a href="http://www.facebook.com/awkwardgroup" target="_blank">Facebook</a> or <a href="http://www.twitter.com/awkwardgroup" target="_blank">Twitter</a> :)
	</div>
</footer>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-52095806-1', 'awkwardgroup.com');
ga('send', 'pageview');
</script>

</body>
</html>