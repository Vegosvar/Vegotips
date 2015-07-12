
// Loading...
function toggleClass() {
	$('#nextMeal').toggleClass('loading');
	$('#tips').toggleClass('loading');
}


// Service info
function serviceBusy() {
	$('#hide').slideUp('fast');
	$('#serviceBusy').slideDown('fast');
}


// Hearts
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

	// Form
	$('#tip_form').submit(function(ev) {
		ev.preventDefault();
		$.post("/api/submit", $( "#tip_form" ).serialize() )
		.done(function(data) {
			data = jQuery.parseJSON(data);
			if(data.error.code == 200) {
				$('#thanksForTips').addClass('show');
				$('#tip_form').trigger("reset");
				setTimeout(function() {
					$('#thanksForTips').removeClass('show');
				}, 8000);
			} else {
				alert("Något vart fel. Kontrollera att samtliga fält är ifyllda.");
			}
		});
	});

	// Keybord
	$(document).keydown(function(e) {
		var key = e.which;
		if(key == 82 || key == 78) {
			getMeal();
		} else if(key == 13) {
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


window.onpopstate = function(event) { // Enables going backwards in history. 
	
	if (event.state != null) { // If previous page was NOT index, load the data stored by the user.
		toggleClass();
		setTimeout(function() {
		    document.title = event.state.pageTitle;
	
			var meal = event.state.meal;
	
			$('#meal_count').html("#"+meal.id);
			$('.actionTrigger').attr('data-id', meal.id);
			$('#meal_name').html(meal.name);
			$('#meal_owner').html(meal.owner);
			$('#meal_ownerlink').attr('href', meal.ownerlink);
			$('#meal_link').attr('href', meal.link);
			$('#meal_link').attr('data-original-title', meal.clicks + " personer har läst receptet");
			$('.count').show();
			generateHearts(meal.percentage);
			toggleClass();	
		}, 100);
	} else { // Last page was index, proceed with random meal.
		getMeal();
	}
};


// Print HTML
var counts = 0;
function getMeal() {
	toggleClass();
	$.getJSON("/api/getmeal/", function (data) {
		
		if(data.error) {
			
			$('#meal_count').html("-");
			$('.actionTrigger').attr('data-id', 0);
			$('#meal_owner').html("-");
			$('#meal_ownerlink').attr('href', "#");
			$('#meal_link').attr('href', "#");
			$('#meal_link').attr('data-original-title', "0 personer har läst receptet");
			
			generateHearts(0);
			
			$('#meal_name').html(data.error.code+" "+data.error.title);
			toggleClass();
			return false;
			
		}
		else {
			var meal = data.data
			
			$('#meal_count').html("#"+meal.id);
			$('.actionTrigger').attr('data-id', meal.id);
			$('#meal_name').html(meal.name);
			$('#meal_owner').html(meal.owner);
			$('#meal_ownerlink').attr('href', meal.ownerlink);
			$('#meal_link').attr('href', meal.link);
			$('#meal_link').attr('data-original-title', meal.clicks + " personer har läst receptet");
			$('.count').show();
			generateHearts(meal.percentage);

	        document.title = "Vegotips - #"+meal.id+" "+meal.name;
	        window.history.pushState({"meal":meal,"pageTitle":document.title},document.title, "/"+meal.id);

			toggleClass();
			
			return true;
		}
	});
}


// Actions
$('.actionTrigger').click(function () {
	if($(this).attr('id') == "meal_link") {
		var id = $(this).attr('data-id');
		$.get("/api/click/"+id, function (data) {
		});
	} else if($(this).attr('id') == "nextMeal") {
		var id = $(this).attr('data-id');
		getMeal();
		return false;
	} else {
		// fail silently
		return false;
	}
});