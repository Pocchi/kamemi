//menber_tab.js
$(function(){
	var status=true;
	//trueならば会員表示、falseならば履歴表示
	$("#menber").click(function(){
		if(status!=true){
			$("#right_buy_history").hide();
			$("#right_menber").fadeIn();
			$('#history').css('background', '#fff');
			$('#menber').css('background', '#cca');
		}
		status=!status;
	});
	
	$("#history").click(function(){
		if(status==true){
			$("#right_menber").hide();
			$("#right_buy_history").fadeIn();
			$('#menber').css('background', '#fff');
			$('#history').css('background', '#cca');
		}
		status=!status;
	});
});