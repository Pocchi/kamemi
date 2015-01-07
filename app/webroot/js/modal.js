function modal(){
	modal_const();
	$("#modal").click(function(){
		modal_open();
	});

	$(".closeButton").click(function(){
		modal_close();
	});
}
function modal_close(){
		m_b.removeClass('modal_visible');
		m_b.addClass('modal_hidden');
		m_b.fadeOut("fast");
		return false;
}

function modal_open(){
		m_b.addClass('modal_visible');
		m_b.removeClass('modal_hidden');
		m_b.fadeIn("fast");
		return false;
}
function modal_const(){
	modal=$("#modal");
	back=$("#modal_back");
	m_b=$("#modal,#modal_back");
}