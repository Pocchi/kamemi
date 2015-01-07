//resetInput.js
$(function(){
	var resetArray=['sendFCustName','sendFSendTel','sendFSendPost','sendFSendAddress','sendFSendMail','sendFSendDm'];
	var comArray=['com_name','com_tel','com_post','com_address','com_mail','com_dm'];
	var resetArray2=['sendFOrderMail','sendFOrderMail_confirm'];
	var comValue=new Array();
	$('#reset').click(function() {
	    for(var i=0;i<resetArray.length;i++){
	    	$('#'+resetArray[i]).val("");
	    }
	});
	$('#reset2').click(function() {
	    for(var i=0;i<resetArray2.length;i++){
	    	$('#'+resetArray2[i]).val("");
	    }
	});
	
	$('#mordal_open').click(function() {
		//alert("modal");
		for(var i=0;i<resetArray.length;i++){
			comValue[i]=$('#'+resetArray[i]).val();
			$('#'+comArray[i]).html(comValue[i]);
			
		}
		
		modal_const();
		modal_open();
	});
	$('.closeButton').click(function() {
		//alert("modal");
		modal_close();
	});
});