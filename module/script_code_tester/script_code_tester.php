<?php
class Modul
{
    function php_head()
    {
        if (isset($_REQUEST['mf']) AND isset($_POST['text']))
        {
            if  ($_REQUEST['mf'] == 1)
            {
	            $datei_handle=fopen("module/script_code_tester/script.php","w");
	            fwrite($datei_handle, stripslashes($_POST['text']));
	            fclose($datei_handle);
            }
        }
    }
    
    function html_head()
    {
        ?>
                <link rel="stylesheet" href="module/script_code_tester/codemirror/lib/codemirror.css">
                <script src="module/script_code_tester/codemirror/lib/codemirror.js"></script>
                <script src="module/script_code_tester/codemirror/mode/xml/xml.js"></script>
                <script src="module/script_code_tester/codemirror/mode/javascript/javascript.js"></script>
                <script src="module/script_code_tester/codemirror/mode/css/css.js"></script>
                <script src="module/script_code_tester/codemirror/mode/clike/clike.js"></script>
                <script src="module/script_code_tester/codemirror/mode/php/php.js"></script>
        <?php 
    }

    function main()
    {
        $f = fopen("module/script_code_tester/script.php", "r");

    	$text = "";
    	while(!feof($f)) {
    	    $text = $text.fgets($f);
    	}

    	fclose($f);
        ?>
            <script>
            	$(function() {
            		$( "input:submit", ".formular" ).button();
            	});
        	</script>
        	<div class="formular">
                <form action="?mf=1&id=<?php echo $_REQUEST['id']; ?>" method="post">
                    <textarea id="code" name="text" rows="30" cols="90"><?php echo $text; ?></textarea>
                    <br />
                    <input type="submit" value="<?php echo $GLOBALS['lang']['testing']; ?>"/>
                </form>
            </div>
            <script>
              var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
                lineNumbers: true,
                matchBrackets: true,
                mode: "application/x-httpd-php",
                indentUnit: 4,
                indentWithTabs: true,
                enterMode: "keep",
                tabMode: "shift"
              });
            </script>
        <?php
        
        if (isset($_REQUEST['mf']) AND isset($_POST['text']))
        {
            if  ($_REQUEST['mf'] == 1)
            {
	            ?>
	               <script>
                	$(function() {
                		$( "#dialog" ).dialog({ modal: true, width: 700 });
                	});
                	</script>
                	<div id="dialog" title="<?php echo $GLOBALS['lang']['output']; ?>" style="display: none;">
                	<?php include 'module/script_code_tester/script.php'; ?>
                	</div>
	            <?php
            }
        }  
    }
}

 ?>