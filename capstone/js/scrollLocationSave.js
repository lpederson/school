function saveScrollPositions(theForm) {
	if(theForm) {
		var scrolly = typeof window.pageYOffset != 'undefined' ? window.pageYOffset : document.documentElement.scrollTop;
		var scrollx = typeof window.pageXOffset != 'undefined' ? window.pageXOffset : document.documentElement.scrollLeft;
		theForm.scrollx.value = scrollx;
		theForm.scrolly.value = scrolly;
	}
}

