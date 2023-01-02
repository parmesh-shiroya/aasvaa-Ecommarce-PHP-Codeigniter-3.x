$(document).ready(function() {

$(".minimize-card").on('click', '.minimize-btn', function(event) {
	event.preventDefault();
	$(this).parents('.minimize-card').children('.minimize-container').addClass('close',400);
	$(this).children('.material-icons').text('add');
	$(this).addClass('maximize-btn');
	$(this).removeClass('minimize-btn');
});

$(".minimize-card").on('click', '.maximize-btn', function(event) {
	event.preventDefault();
	$(this).parents('.minimize-card').children('.minimize-container').removeClass('close',400);
	$(this).children('.material-icons').text('remove');
	$(this).addClass('minimize-btn');
	$(this).removeClass('maximize-btn');
});
	
	$('.select_date_start').pickadate({
selectMonths: true, // Creates a dropdown to control month
format: 'dd-mm-yyyy',
max: new Date(),
closeOnSelect: true,
selectYears: 15 // Creates a dropdown of 15 years to control year
});
$('.select_date_end').pickadate({
selectMonths: true, // Creates a dropdown to control month
format: 'dd-mm-yyyy',
closeOnSelect: true,
max: new Date(),
selectYears: 15 // Creates a dropdown of 15 years to control year
});
});