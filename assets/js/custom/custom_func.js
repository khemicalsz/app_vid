$(document).ready(function(){
	$("#emailResponder").change(function(){
		var getResonder = $(this).val();
		
		if(getResonder == 'AWeber')
		{
			$("#responderID").slideDown();
			$("#mailChimpInput").slideUp();
			
			$("#responderRedirectUrl").slideDown();
			
		}
		else if (getResonder == 'GetResponse')
		{
			$("#responderRedirectUrl").slideUp();
			$("#mailChimpInput").slideUp();
			$("#responderID").slideDown();
		}
		else if (getResonder == 'Mailchimp')
		{
			$("#responderRedirectUrl").slideUp();
			$("#responderID").slideUp();
			
			$("#mailChimpInput").slideDown();
		}
		else
		{
			$("#responderRedirectUrl").slideUp();
			$("#responderID").slideUp();
			$("#mailChimpInput").slideUp();
		}
		
	});

	function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}

/*document.getElementById("copyButton").addEventListener("click", function() {
    
});
*/
$("#copyButton").click(function(){
	copyToClipboard(document.getElementById("showGenCode"));
});

$("#copyWpButton").click(function(){
	copyToClipboard(document.getElementById("showWordpressCode"));
});

		
});