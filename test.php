<html>
	<head>
		<title>Tjena! Test haha</title>
	</head>

	<body>
		<input id="1" maxlength="1" class="pin" type="password" style="width:30px;height:35px;line-height:35px;font-size:16pt;text-align:center;" />
		<input id="2" maxlength="1" class="pin" type="password" style="width:30px;height:35px;line-height:35px;font-size:16pt;text-align:center;" />
		<input id="3" maxlength="1" class="pin" type="password" style="width:30px;height:35px;line-height:35px;font-size:16pt;text-align:center;" />
		<input id="4" maxlength="1" class="pin" type="password" style="width:30px;height:35px;line-height:35px;font-size:16pt;text-align:center;" />

		<div id="hello" style="display:none;"></div>
		<p style="margin-top:25px;">Era PIN's finns att hämta i databasen<br />love ur <i>andreas</i> :* <3<3<3<3<3 (winkyface)(kissyface)</p>

		<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			$('.pin').keyup(function(e) {
				var id = $(this).attr('id');
				if($(this).attr('id') == 1) {
					$('#2').focus();
				} else if($(this).attr('id') == 2) {
					$('#3').focus();
				} else if($(this).attr('id') == 3) {
					$('#4').focus();
				} else if($(this).attr('id') == 4) {
					var pincode = $('#1').val() + $('#2').val() + $('#3').val() + $('#4').val();
					$.get('/lek/'+pincode, function(data) {
						$('#4').blur();
						if(!data == "") {
							$('#hello').html('Välkommen '+data);
							$('#hello').slideDown('fast');
						} else {
							$('#hello').slideUp('fast');
						}
					});
				}
			});

			$('.pin').on('focus', function(e) {
				e.preventDefault();
				if($(this).attr('id') == 1) {
					$('.pin').val('');
				} else {
					$('this').val('');
				}
			});
		</script>	
	</body>
</html>