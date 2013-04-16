jQuery(document).ready(function()
{
  var cm_editor = {};
  var cm = 0;
  var firstRun = true;

  jQuery("#rex-rex_cronjob_phpcode textarea, #rex-page-module #rex-wrapper textarea, #rex-page-template #rex-wrapper textarea, textarea.codemirror").each(function(){

    if (firstRun) {
      jQuery("head").append('<link rel="stylesheet" type="text/css" href="../files/addons/be_utilities/plugins/codemirror/vendor/codemirror.css" media="screen" />');
      jQuery("head").append('<script type="text/javascript" src="../files/addons/be_utilities/plugins/codemirror/vendor/codemirror-compressed.js" />');

      firstRun = false;
    }

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
  
    jQuery("head").append('<link rel="stylesheet" type="text/css" href="../files/addons/be_utilities/plugins/codemirror/vendor/theme/'+theme+'.css" media="screen" />');
    
    cm_editor[cm] = CodeMirror.fromTextArea(document.getElementById(id), {
      lineNumbers: true,
      lineWrapping: false,
      styleActiveLine: false,
      matchBrackets: false,
      mode: mode,
      indentUnit: 4,
      indentWithTabs: true,
      enterMode: "keep",
      tabMode: "shift",
      theme: theme
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

    cm_editor[cm].setSize(width, height);
    cm_editor[cm].refresh();

  });

});
