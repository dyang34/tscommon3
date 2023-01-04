

w3.includeHTML();

$(document).on('click','header .mobile-btn',function (){
	if($('header').hasClass('nav-open')){

		$('header').removeClass('nav-open');

	}else{

		$('header').addClass('nav-open');

	}
});