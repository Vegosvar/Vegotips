
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

function swapContent(meal,title) {
	$('#meal_count').html("#"+meal.id);
	$('#meal_link').attr('data-id', meal.id);
	$('#meal_name').html(meal.name);
	$('#meal_owner').html(meal.owner);
	$('#meal_ownerlink').attr('href', meal.ownerlink);
	$('#meal_link').attr('href', meal.link);
	$('#meal_link').attr('data-original-title', meal.clicks + " personer har läst receptet");
	$('.count').show();
	generateHearts(meal.percentage);
	
	document.title = title;
	
	return true;
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
				$('#thanksForErrors').addClass('show');
				setTimeout(function() {
					$('#thanksForErrors').removeClass('show');
				}, 8000);
			}
		});
	});

	// Keybord
	$(document).keydown(function(e) {
		var key = e.which;
		if($('.modal').css('opacity') == 0) {	// Prevents the user from loading a new meal while modal is visible, this prevents the style bug that occured.
			if(key == 13) {
				$('#supertips .tips').hide();
				$('#supertips .success').show();
				setTimeout(function() {
					$('#supertips .success').addClass('deactivate');
				}, 2500);
				getMeal();
			} else if(key == 76 || key == 83) {
				$('#meal_link').trigger('click');
			}
		}
	});
});


window.onpopstate = function(event) { // Enables going backwards in history.
	if (event.state != null) { // If previous page was NOT index, load the data stored by the user.
		toggleClass();
		setTimeout(function() {
			swapContent(event.state.meal,event.state.pageTitle);
			toggleClass();	
		}, 100);
	} else { // Last page was index, proceed with random meal.
		getMeal(first_meal);
	}
};


// Print HTML
var counts = 0;
function getMeal(id) {
    id = id || "";
	
	toggleClass();
	$.getJSON("/api/getmeal/"+id, function (data) {
		
		if(data.error) {
			
			if (data.error.code == 404) {
				swapContent({"id":"404",
				"owner":"servern",
				"ownerlink":"/",
				"link":"/",
				"clicks":"0",
				"percentage":"0",
				"name":"Maten kunde inte hittas"},"Vegotips - #404 Maten kunde inte hittas");
			}
			else {
				swapContent({"id":"-",
					"owner":"-",
					"ownerlink":"#",
					"link":"#",
					"clicks":"0",
					"percentage":"0",
					"name":data.error.code+" "+data.error.title},"Vegotips - "+data.error.code+" "+data.error.title);
			
			}
			
			toggleClass();
			return false;
			
		}
		else {
			var meal = data.data
			
			swapContent(data.data,"Vegotips - #"+meal.id+" "+meal.name);
			
	        window.history.pushState({"meal":meal,"pageTitle":document.title},document.title, "/"+meal.id);

			toggleClass();
			
			return true;
		}
	});
}

$('#meal_link, #meal_name').click(function () {
	var id = $('#meal_link').attr('data-id');
	$.get("/api/click/"+id, function (data) {});
});

// Actions
$('#nextMeal').click(function () {
	getMeal();
	return false;
});