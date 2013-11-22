
// this is to avoid flickering of ctype/category stuff in template-page
jQuery(function($) {
	if($("#active").is(":not(:checked)")) {
		// hiding gets done in template.inc.php
	} else {
		$("#rex-form-template-ctype").show();
		$("#rex-form-template-categories").show();
	}
});

var initCodeMirror = false;

if (jQuery("#rex-rex_cronjob_phpcode textarea, #rex-page-module #rex-wrapper textarea, #rex-page-template #rex-wrapper textarea, textarea.codemirror").length > 0) {
	// add js only if necessary
	jQuery("head").append('<script type="text/javascript" src="../files/addons/be_utilities/plugins/codemirror/vendor/codemirror-compressed.js" />');

	initCodeMirror = true;
}

jQuery(document).ready(function()
{

  if (initCodeMirror) {
	  var cm_editor = {};
	  var cm = 0;
	  var themeCssAdded = false;

      

	  jQuery("#rex-rex_cronjob_phpcode textarea, #rex-page-module #rex-wrapper textarea, #rex-page-template #rex-wrapper textarea, textarea.codemirror").each(function(){
		var t = jQuery(this);
		var id = t.attr("id");

		if(typeof id === "undefined") {
		  cm++;
		  id = 'codemirror-id-'+cm;
		  t.attr("id",id);
		}

		var mode = "application/x-httpd-php";
		var theme = codemirror_defaulttheme;

		var new_mode = t.attr("data-codemirror-mode");
		var new_theme = t.attr("data-codemirror-theme");

		if(typeof new_mode !== "undefined") {
		  mode = new_mode;
		}
		
		if(typeof new_theme !== "undefined") {
		  theme = new_theme;
		}
	  
		if (!themeCssAdded) {
		  jQuery("head").append('<link rel="stylesheet" type="text/css" href="../files/addons/be_utilities/plugins/codemirror/vendor/theme/'+theme+'.css" media="screen" />');

		  themeCssAdded = true;
		}
		
		cm_editor[cm] = CodeMirror.fromTextArea(document.getElementById(id), {
			lineNumbers: true,
			lineWrapping: false,
			styleActiveLine: false,
			matchBrackets: false,
			mode: mode,
			indentUnit: 4,
			indentWithTabs: true,
			smartIndent: false,
			enterMode: "keep",
			tabMode: "shift",
			theme: theme,
			extraKeys: {
				"F11": function(cm) {
					cm.setOption("fullScreen", !cm.getOption("fullScreen"));
				},
				"Esc": function(cm) {
					if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
				}
			}
		});
	  
		jQuery(cm_editor[cm].getWrapperElement())
		  .css("margin-top", t.css("margin-top"))
		  .css("margin-left", t.css("margin-left"))
		  .css("margin-bottom", t.css("margin-bottom"))
		  .css("margin-right", t.css("margin-right"));

		var height = parseInt(t.height());
		var width = parseInt(t.width());

		if(height < 150) {
		  height = 150;
		}
		if(width < 300) {
		  width = 300;
		}

		cm_editor[cm].setSize(width, height + 5);
		cm_editor[cm].refresh();

	  });

		if (jQuery('#rex-page-tracking-code').length == 0) {
			jQuery('.CodeMirror').after( '<div class="fullscreen-hint">F11 = Vollbild</div>' );
		}

	}

});
