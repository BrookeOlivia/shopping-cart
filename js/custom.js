function rate(average){
	console.log(average);
	document.getElementById('ratings').innerHTML += "Average Rating: 	";
	for (var i = 0; i < average; i++) {
		document.getElementById('ratings').innerHTML += "<span class='glyphicon glyphicon-star'></span>";
	}
}
function goback(){
	window.history.back();
}

$(document).ready(function(){
	var star =  $('.star-review').length;
	var total = 0;
	$('.star-review').each(function(){
		total += $(this).data('rating');
		average = total/star;
		average = Math.round(average);
	})
	if (average > 0) {
		rate(average);	
	}
	
});