//menber_tab.js
$(function(){
	$("#modal_open").click(function(){
		alert("ok");
		condsole.log("aaaaaaaaaa");
	});
	var status=true;
	//trueならば会員表示、falseならば履歴表示
	$("#menber").click(function(){
		if(status!=true){
			$("#right_buy_history").hide();
			$("#right_menber").fadeIn();
			$('#history').css('background', '#fff');
			$('#menber').css('background', '#cc0');
		}
		status=!status;
	});
	
	$("#history").click(function(){
		if(status==true){
			$("#right_menber").hide();
			$("#right_buy_history").fadeIn();
			$('#menber').css('background', '#fff');
			$('#history').css('background', '#cc0');
		}
		status=!status;
	});

});
//
//
//function modal(){
//	modal_const();
//	$("#modal").click(function(){
//		modal_open();
//	});
//
//	$(".closeButton").click(function(){
//		modal_close();
//	});
//}
//function modal_close(){
//	m_b.removeClass('modal_visible');
//	m_b.addClass('modal_hidden');
//	m_b.fadeOut("fast");
//	return false;
//}
//
//function modal_open(){
//	m_b.addClass('modal_visible');
//	m_b.removeClass('modal_hidden');
//	m_b.fadeIn("fast");
//	return false;
//}
//function modal_const(){
//	modal=$("#modal");
//	back=$("#modal_back");
//	m_b=$("#modal,#modal_back");
//}