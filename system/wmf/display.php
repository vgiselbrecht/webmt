<?php

class DISPLAY
{
    function errors($wd = true)
    {
        $error = '';
        if ($wd)
        {
            $error .= '<div style="color: #FF2A2A;">';
        }
        foreach ($GLOBALS['err'] as $wert)
        {
            $error .=  $wert;
            $error .=  '<br />';
        }
        if ($wd)
        {
            $error .=  '</div>';
        }
        return $error;
    }
}
?>
