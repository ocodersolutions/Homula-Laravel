$(document).ready(function(){
	$(".article_thumbnail span, .menu_icon span").click(function() {
		$(this).parent().find("#id_of_the_target_input").val("");
	});
	$(".article_thumbnail i, .menu_icon i").hover(function(){
		var src = $(this).parent().find("#id_of_the_target_input").val();
		$(this).attr('data-original-title', "<img src ='"+src+"'/>");
		if(src == "") {	$(this).attr('data-original-title', "Select image");	}
		$(this).tooltip({
		    animated: 'fade',
		    placement: 'bottom',
		    html: true
		});
	});	
});