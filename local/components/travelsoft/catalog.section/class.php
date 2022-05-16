<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/**
* расширение для подключения пролога компонента
*/
class CBitrixComponentExt extends CBitrixComponent
{
	private function include_component_prolog_php($path)
	{
		if(file_exists($path))
		{
			require $path;
			return true;
		}

		return false;
	}

	private function includeComponentProlog()
	{
		
		$n = $this->GetTemplateName();
		if($n == "")
			$n = ".default";

		$path = $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/components" . $this->GetRelativePath() . '/' . $n . '/component_prolog.php';

		if(!$this->include_component_prolog_php($path))
		{
			$path = $_SERVER["DOCUMENT_ROOT"] . "/local/components" . $this->GetRelativePath() . '/templates/' . $n . '/component_prolog.php';
			
			if(!$this->include_component_prolog_php( $path ) )
			{
				$path = $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components" . $this->GetRelativePath() . '/templates/' . $n . '/component_prolog.php';
				$this->include_component_prolog_php( $path );
			}

		}
	}

	public function executeComponent()
	{
		/**
		* Подключение component_prolog.php
		* определять в шаблоне компонента
		*/
		$this->includeComponentProlog();

		return parent::executeComponent();
	}
}

