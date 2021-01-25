function goBackFunction(number){
    history.go(-number);
}

function showSearchBar(){
    var form=document.getElementById('searchForm');
    if(form.style.display=="block"){
        document.getElementById('searchForm').style.display="none";
        document.getElementById('searchBtn').style.background="dodgerblue";
        document.getElementById('searchBtn').innerHTML="Search";
    }
    else{
        document.getElementById('searchForm').style.display="block";
        document.getElementById('searchBtn').style.background="seagreen";
        document.getElementById('searchBtn').innerHTML="Hide";
    }
}



var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
	
	if(window.matchMedia("(max-width:980px)").matches){
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("ask_question_pencil").style.right = "20px";
        }
        else {
            document.getElementById("ask_question_pencil").style.right = "-70px";
        }
        prevScrollpos = currentScrollPos;
    }//if media matches
}
