function validate(txt, fieldTitle, fieldName){
	if(fieldTitle == undefined){
		return true;
	}
	var iChars = "\"!@#$%^&*()+=-[]{}\';,/|<>?";
	if(txt == null || txt == ""){
		alert(fieldTitle + " must be filled out.");
		return false;
	}
	if(fieldName == "date"){
		iChars = "\"!@#$%^&*()+=[]{}\';,/|<>?";
//		VALIDATE DATE SYNTAX
	}
	if(fieldName == "credits"){
		if(isNaN(txt)){
			alert(fieldName + " is not a number.");
			return false;
		}
		var credits = Number(txt);
		if(credits <= 0){
			alert(fieldName + " must be greater than zero.");
			return false;
		}
		if(credits > 9.99){
			alert(fieldName + " must be less than 10.");
			return false;
		}
//		VALIDATE AS NUMBER	
	}
	if(fieldName == "starttime" || fieldName == "endTime"){
		iChars = "\"!@#$%^&*()+=[]{}\';,/|<>?";
//		VALIDATE AS TIME		
	}
	for(var i = 0; i < txt.length; i++){
		if(iChars.indexOf(txt.charAt(i)) != -1){
			alert("No Special Characters in " + fieldTitle);
			return false;
		}
	}
	return true;
	
}


function validate_form(form){
	var elements = form.getElementsByTagName("input");
	var flag = true;
	for(index in elements){
		flag = flag && validate( elements[index].value, elements[index].title, elements[index].name);
	}
	return flag;
}