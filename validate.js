function validate(txt, fieldTitle, fieldName){
	if(fieldTitle == undefined){
		return true;
	}
	var iChars = "\\\"[]{}|~`!@#$%^*()-+=;'<>,?.";
	if((txt == null || txt == "") && fieldName != "adminpassword"){
		alert(fieldTitle + " must be filled out.");
		return false;
	}
	if(fieldName == "classname"){
		iChars = iChars.replace('.', "");
		iChars = iChars.replace('\'', "");
		iChars = iChars.replace('!',"");
		iChars = iChars.replace('@',"");
		iChars = iChars.replace('#', "");
		iChars = iChars.replace('$', "");
		iChars = iChars.replace('%', "");
		iChars = iChars.replace('&', "");
		iChars = iChars.replace('*', "");
		iChars = iChars.replace('+', "");
		iChars = iChars.replace('=', "");
		iChars = iChars.replace('{}', "");
		iChars = iChars.replace('?', "");
		iChars = iChars.replace('<>', "");
		iChars = iChars.replace("'", "");
		iChars = iChars.replace('"', "");
	}
	if(fieldName == "password" || fieldName == "adminpassword"){
		iChars = iChars.replace('!',"");
		iChars = iChars.replace('@',"");
		iChars = iChars.replace('#', "");
		iChars = iChars.replace('$', "");
		iChars = iChars.replace('%', "");
		iChars = iChars.replace('&', "");
		iChars = iChars.replace('*', "");
		iChars = iChars.replace('+', "");
		iChars = iChars.replace('=', "");
		iChars = iChars.replace('{}', "");
		iChars = iChars.replace('?', "");
		iChars = iChars.replace('<>', "");
		iChars = iChars.replace("'", "");
		iChars = iChars.replace('"', "");
	}
	if(fieldName == "credits"){
		iChars = iChars.replace('.', '');
		if(isNaN(txt)){
			alert(fieldTitle + " is not a number.");
			return false;
		}
		var credits = Number(txt);
		if(credits <= 0){
			alert(fieldTitle + " must be greater than zero.");
			return false;
		}
		if(credits > 9.99){
			alert(fieldTitle + " must be less than 10.");
			return false;
		}
//		VALIDATE AS NUMBER	
	}
	if(fieldName =='year'){
		if(isNaN(txt)){
			alert(fieldTitle + " is not a number.");
			return false;
		}
		var year = Number(txt);
		if(year < 0){
			alert(fieldTitle + " is negative?");
			return false;
		}
	}
	if(fieldName == 'month'){
		if(isNaN(txt)){
			alert(fieldTitle + " is not a number.");
			return false;
		}
		var month = Number(txt);
		if(month <= 0 || month > 12){
			alert(fieldTitle + " is illogical.");
			return false;
		}
	}
	if(fieldName == 'day'){
		if(isNaN(txt)){
			alert(fieldTitle + " is not a number.");
			return false;
		}
		var day = Number(txt);
		if(day <= 0 || day > 31){
			alert(fieldTitle + " is illogical");
			return false;
		}
	}
	if(fieldName == "starttimehr" || fieldName == "endtimehr"){
		if(isNaN(txt)){
			alert(fieldTitle + " is not a number.");
			return false;
		}
		var hrs = Number(txt);
		if(hrs <= 0 || hrs > 12){
			alert(fieldTitle + " has illogical hours.");
			return false;
		}
	}
	if(fieldName == "starttimemin" || fieldName == "endtimemin"){
		if(isNaN(txt)){
			alert(fieldTitle + " is not a number.");
			return false;
		}
		var mins = Number(txt);
		if(mins < 0 || mins > 59){
			alert(fieldTitle + " has illogical minutes.");
			return false;
		}
	}
	if(fieldName == "faculty"){
		iChars = iChars.replace('.', "");
		iChars = iChars.replace('\'', "");
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