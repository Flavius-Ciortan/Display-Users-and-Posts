jQuery(document).ready(function($){
  jQuery('.accordion_tab').click(function() {
    if (jQuery(this).hasClass("active")) {
      jQuery(this).parent().removeClass("active");
	  jQuery(this).removeClass("active");
    } else {
		jQuery(this).parent().addClass("active");
		jQuery(this).addClass("active");
    }
    return false;
  });
  
}); 