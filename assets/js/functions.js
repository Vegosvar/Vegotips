
// Laddar...
function toggleClass() {
	$('#nextMeal').toggleClass('loading');
	$('#tips').toggleClass('loading');
}


// Service info
function serviceBusy() {
	$('#hide').slideUp('fast');
	$('#serviceBusy').slideDown('fast');
}


// Hjärtan
function generateHearts(percent) {
	if(percent >= 20) {
		$('.popular').html('<span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span>');
	} else if(percent >= 15) {
		$('.popular').html('<span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart-empty"></span>');
	} else if(percent >= 10) {
		$('.popular').html('<span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart-empty"></span><span class="glyphicon glyphicon-heart-empty"></span>');
	} else if(percent >= 5) {
		$('.popular').html('<span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart-empty"></span><span class="glyphicon glyphicon-heart-empty"></span><span class="glyphicon glyphicon-heart-empty"></span>');
	} else {
		$('.popular').html('<span class="glyphicon glyphicon-heart"></span><span class="glyphicon glyphicon-heart-empty"></span><span class="glyphicon glyphicon-heart-empty"></span><span class="glyphicon glyphicon-heart-empty"></span><span class="glyphicon glyphicon-heart-empty"></span>');
	}
}

$(window).load(function() {
	getMeal();


	// Formulär
	$('#tip_form').submit(function(ev) {
		ev.preventDefault();
		$.post("/index.php/submit/tip", $( "#tip_form" ).serialize() )
		.done(function(data) {
			if(data == 1) {
				$('#thanksForTips').addClass('show');
				$('#tip_form').trigger("reset");
				setTimeout(function() {
					$('#thanksForTips').removeClass('show');
				}, 8000);
			} else {
				alert("Något vart fel. Kontrollera att samtliga fält är ifyllda");
			}
		});
	});


	// Tangentbordstryckningar
	$(document).keydown(function(e) {
		e.preventDefault();
		var key = e.which;
		if(key == 82 || key == 78 || key == 13) {
			getMeal();
		} else if(key == 32) {
			$('#supertips .tips').hide();
			$('#supertips .success').show();
			setTimeout(function() {
				$('#supertips .success').addClass('deactivate');
			}, 2500);
			getMeal();
		} else if(key == 76 || key == 83) {
			$('#meal_link').trigger('click');
		}
	});
});


// Printa ut data i HTML
var counts = 0;
function getMeal() {
	toggleClass();
	$.getJSON("/index.php/main/getmeal", function (data) {
		$('#meal_count').html("#"+data.meal_count);
		$('.actionTrigger').attr('data-id', data.meal_id);
		$('#meal_name').html(data.meal_name);
		$('#meal_owner').html(data.meal_owner);
		$('#meal_ownerlink').attr('href', data.meal_ownerlink);
		$('#meal_link').attr('href', data.meal_link);
		$('#meal_link').attr('data-original-title', data.meal_up + " personer har läst receptet");
		$('.count').show();
		generateHearts(data.meal_percentage);
		setTimeout(function() {
			toggleClass();
		}, 1);
		counts++;
	});
}


// "Se recept" & "Nästa"
$('.actionTrigger').click(function () {
	if($(this).attr('id') == "meal_link") {
		var id = $(this).attr('data-id');
		$.get("/index.php/main/add_up?id="+id, function (data) {
		});
	} else if($(this).attr('id') == "nextMeal") {
		var id = $(this).attr('data-id');
		getMeal();
		$.get("/index.php/main/add_view?id="+id, function (data) {
		});
	} else {
		alert('Något gick på tok');
	}
});