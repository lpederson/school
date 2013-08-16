function insertAtCursor(myField, myValue) {
    //IE support
    if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = myValue;
    }
    //MOZILLA and others
    else if (myField.selectionStart || myField.selectionStart == '0') {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        myField.value = myField.value.substring(0, startPos)
            + myValue
            + myField.value.substring(endPos, myField.value.length);
        myField.selectionEnd = startPos + myValue.length;
    } else {
        myField.value += myValue;
    }
}
function captureTabPress(myField){
    document.getElementById(myField).onkeydown = function(e){
		if (e.keyCode == 9) {
			//this.value = this.value + '\t';
			insertAtCursor(this,'\t');
				this.focus();
			return false;
		}
    }

}