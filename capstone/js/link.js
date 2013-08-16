
var linkItems = new Array();

function linkInit()
{
	var elements = linkGetTopLevelLists();
	for (var i = 0; (i < elements.length); i++) {
		linkInitLink(elements[i]);
	}		
}

function linkInitLink(link)
{
	var kids = link.childNodes;
	for (var i = 0; (i < kids.length); i++) {
		var kid = kids[i];
		if (kid.nodeName == "LI") {
			linkInitItem(kid);
		}
	}
}

function linkInitItem(item)
{
	var kids = item.childNodes;
	var hasKids = false;
	var links = new Array();
	for (var i = 0; (i < kids.length); i++) {
		var kid = kids[i];	
		if (kid.nodeName == "UL") {
			kid.style.display = "none";
			linkInitLink(kid);
			hasKids = true;
			links[links.length] = kid;
		}
	}
	if (hasKids) {
		item.style.cursor = "pointer";
		var len = linkItems.length;
		linkItems[len] = item;
		// We can't just modify item.innerHTML, because that would
		// invalidate JavaScript objects that already refer to
		// other elements in the outlineItems array. So we use
		// the clunky DOM way of creating a span element. Then we
		// tuck the "a" element inside it so we can use
		// innerHTML for that and avoid various IE bugs.
		var span = document.createElement("span");
		span.innerHTML = "<a href='#' " +
			"onClick='linkItemClickByOffset(" + len + 
			"); return false' " +
			"class='olink'>" +
			"<img class='oimg' alt='Open' src='images/oopen.png'></a>";
		item.insertBefore(span, kids[0]);
		item.onclick = linkItemClick;
	}
}

function linkGetTarget(evt)
{
	var target;
        if (!evt) {
                // Old IE
                evt = window.event;
        }
	// Prevent double event firing (sigh)
	evt.cancelBubble = true;
	if (evt.stopPropagation) {
		evt.stopPropagation();
	}
        var target = evt.target;
        if (!target) {
                // Old IE
                target = evt.srcElement;
        }
	return target;
}

function linkItemClickByOffset(id)
{
	linkItemClickBody(linkItems[id]);
}

function linkItemClick(evt)
{
	target = linkGetTarget(evt);
	linkItemClickBody(target);
}

function linkItemClickBody(target)
{
	var closed = true;
	var kids = target.childNodes;
	var hasKids = false;
	for (var i = 0; (i < kids.length); i++) {
		var kid = kids[i];	
		if (kid.nodeName == "UL") {
			if (kid.style.display == "none") {
				kid.style.display = "block";
			} else {	
				kid.style.display = "none";
				closed = false;
			}
			hasKids = true;
		}
	}
	if (!hasKids) {
		// We're here because of a click on a
		// childless node. Ignore that.
		return;
	}	
	var img = linkGetImg(target);
	if (closed) {
		// We've just opened it, show close button
		img.src = "images/oclose.png";
		img.alt = "Close";
	} else {
		img.src = "images/oopen.png";
		img.alt = "Open";
	}
}
	
function linkGetImg(target)
{
	return linkGetDescendantWithClassName(target, "oimg");
}

function linkGetDescendantWithClassName(parent, cn)
{
	// Regular expression: beginning with class name, or
	// class name preceded by a space; and ending with class name, or
	// class name followed by a space. Covers the ways a single class
	// name can appear with or without others in the className attribute.
	var elements = parent.childNodes;
	var length = elements.length;
	var i;
	var regexp = new RegExp("(^| )" + cn + "( |$)");
	for (i = 0; (i < length); i++) {
		if (regexp.test(elements[i].className)) {
			return elements[i];
		}
		var result = linkGetDescendantWithClassName(
			elements[i], cn);	
		if (result) {
			return result;
		}
	}
	return null;
}

function linkGetTopLevelLists()
{
	// Regular expression: beginning with class name, or
	// class name preceded by a space; and ending with class name, or
	// class name followed by a space. Covers the ways a single class
	// name can appear with or without others in the className attribute.
	var cn = "link";
	var elements = document.getElementsByTagName("ul");
	var length = elements.length;
	var i;
	var regexp = new RegExp("(^| )" + cn + "( |$)");
	var results = new Array();
	for (i = 0; (i < length); i++) {
		if (regexp.test(elements[i].className)) {
			results.push(elements[i]);
		}
	}
	return results;
}
