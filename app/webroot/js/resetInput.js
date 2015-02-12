//resetInput.js
$(function(){
	var resetArray=['sendFCustName','sendFSendTel','sendFSendPost','sendFSendAddress','sendFSendMail','check_'];
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
			if(i==5){
				if ($("#check").is(':checked')) {
					$('#check_').val("1");
					
				} else {
					$('#check_').val("0");
				}
				var check=$("#check_").val();
				if(check=="1" || check=="希望する"){
					$('#'+comArray[i]).html("希望する");
					console.log("1");
				}else if(check=="0"){
					$('#'+comArray[i]).html("希望しない");
					console.log("2");
				}
			}
			
		}
		
		modal_const();
		modal_open();
	});
	$('.closeButton').click(function() {
		//alert("modal");
		modal_close();
	});
	$('#check').change(function(){
	if ($(this).is(':checked')) {
		$('#check_').val("1");
		
	} else {
		$('#check_').val("0");
	}
	});
});