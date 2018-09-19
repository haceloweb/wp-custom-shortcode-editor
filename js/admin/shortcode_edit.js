(function($) {
	
	$(document).ready(function(){

        $("#shortcode_param_add").click(function(){

            var paramCount = $("#shortcode_params_list li").length + 1;

            var newParamFields = '<li id="param-' + paramCount + '">';
            newParamFields = newParamFields + 'Code:&nbsp;&nbsp;<input type="text" name="shortcode_params[' + paramCount + '][code]" value=""/>&nbsp;&nbsp;';
            newParamFields = newParamFields + 'Description:&nbsp;&nbsp;<input type="text" name="shortcode_params[' + paramCount + '][text]" size="40" value=""/>';
            newParamFields = newParamFields + '<a href="!#" class="remove_btn" data-index="' + paramCount + '" style="text-decoration:none;"><span class="dashicons dashicons-trash"></span></a>';
            newParamFields = newParamFields + '</li>';

            $("#shortcode_params_list").append(newParamFields);

            $("#param-" + paramCount + " .remove_btn").click(function(e){
                e.preventDefault();
                $(this).parent().remove();
            });
            
        });

        $(".remove_btn").click(function(e){
            e.preventDefault();
            $(this).parent().remove();
        });
    });
	
})( jQuery );