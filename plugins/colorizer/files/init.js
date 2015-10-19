jQuery(document).ready( function() {
	jQuery(".rex-colorpicker").each(function() {
		var colorPickerTextfieldId = jQuery(this).attr('id');

		jQuery(jQuery(this)).ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				jQuery(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				jQuery(this).ColorPickerSetColor(this.value);
			},
			onChange: function (hsb, hex, rgb) {
				jQuery('#' + colorPickerTextfieldId).val("#" + hex);
			}
		})
		.bind("keyup", function(){
			jQuery(this).ColorPickerSetColor(this.value);
		});
	});
});
