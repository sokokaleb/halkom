//count remaining characters
function countteaser() {
	var counterobj = document.getElementById("teasercount");
	var sourceobj = document.getElementById("txt_compteaser");
	var remchar = 140 - sourceobj.value.length;
	counterobj.innerHTML = remchar + " remaining";
}

//append data before submitting
function appenddata() {
	var textdata = CKEDITOR.instances.editor1.getData();
	document.getElementById("txt_compdetails").innerHTML = textdata
}

//activate CKEditor
document.getElementById("editorloader").style.display = "none";
document.getElementById("compdetailscont").style.display = "none";
CKEDITOR.appendTo("ckeditcont",null,"");
