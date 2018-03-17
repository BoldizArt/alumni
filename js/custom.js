$(document).ready(function(){
// "message_div" nestane u roku od 5s.
	$('.message_div').delay(5000).slideUp();
// Obavesti korisnika kad pokušava da skine sliku da za to nema dozvolu.
	$('.zabranjen_pristup').bind('contextmenu',{poruka: 'Nemate dozvolu da skinete ovu sliku!'},function(e){
		alert(e.data.poruka);
		return false;
	});
//Skrolluje gore celu stranicu na klik.
	$('.foo_btn').click(function(){
		$('html, body').animate({scrollTop : 0},750);
		return false;
	});

	$('.zabranjen_pristup').width(function(){
		var vi = $(this).width();
		$(this).height(vi);
		console.log(vi);
	});


});