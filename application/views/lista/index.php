<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="sv"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="sv"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="sv"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="sv"> <!--<![endif]-->
<head>
	<title>Vegotips – Komplett lista på vegansk mat</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all">
	<meta name="description" content="Hungrig? Fear no more! Här hittar du världens godaste maträtt som du kan laga, helt veganskt såklart!">
  	<meta name="keywords" content="Vego Tips Veganskt Vegetariskt" />

	<link rel="canonical" href="http://vegotips.se"/>
	<meta property='og:locale' content='sv_SE'/>
	<meta property='og:type' content='website'/>
	<meta property='og:title' content='Vegotips – Komplett lista på vegansk mat'/>
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
	</script>

</head>

<body>
	<div class="page-wrapper">
		<content>
			<div class="text-center">
				<a href="/"><img src="/assets/img/vegotips-xs.svg" alt="Vegotips" class="logo xs"></a>
			</div>
			<article>
				<div class="container">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">							
							<h1>Komplett lista på vegansk mat</h1>
							<p class="preamble">Hämtat från några av Sveriges alla matbloggar</p>
							<p>Vi kan även <strong><a href="/">slumpa fram</a></strong> en maträtt om du önskar det, perfekt när du inte kan bestämma dig.
							Om du vill bidra med egna maträtter får du gärna <strong><a href="#tips" class="trigger">posta ett eget tips</a></strong>.</p><br>
							
							<h3>Veganska maträtter</h3>
							<table class="table table-striped">
								<tr>
									<td><strong>ID</strong></td>
									<td><strong>Maträtt</strong></td>
									<td><strong>Hemsida</strong></td>
								</tr>
								<?php
								foreach ($meals as $meal) {
									?>
									<tr>
										<td><?php echo $meal['meals_id'] ?></td>
										<td><a href="<?php echo $meal['meals_link'] ?>" target="_blank"><?php echo $meal['meals_name'] ?></a></td>
										<td><a href="<?php echo $meal['meals_ownerlink'] ?>" target="_blank"><?php echo $meal['meals_owner'] ?></a></td>
									</tr>
									<?
								}
									
								?>
							</table>
						</div>
					</div>
				</div>
			</article>
		</content>
		<footer class="text-center">
			<div class="container">
				
				<div id="links">
					<a href="#tips" class="btn btn-secondary trigger">
						<span class="glyphicon glyphicon-comment"></span> Posta ett eget tips
					</a> 
					<a href="http://facebook.com/vegotips" class="btn btn-secondary">
						<span class="glyphicon glyphicon-thumbs-up"></span> Fler tips på Facebook
					</a>
					<a href="/lista" class="btn btn-secondary">
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
				<div id="thanksForErrors">Korvatastrov! Något gick fel, kanske tänkte du på mat?</div>
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