<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arParams = &$this->arParams;

$GLOBALS[$arParams['FILTER_NAME']] = array();

$prefix = "ADD_PROPERTY";
foreach ($arParams as $k => $v)
{
	$sb = substr($k, 0, strlen($prefix));
	if( $sb == $prefix )
	{
		$n = substr($k, 4, strlen($k));
		
		$sb = substr($n, strlen($n) - 3, strlen($k));

		if($sb == 'min' )
		{
			if($v != "")
				$GLOBALS[$arParams['FILTER_NAME']]['>=' . substr($n, 0, strlen($n) -4)] = $v;
		}
		else
			if($sb == 'max')
			{
				if($v != "")
					$GLOBALS[$arParams['FILTER_NAME']]['<=' . substr($n, 0, strlen($n) -4)] = $v;
			}
			else
			{
				$sb = substr($n, strlen($n)-2, strlen($n));
				if($sb == 'ID')
				{
					foreach ($v as $vv)
					{
						$GLOBALS[$arParams['FILTER_NAME']]['ID'][] = $v;
					}
				}					
				else
					if($v == "Y")
						$GLOBALS[$arParams['FILTER_NAME']][$n] = 'да';
					else
						if($v != '-' && $v != 'N')
							$GLOBALS[$arParams['FILTER_NAME']][$n] = $v;
			}
	}
}