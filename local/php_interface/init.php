<?
$interface_include_path = '/local/php_interface/include/';

/* Вспомогательные классы */
\Bitrix\Main\Loader::registerAutoLoadClasses(
		null, 
		array(
				 "AjaxContent" 	=> $interface_include_path ."/classes/ajax.php",
					     'Set' 	=> $interface_include_path ."/classes/settings.php",
			'\travelsoft\Cart' 	=> $interface_include_path ."/classes/cart.php",
      'InfoBlock'   => $interface_include_path ."/classes/InfoBlock.php",
		)
	);

/* функции */
if(file_exists($_SERVER["DOCUMENT_ROOT"] . $interface_include_path ."/functions.php"))
	require_once $_SERVER["DOCUMENT_ROOT"] . $interface_include_path ."/functions.php";

/* обработчики событий */
if(file_exists($_SERVER["DOCUMENT_ROOT"] . $interface_include_path ."/events.php"))
	require_once $_SERVER["DOCUMENT_ROOT"] . $interface_include_path ."/events.php";
