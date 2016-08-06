document.addEventListener("DOMContentLoaded", function () {
    checkDisabledForm();
});

function checkDisabledForm () {
    var forms = document.querySelectorAll("form.disabled");
    for(var i = 0; i < forms.length; i++) {
	var form = forms[i];
	form.removeAttribute("action");
	form.removeAttribute("method");
	var inputs = form.querySelectorAll("input");
	var textareas = form.querySelectorAll("textarea");
	var selects = form.querySelectorAll("select");
	var buttons = form.querySelectorAll("button");
	for(var j = 0; j < inputs.length; j++) {
	    inputs[j].setAttribute("disabled", "");
	}
	for(var j = 0; j < textareas.length; j++) {
	    textareas[j].setAttribute("disabled", "");
	    convertTextareaToDiv(textareas[j]);
	}
	for(var j = 0; j < selects.length; j++) {
	    selects[j].setAttribute("disabled", "");
	}
	for(var j = 0; j < buttons.length; j++) {
	    buttons[j].remove();
	}

    }
}

function convertTextareaToDiv(textarea) {
    var div = document.createElement("div");
    div.innerHTML = textarea.value;
    textarea.parentElement.replaceChild(div, textarea);
    return true;
}
