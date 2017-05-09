var globals = {
	toggleMenu: null,
	menuOffsetTop: null
};

function checkEnableMassButtons() {
	var selected = [];
	$('input:checked').each(function() {
		selected.push($(this).attr('value'))
	});
	if(selected.length == 0) {	//NOTE all "mass" buttons should have the class "massButton", so they can be en/disabled
		//TODO disable button
		$('.massButton').prop('disabled',true);
	}else{
		//TODO enable button
		$('.massButton').prop('disabled',false);
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

function checkFileUploadLabel() {
	var fileName = $('input[type=file]').val().replace('C:\\fakepath\\','');
	var message = "Please wait...";
	if(fileName !== '') {
		message = "Selected file: " + fileName;
	}else{
		message = "Please select a file...";
	}
	$('.fileName').html(message);
	/**/
}

function init() {
	checkEnableMassButtons();
	globals.toggleMenu = createToggle();
}

//NOTE crUd UPDATE
function updateFile(e) {
	e.preventDefault();
	var li = this.closest('li').closest('ul').closest('li');
	var file = $(li).attr('id');
	var newName = prompt('Please enter a new name:');
	if(newName === null || newName === "") {
		//TODO What happens when the user cancels it?	NOTE what sould i do here?
	}else{
		$.ajax({
			url: "file.php?file=" + file + "&name=" + newName,
			method: "UPDATE"
		}).done(function (data) {
			try {
				data = JSON.parse(data);
				if (data.success) {
					$(li).find('h1').text(newName);			//NOTE Change the display name
					$(li).attr('id', newName);				// TODO change ID
					// window.location.replace('home.php');	//TODO get rid of this
				}
			}catch(e) {
			}
		})
	}
	/**/
}


function getSelectedItemsAsGetString() {
	var checked = $(':checked');
	var getParameter = "?";
	//For-in loop isn't working
	for(var i = 0; i < checked.length; i++) {
		var itemToDelete = $(checked[i].closest('li')).attr('id');
		itemToDelete = itemToDelete.replace(' ', '%20');
		if(getParameter !== "?") {
			getParameter += "&"
		}
		getParameter += "file[]=" + itemToDelete;
	}
	return getParameter;
}


//NOTE cRud MASS READ
function massDownloadFiles(e) {		//NOTE this will be implemented by making a read call passing an array, and should return a zip file.
	e.preventDefault();
	var getParameter = getSelectedItemsAsGetString();
	// console.log("http://localhost:8181/file.php" + getParameter);
	$.ajax({
		url: "file.php" + getParameter,
		method: "GET"
	}).done(function(data) {
		try{
			window.location = 'file.php?file=' + data;
			//TODO once this fetches, delete zip folder afterwards.
		}catch(e) {
		}
	});
}

//NOTE cruD DELETE
function deleteFile(e) {	//NOTE This function sends a delete request to the PHP code, and if it succeeds, it removes the list item from the DOM structure
	e.preventDefault();
	var li = this.closest('li').closest('ul').closest('li');
	var file = $(li).attr('id');
	$.ajax({
		url: "file.php?file=" + file,
		method: "DELETE"
	}).done(function (data) {
		try {
			data = JSON.parse(data);
			if(data.success) {
				$(li).remove();
			}
		}catch(e) {
			console.log(data);
		}
	})
}


//NOTE cruD MASS DELETE
function massDeleteFiles(e) {
	e.preventDefault();
	var getParameter = getSelectedItemsAsGetString();
	console.log(getParameter);
	$.ajax({
		url: "file.php" + getParameter,
		method: "DELETE"
	}).done(function (data) {
		try {
			data = JSON.parse(data);
			for(var item in data.success) {
				document.getElementById(item).remove();
			}
		}catch(e) {
			console.log(data);
		}
	})
}



$(document).ready(function () {
	init();
	$('.selector').on('change',checkEnableMassButtons);
	$('#menuDropper').on('click',toggleMenuDrop);
	//$(window).on('scroll',positionMenuDrop);
	$('.deleteButton').on('click',deleteFile);
	$('.renameButton').on('click',updateFile);
	$('input[type=file]').on('change',checkFileUploadLabel);
	$('#massDelete').on('click',massDeleteFiles);
	$('#massDownload').on('click',massDownloadFiles);
});