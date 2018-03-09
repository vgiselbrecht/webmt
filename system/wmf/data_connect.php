<?php

class DATA_CONNECT
{
    function getXMLFile($file)
    {
        if (function_exists('curl_init'))
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $file);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $xml_inhalt = curl_exec($ch);
            curl_close($ch);
            return @simplexml_load_string($xml_inhalt);    
        }
        else
        {
            return @simplexml_load_file($file); // Datei einlesen
        }
    }
    
    function downloadFile($file, $path)
    {
       if (function_exists('curl_init'))
        {
            $fp = fopen($path, 'w');
            $ch = curl_init($file);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            $data = curl_exec($ch);
            curl_close($ch);
            fclose($fp);
        }
        else 
        {
            copy($file, $path);    
        }
        if (file_exists($path))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>
