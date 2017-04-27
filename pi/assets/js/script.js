var globals = {
	debug: false,
	toggleMenu: null,
	menuOffsetTop: null
};

function checkEnableMassButtons() {
	var selected = [];
	$('input:checked').each(function() {
		selected.push($(this).attr('value'))
	});
	if(selected.length == 0) {
		//TODO disable button
		$('#massDelete').prop('disabled',true);
		//NOTE more buttons?
	}else{
		//TODO enable button
		$('#massDelete').prop('disabled',false);
		//NOTE more buttons?
	}
}

function createToggle() {
	var enabled = true;
	function toggle() {
		if(enabled) {
			enabled = false;
		}else{
			enabled = true;
		}
		return enabled;
	}
	return toggle;
}

function toggleMenuDrop(e) {
	e.preventDefault();
	var showMenu = globals.toggleMenu();
	if(showMenu) {
		$('#menu').css("display","block");
		$('#menuDropper').removeClass("fa-rotate-180");
	}else{
		$('#menu').css("display","none");
		$('#menuDropper').addClass("fa-rotate-180");
	}
}
/*
function positionMenuDrop() {
	var menu = $('#navigation');
	if($(window).scrollTop() > globals.menuOffsetTop){
		menu.addClass('fixed');
	}else{
		menu.removeClass('fixed');
	}
}
*/
function showScreenSize() {
	window.alert("Screen size is " + $(window).width() + " X " + $(window).height());
}

function init() {
	checkEnableMassButtons();

	if(globals.debug) {
		showScreenSize();
	}

	globals.toggleMenu = createToggle();

	//globals.menuOffsetTop = $('#navigation').offset().top;
}



$(document).ready(function () {
	init();
	$('.selector').on('change',checkEnableMassButtons);
	$('#menuDropper').on('click',toggleMenuDrop);
	//$(window).on('scroll',positionMenuDrop);
});