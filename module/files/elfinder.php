<?php class Modul
{
    function html_head()
    {
    
        ?>
	<link rel="stylesheet" href="module/files/css/common.css"      type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="module/files/css/dialog.css"      type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="module/files/css/toolbar.css"     type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="module/files/css/navbar.css"      type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="module/files/css/statusbar.css"   type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="module/files/css/contextmenu.css" type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="module/files/css/cwd.css"         type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="module/files/css/quicklook.css"   type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="module/files/css/commands.css"    type="text/css" media="screen" charset="utf-8">

	<link rel="stylesheet" href="module/files/css/theme.css"       type="text/css" media="screen" charset="utf-8">

	<!-- elfinder core -->
	<script src="module/files/js/elFinder.js"           type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/elFinder.version.js"   type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/jquery.elfinder.js"    type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/elFinder.resources.js" type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/elFinder.options.js"   type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/elFinder.history.js"   type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/elFinder.command.js"   type="text/javascript" charset="utf-8"></script>

	<!-- elfinder ui -->
	<script src="module/files/js/ui/overlay.js"       type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/workzone.js"      type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/navbar.js"        type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/dialog.js"        type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/tree.js"          type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/cwd.js"           type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/toolbar.js"       type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/button.js"        type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/uploadButton.js"  type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/viewbutton.js"    type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/searchbutton.js"  type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/sortbutton.js"    type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/panel.js"         type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/contextmenu.js"   type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/path.js"          type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/stat.js"          type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/ui/places.js"        type="text/javascript" charset="utf-8"></script>

	<!-- elfinder commands -->
	<script src="module/files/js/commands/back.js"      type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/forward.js"   type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/reload.js"    type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/up.js"        type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/home.js"      type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/copy.js"      type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/cut.js"       type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/paste.js"     type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/open.js"      type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/rm.js"        type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/info.js"      type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/duplicate.js" type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/rename.js"    type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/help.js"      type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/getfile.js"   type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/mkdir.js"     type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/mkfile.js"    type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/upload.js"    type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/download.js"  type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/edit.js"      type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/quicklook.js" type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/quicklook.plugins.js" type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/extract.js"   type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/archive.js"   type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/search.js"    type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/view.js"      type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/resize.js"    type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/sort.js"      type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/commands/netmount.js"      type="text/javascript" charset="utf-8"></script>

	<!-- elfinder languages -->
	<script src="module/files/js/i18n/elfinder.de.js"    type="text/javascript" charset="utf-8"></script>
	<script src="module/files/js/i18n/elfinder.en.js"    type="text/javascript" charset="utf-8"></script>
	
	<!-- elfinder dialog -->
	<script src="module/files/js/jquery.dialogelfinder.js"     type="text/javascript" charset="utf-8"></script>

	<!-- elfinder 1.x connector API support -->
	<script src="module/files/js/proxy/elFinderSupportVer1.js" type="text/javascript" charset="utf-8"></script>


    	<script type="text/javascript" charset="utf-8">
    		$().ready(function() {
    			
    			var f = $('#finder').elfinder({
    				url : 'module/files/php/connector.php',
    					<?php
                        switch ($GLOBALS['WMF']->INFO->lang['code'])
                        {
                            case 'de':
                                echo "lang : 'de',";
                            break;
                            case 'en':
                                echo "lang : 'en',";
                            break;
                            default :
                                echo "lang : 'en',";
                            break;
                        }
                         ?>
    				docked : true,
    				height : 500,
    				resizable : false
    
    				// dialog : {
    				// 	title : 'File manager',
    				// 	height : 500
    				// }
    
    				// Callback example
    				//editorCallback : function(url) {
    				//	if (window.console && window.console.log) {
    				//		window.console.log(url);
    				//	} else {
    				//		alert(url);
    				//	}
    				//},
    				//closeOnEditorCallback : true
    			})
    			// window.console.log(f)
    			$('#close,#open,#dock,#undock').click(function() {
    				$('#finder').elfinder($(this).attr('id'));
    			})
    			
    		})
    	</script>
    <?php 
    }
    function main()
    {
     ?>
	<div id="finder">finder</div>
<?php
    }
}
 ?>