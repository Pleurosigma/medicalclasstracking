function show_hide(id, hidden){
	if(e = document.getElementById(id)){
		if(hidden == null)
			hidden = e.style.display == 'none';
		if(hidden)
			e.style.display = '';
		else
			e.style.display = 'none';
	}
}