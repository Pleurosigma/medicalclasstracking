<SCRIPT LANGUAGE = "JavaScript">
<!--

var totalboxes;

function setCount(count, target){
 
  totalboxes=count;

// the next 3 lines are the main lines of this script
//remember to leave action field blank when defining the form 
if(target == 0) document.myform.action="program1.jsp";
if(target == 1) document.myform.action="program2.jsp";
if(target == 2) document.myform.action="program3.jsp"; 
 
}

function isReady(form) {

 
  for(var x=0 ; x<totalboxes ; x++){
 

 //if even one box is checked then return true
if(myform.boxes[x].checked) return true;  
}   
  //default action : When even one was not checked then..
alert("Please check at least one checkbox..");
return false;
 
}

//-->
</SCRIPT>

<BODY>

<FORM onSubmit="return isReady(this)" METHOD="post" NAME="myform" ACTION="">
<INPUT TYPE="checkbox" NAME="boxes" VALUE="box1">Box 1 <BR> 
<INPUT TYPE="checkbox" NAME="boxes" VALUE="box2">Box 2 <BR>
<INPUT TYPE="checkbox" NAME="boxes" VALUE="box2">Box 3 <BR>
<INPUT TYPE="checkbox" NAME="boxes" VALUE="box2">Box 4 <BR>
<INPUT TYPE="checkbox" NAME="boxes" VALUE="box2">Box 5 <BR> 

<INPUT TYPE="image" onClick="setCount(5,0)" 
NAME="Submit1" VALUE="delete" SRC="delete_icon.jpg">
<INPUT TYPE="image" onClick="setCount(5,1)" 
NAME="Submit2" VALUE="view" SRC="view_icon.jpg">
<INPUT TYPE="image" onClick="setCount(5,2)" 
NAME="Submit3" VALUE="modify" SRC="modify_icon.jpg"> 
</FORM>
</BODY>