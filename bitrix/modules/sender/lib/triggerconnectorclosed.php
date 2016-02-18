<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage sender
 * @copyright 2001-2012 Bitrix
 */
namespace Bitrix\Sender;


abstract class TriggerConnectorClosed extends TriggerConnector
{
	/** @return bool */
	final public static function isClosed()
	{
		return true;
	}

	/**
	 * @return string
	 */
	final public function getEventModuleId()
	{
		return 'sender';
	}

	final public function getEventType()
	{
		return $this->getModuleId().'_'.$this->getCode();
	}

	/** @return array */
	final public function getProxyFieldsFromEventToConnector()
	{
		return array();
	}
}