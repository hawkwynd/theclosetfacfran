jQuery(document).ready(function() {
	jQuery(".collapsable").find(".gform_body").hide();
	jQuery(".collapsable").find(".gform_footer").hide();

	jQuery(".collapsable .gform_heading").click(function()
	{
		jQuery(".collapsable").find(".gform_body").slideToggle(200);
		jQuery(".collapsable").find(".gform_footer").slideToggle(200);
	});
});