<?
/**
* Буфиризация ajax-контента
*/

class AjaxContent
{
    public static function start($area)
    {
    	global $APPLICATION;



    	if($area == "")
    		return;

        echo "<div id='" . $area . "'>";
        $GLOBALS['AJAX_OPEN_TAG'] = true;

        if($area != $_REQUEST["ajax"])
            return;

    	$APPLICATION->RestartBuffer();

    	$GLOBALS['AJAX_START'] = true;

    }

    public static function end($area)
    {
        if($GLOBALS['AJAX_OPEN_TAG'])
            echo "</div>";

    	if($area == "" || $area != $_REQUEST["ajax"] || !$GLOBALS['AJAX_START'])
        {
    		return;
        }

		die();
    }
}