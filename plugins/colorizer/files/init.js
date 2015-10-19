jQuery(document).ready( function() {
	jQuery(".rex-colorpicker").ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery(this).val("#" + hex);
		}
	})
	.bind("keyup", function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
});
