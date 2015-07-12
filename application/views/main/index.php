<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="sv"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="sv"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="sv"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="sv"> <!--<![endif]-->
<head>
	<title>Vegotips – Vad ska jag laga för vegokäk?</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all">
	<meta name="description" content="Hungrig? Fear no more! Här hittar du världens godaste maträtt som du kan laga, helt veganskt såklart!">
  	<meta name="keywords" content="Vego Tips Veganskt Vegetariskt" />

	<link rel="canonical" href="http://vegotips.se"/>
	<meta property='og:locale' content='sv_SE'/>
	<meta property='og:type' content='website'/>
	<meta property='og:title' content='Vegotips – Vad ska jag laga för vegokäk?'/>
	<meta property='og:url' content='http://vegotips.se/'/>
	<meta property='og:site_name' content='Vegotips'/>
	<meta property='og:image' content='http://vegotips.se/assets/img/og.png'/>

	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="shortcut icon" href="/assets/img/favicon.ico">

	<link rel="stylesheet" href="/assets/css/style.css">
	<script src="/assets/js/main.js"></script>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-55653281-4', 'auto');
	  ga('send', 'pageview');
	  
	  var first_meal = <? echo $meal['meals_id']; ?>;
	</script>

</head>

<body>
	<div class="page-wrapper">
		<content>
			<div class="text-center">
				<a href="/"><img src="/assets/img/vegotips.svg" alt="Vegotips" class="logo"></a>
			</div>
			<article>
				<div class="container">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2 text-center">
							<div id="serviceBusy" style="display:none;">Många som besöker hemsidan just nu, testa att komma tillbaka strax!</div>
							
							<div id="hide">
								
								<div id="tips">
									<div class="count">
										<h1>Vegotips</h1>
										<strong><a href="/<? echo $meal['meals_id']; ?>" id="meal_count">#<? echo $meal['meals_id']; ?></a></strong> 
										från 
										<a id="meal_ownerlink" href="<? echo $meal['meals_ownerlink']; ?>" target="_blank">
											<strong id="meal_owner"><? echo $meal['meals_owner']; ?></strong>
										</a>
									</div>
									<span class="name"><a href="<? echo $meal['meals_link']; ?>"  id="meal_name" target="_blank"><? echo $meal['meals_name']; ?></a></span>
									<div class="popular">
										<?
											
										if($meal['percentage'] >= 20) {
											echo '<span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span>';
										} else if($meal['percentage'] >= 15) {
											echo '<span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart-empty"></span>';
										} else if($meal['percentage'] >= 10) {
											echo '<span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart-empty"></span><span class="glyphicon glyphicon-heart-empty"></span>';
										} else if($meal['percentage'] >= 5) {
											echo '<span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart-empty"></span><span class="glyphicon glyphicon-heart-empty"></span><span class="glyphicon glyphicon-heart-empty"></span>';
										} else {
											echo '<span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart-empty"></span><span class="glyphicon glyphicon-heart-empty"></span><span class="glyphicon glyphicon-heart-empty"></span><span class="glyphicon glyphicon-heart-empty"></span>';
										}
											
										?>
									</div>
								</div>

							</div>
							<div class="row actions">
								<div class="col-xs-6 col-sm-4 col-sm-offset-2">
									<a href="<? echo $meal['meals_link']; ?>" id="meal_link" class="btn btn-primary actionTrigger" data-id="" target="_blank" data-toggle="tooltip" data-placement="bottom" data-original-title="<? echo $meal['meals_up']; ?> personer har läst receptet">
										<span class="glyphicon glyphicon-heart"></span> Se recept
									</a>
								</div>
								<div class="col-xs-6 col-sm-4">
									<a href="/" id="nextMeal" data-id="" class="btn btn-secondary actionTrigger">
										<span class="glyphicon glyphicon-repeat"></span> Nästa
									</a>
								</div>
							</div>

						</div>
					</div>
				</div>
			</article>
		</content>
		<footer class="text-center">
			<div class="container">

				<div id="supertips">
					<div class="tips">
						<span class="glyphicon glyphicon-sunglasses"></span>
						<strong>Supertips</strong> Tryck Enter för att hämta nästa tips
					</div>
					<div class="success">
						<span class="glyphicon glyphicon-flash"></span>
						<strong>Vego powers activated!</strong>
					</div>
				</div>
				
				<div id="links">
					<a href="#tips" class="btn btn-secondary trigger">
						<span class="glyphicon glyphicon-comment"></span> Posta ett eget tips
					</a> 
					<a href="http://facebook.com/vegotips" class="btn btn-secondary">
						<span class="glyphicon glyphicon-thumbs-up"></span> Fler tips på Facebook
					</a>
					<a href="/all" class="btn btn-secondary">
						<span class="glyphicon glyphicon-cutlery"></span> Komplett lista
					</a>
				</div>

				<a href="/api">API</a> | Utvecklat av <a href="https://vegosvar.se" target="_blank">Vegosvar</a>

			</div>
		</footer>
	</div>
	<div class="modal-wrapper">
		<div class="bg-close trigger"></div>
		<div class="modal">
			<div class="head">
				<h2 class="title">Posta ett vegotips!</h2>
				<a class="btn-close trigger" href="javascript:;"></a>
			</div>
			<div class="content">
				<div id="thanksForTips">Tack för ditt tips!</div>
				<form action="post" id="tip_form">
				<div class="input-group">
  					<span class="input-group-addon" id="sizing-addon1">Vegokäk</span>
					<input type="field" id="tips" name="name" class="form-control">
				</div>
				
				<div class="input-group">
  					<span class="input-group-addon" id="sizing-addon1">Recept</span>
					<input type="field" id="link" name="link" class="form-control" placeholder="http://">
				</div>

				<h3>Välj kategori</h3>
				<div class="input-group" data-toggle="buttons">
					<?php 
					foreach($categories as $category) { ?>
					<label class="btn btn-checkbox">
						<input type="radio" autocomplete="off" name="category" value="<?php echo $category->categories_id; ?>" <?php if($category->categories_id == '1') { echo "checked"; } ?>> <?php echo $category->categories_name; ?>
					</label>
					<?php } ?>
				</div>

				<input type="submit" value="Posta" class="btn btn-primary btn-lg"> 
				</form>
			</div>
		</div>
	</div>
	<script src="/assets/js/functions.js" type="text/javascript"></script>
</body>
</html>