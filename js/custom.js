$(".owl-carousel").owlCarousel({
	loop: true,
	margin: 10,
	nav: false,
	dots: true,
	responsive: {
		0: {
			items: 1,
		},
		600: {
			items: 1,
		},
		1000: {
			items: 1,
		},
	},
});

jQuery(document).ready(function () {
	
	var wordStates = document.querySelectorAll(".list-of-states li");
	var svgStates = document.querySelectorAll("#states > *");
	function removeAllOn() {
		wordStates.forEach(function (el) {
			el.classList.remove("on");
		});
		svgStates.forEach(function (el) {
			el.classList.remove("on");
		});
	}
	function addOnFromList(el) {
		var stateCode = el.getAttribute("data-state");
		var svgState = document.querySelector("#" + stateCode);
		el.classList.add("on");
		svgState.classList.add("on");
	}
	function addOnFromState(el) {
		var title = '';
		var stateId = el.getAttribute("id");
		var wordState = document.querySelector("[data-state='" + stateId + "']");
		if( $( wordState ).length ){
			wordState.classList.add("on");
			//<li data-state="AL" class="">Alabama</li>
			var title = $('li[data-state=' + stateId + ']').text();
			//console.log( title  );
		}else{
			title = stateId;
		}
		el.classList.add("on");
		$(el).parent("#states").parent(".svg-states").children("title").html( title );
	}

	wordStates.forEach(function (el) {
		el.addEventListener("mouseenter", function () {
			addOnFromList(el);
		});
		el.addEventListener("mouseleave", function () {
			removeAllOn();
		});
		el.addEventListener("touchstart", function () {
			removeAllOn();
			addOnFromList(el);
		});
	});
	svgStates.forEach(function (el) {
		el.addEventListener("mouseenter", function () {
		  addOnFromState(el);
		});
		el.addEventListener("mouseleave", function () {
		  removeAllOn();
		});
		el.addEventListener("touchstart", function () {
		  removeAllOn();
		  addOnFromState(el);
		});
	});
	
	jQuery("button.navbar-toggler").on("click", function (e) {
		jQuery("div#navbarSupportedContent").toggle();
	});
});