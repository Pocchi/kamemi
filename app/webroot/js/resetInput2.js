//resetInput2.js
$(function(){
	var resetArray=['usersFCustName','usersFCustTel','usersFCustPost','usersFCustAddress','usersFCustMail','usersFCustPass','usersFCustDm_'];
	var comArray=['com_name','com_tel','com_post','com_address','com_mail','com_pass','com_dm'];
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
			console.log(comArray[i]+":"+comValue[i]);
			if(i==6){
				if ($("#usersFCustDm").is(':checked')) {
					$('#usersFCustDm_').val("1");
				} else {
					$('#usersFCustDm_').val("0");
				}
				var check=$("#usersFCustDm_").val();
				if(check=="1"){
					$('#'+comArray[i]).html("希望する");
					console.log("1");
				}else{
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
	
	$('#usersFCustDm').change(function(){
	if ($(this).is(':checked')) {
		$('#usersFCustDm_').val("1");
		
	} else {
		$('#usersFCustDm_').val("0");
	}
	});
});