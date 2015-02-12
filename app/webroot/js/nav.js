//nav.js

$(function() {
	var status=false;

	//$("#nav_box,#hamburger-fix").hide();
	
	$("#hamburger-botton,#hamburger-fix").click(function(){
		if(status==false){
			//開く
			$('#nav_box,#hamburger-fix').css("visibility","visible");
			$("#nav_box,#hamburger-fix").fadeIn();
			$('#hamburger-botton').css('background', '#cca');
		}else{
			//閉じる
			$("#nav_box,#hamburger-fix").fadeOut();
			$('#hamburger-botton').css('background', '#f00');
		}
		status=!status;
	});

});