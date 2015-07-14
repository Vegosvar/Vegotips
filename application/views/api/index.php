<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="sv"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="sv"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="sv"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="sv"> <!--<![endif]-->
<head>
	<title>Vegotips – API</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all">
	<meta name="description" content="Hungrig? Fear no more! Här hittar du världens godaste maträtt som du kan laga, helt veganskt såklart!">
  	<meta name="keywords" content="Vego Tips Veganskt Vegetariskt" />

	<link rel="canonical" href="http://vegotips.se"/>
	<meta property='og:locale' content='sv_SE'/>
	<meta property='og:type' content='website'/>
	<meta property='og:title' content='Vegotips – API'/>
	<meta property='og:url' content='http://vegotips.se/'/>
	<meta property='og:site_name' content='Vegotips'/>
	<meta property='og:image' content='http://vegotips.se/assets/img/og.png'/>

	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="/assets/css/style.css">
	<script src="/assets/js/main.js"></script>

	<link rel="apple-touch-icon" sizes="57x57" href="/assets/img/favicon/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/assets/img/favicon/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/assets/img/favicon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/assets/img/favicon/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/assets/img/favicon/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/assets/img/favicon/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/assets/img/favicon/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/assets/img/favicon/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicon/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="/assets/img/favicon/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/assets/img/favicon/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="/assets/img/favicon/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="/assets/img/favicon/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/assets/img/favicon/manifest.json">
	<link rel="shortcut icon" href="/assets/img/favicon/favicon.ico">
	<meta name="apple-mobile-web-app-title" content="Vegotips">
	<meta name="application-name" content="Vegotips">
	<meta name="msapplication-TileColor" content="#1fccba">
	<meta name="msapplication-TileImage" content="/assets/img/favicon/mstile-144x144.png">
	<meta name="msapplication-config" content="/assets/img/favicon/browserconfig.xml">
	<meta name="theme-color" content="#1fccba">

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
							<h1>Vegotips API</h1>
							<p class="preamble">De APIer som används för att hämta och publicera information till och från Vegotips finns tillgängliga för allmänheten och finns dokumenterade på denna webbplats. Ingen API-nyckel krävs, men samtliga anrop loggas.</p>
							<p>Användande av Vegosvars API innebär samförstånd i att APIt inte får användas i brottsligt eller annat skadligt syfte. Vegosvar eller Vegotips tillhandahåller ingen support för APIt eller tar något ansvar för eventuella problem som uppstår på grund av fel i mjukvaran.</p>

							<blockquote>"With great food, comes great responsibility" - Vegotips</blockquote><br>

							<h2>Dokumentation</h2>
							<p>Samtliga anrop returnerar data i JSON. Nedan beskrivs varje metod, tillsammans med exempel på den data som kan returneras.<br></p>
							
							<hr>

							<h2>/api/getmeal/<strong>[id]</strong></h2>
							<p>Returnerar ett modererat recept. Är ett id definierat returneras receptet med samma id. Saknas id så returneras ett slumpat id.</p>
							
							<div class="well">
								<h3>Indata</h3>
								<table class="table">
									<tr>
										<td><strong>id</strong></td>
										<td>ID på maträtten. Heltal <strong>(valfri)</strong></td>
									</tr>
								</table>
							</div>

							<div class="well">
								<h3>Utdata</h3>
								<table class="table">
									<thead>
										<tr>
											<td>data</td>
											<td></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><strong>id</strong></td>
											<td>ID på receptet</td>
										</tr>
										<tr>
											<td><strong>name</strong></td>
											<td>Namn på receptet</td>
										</tr>
										<tr>
											<td><strong>clicks</strong></td>
											<td>Antal klick på "Visa recept"</td>
										</tr>
										<tr>
											<td><strong>views</strong></td>
											<td>Antal visningar</td>
										</tr>
										<tr>
											<td><strong>percentage</strong></td>
											<td>Antal klick på "Visa recept" delat med antal visningar (views)</td>
										</tr>
										<tr>
											<td><strong>link</strong></td>
											<td>URL till recept</td>
										</tr>
										<tr>
											<td><strong>owner</strong></td>
											<td>Ägaren till receptet</td>
										</tr>
										<tr>
											<td><strong>ownerlink</strong></td>
											<td>URL till ägaren</td>
										</tr>
									</tbody>
								</table>

								<table class="table">
									<thead>
										<tr>
											<td>meta</td>
											<td></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><strong>total</strong></td>
											<td>Antalet existerande maträtter</td>
										</tr>
									</tbody>
								</table>
							</div>
								
							<div class="well">
							<h3>Exempelanrop</h3>
								<div class="well">
									<p><strong>GET http://vegotips.se/api/getmeal/</strong></p>
									<code>{<br>
										&nbsp;&nbsp;&nbsp;&nbsp;"data":&nbsp;{<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"clicks":&nbsp;"2",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"id":&nbsp;"85",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"link":&nbsp;"http://veganen.blogspot.se/2013/09/vegansk-omelett.html",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"name":&nbsp;"Vegansk&nbsp;omelett",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"owner":&nbsp;"Veganen",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"ownerlink":&nbsp;"http://veganen.blogspot.se",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"percentage":&nbsp;20,<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"type":&nbsp;"meal",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"views":&nbsp;"10"<br>
										&nbsp;&nbsp;&nbsp;&nbsp;},<br>
										&nbsp;&nbsp;&nbsp;&nbsp;"meta":&nbsp;{<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"total":&nbsp;"98"<br>
										&nbsp;&nbsp;&nbsp;&nbsp;}<br>
										}
									</code></p>
								</div>
								<div class="well">
									<p><strong>GET http://vegotips.se/api/getmeal/32</strong></p>
									<code>{<br>
										&nbsp;&nbsp;&nbsp;&nbsp;"data": {<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"clicks": "2",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"id": "32",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"link": "http://veganmage.se/2009/06/28/freiluftkino-och-en-pizza-med-bolognese/",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"name": "Pizza med bolognese",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"owner": "Veganmage",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"ownerlink": "http://veganmage.se",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"percentage": 50,<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"type": "meal",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"views": "4"<br>
										&nbsp;&nbsp;&nbsp;&nbsp;},<br>
										&nbsp;&nbsp;&nbsp;&nbsp;"meta": {<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"total": "98"<br>
										&nbsp;&nbsp;&nbsp;&nbsp;}<br>
										}
									</code>
								</div>
							</div>

							<hr>
							
							<h2>/api/click/<strong>id</strong></h2>
							<p>Registrerar ett klick på ett recept.</p>
							
							<div class="well">
								<h3>Indata</h3>
								<table class="table">
									<tr>
										<td><strong>id</strong></td>
										<td>ID på maträtten. Heltal <strong>(obligatorisk)</strong></td>
									</tr>
								</table>
							</div>
											
							<div class="well">			
								<h3>Utdata</h3>
								<table class="table">
									<thead>
										<tr>
											<td>error</td>
											<td></td>
										</tr>
									</thead>
									<tr>
										<td><strong>code</strong></td>
										<td>Felkod</td>
									</tr>
									<tr>
										<td><strong>title</strong></td>
										<td>Felbeskrivning</td>
									</tr>
								</table>
							</div>
							
							<div class="well">
								<h3>Exempelanrop</h3>
								<div class="well">
									<p><strong>GET http://vegotips.se/api/click/3</strong></p>
									<code>{<br>
										&nbsp;&nbsp;&nbsp;&nbsp;"error": {<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"code": 200,<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"title": "OK"<br>
										&nbsp;&nbsp;&nbsp;&nbsp;}<br>
										}<br>
									</code>
								</div>
								
							</div>

							<hr>
							
							<h2>/api/getcategories/</h2>
							<p>Listar alla kategorier.</p>
							
							<div class="well">
								<h3>Indata</h3>
								<table class="table">
									<tr>
										<td>Metoden saknar indata</td>
									</tr>
								</table>
							</div>
											
							<div class="well">			
								<h3>Utdata</h3>
								<table class="table">
									<thead>
										<tr>
											<td>data</td>
											<td></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><strong>id</strong></td>
											<td>ID på kategorin</td>
										</tr>
										<tr>
											<td><strong>name</strong></td>
											<td>Namn på kategorin</td>
										</tr>
									</tbody>
								</table>

								<table class="table">
									<thead>
										<tr>
											<td>meta</td>
											<td></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><strong>total</strong></td>
											<td>Antalet existerande kategorier</td>
										</tr>
									</tbody>
								</table>
							</div>
							
							<div class="well">
								<h3>Exempelanrop</h3>
								<div class="well">
									<p><strong>GET http://vegotips.se/api/getcategories</strong></p>
									<code>{<br>
										&nbsp;&nbsp;&nbsp;&nbsp;"data": [<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"id": "1",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"name": "Lagat",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"type": "category"<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"id": "2",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"name": "Bakat",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"type": "category"<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"id": "3",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"name": "Grillat",<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"type": "category"<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
										&nbsp;&nbsp;&nbsp;&nbsp;],<br>
										&nbsp;&nbsp;&nbsp;&nbsp;"meta": {<br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"total": "3"<br>
										&nbsp;&nbsp;&nbsp;&nbsp;}<br>
										}<br>
									</code>
								</div>
							</div>

							<hr>
							
							<h2>/api/submit/</h2>
							<p>Tipsa om en maträtt.</p>
							
							<div class="well">
								<h3>Indata</h3>
								<table class="table">
									<tr>
										<td><strong>name</strong></td>
										<td>Namn på maträtten <strong>(obligatorisk)</strong></td>
									</tr>
									<tr>
										<td><strong>link</strong></td>
										<td>Länk till receptet <strong>(obligatorisk)</strong></td>
									</tr>
									<tr>
										<td><strong>category</strong></td>
										<td>ID på kategorin som maträtten ska ligga i. Heltal <strong>(obligatorisk)</strong></td>
									</tr>
								</table>
							</div>
											
							<div class="well">			
								<h3>Utdata</h3>
								<table class="table">
									<thead>
										<tr>
											<td>error</td>
											<td></td>
										</tr>
									</thead>
									<tr>
										<td><strong>code</strong></td>
										<td>Statuskod</td>
									</tr>
									<tr>
										<td><strong>title</strong></td>
										<td>Beskrivning</td>
									</tr>
								</table>
							</div>
							
							<div class="well">
								<h3>Exempelanrop</h3>
								<div class="well">
									<p><strong>POST http://vegotips.se/api/submit</strong> name: <em>"namn"</em>, link: <em>"http://vegosvar.se"</em>, category: <em>1</em></p>
									<code>{<br>
											&nbsp;&nbsp;&nbsp;&nbsp;"error": {<br>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"code": 200,<br>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"title": "OK"<br>
											&nbsp;&nbsp;&nbsp;&nbsp;}<br>
											}<br>
									</code>
								</div>
								
								<div class="well">
									<p><strong>POST http://vegotips.se/api/submit</strong> name: <em>""</em>, link: <em>"http://vegosvar.se"</em>, category: <em>"Mat"</em></p>
									<code>{<br>
											&nbsp;&nbsp;&nbsp;&nbsp;"error": {<br>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"code": 406,<br>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"title": "Not Acceptable"<br>
											&nbsp;&nbsp;&nbsp;&nbsp;}<br>
											}<br>
									</code>
								</div>
							</div>
							
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
					<a href="http://facebook.com/vegotips" class="btn btn-secondary" target="_blank">
						<span class="glyphicon glyphicon-thumbs-up"></span> Fler tips på Facebook
					</a>
					<a href="/lista" class="btn btn-secondary">
						<span class="glyphicon glyphicon-cutlery"></span> Komplett lista
					</a>
				</div>

				<a href="/api">Vegotips API</a> | Utvecklat av <a href="https://vegosvar.se" target="_blank">Vegosvar</a>

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
				<div id="thanksForErrors">Korvkatastrof! Något gick fel, kanske tänkte du på mat?</div>
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