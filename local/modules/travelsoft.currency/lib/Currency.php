<?php
namespace travelsoft;
use Bitrix\Main\Config\Option,
        \Bitrix\Iblock\IblockTable,
            \Bitrix\Main\Application;
        

/**
 * Currency class of the bitrix application
 * 
 * @author dimabresky
 */
class Currency {
    
    static protected $instance;
    
    protected $exceptions = array(
        1 => 'not set price for convert',
        2 => 'currency #replace# not found',
        3 => 'currency iblock not found',
        4 => 'current course not setted',
        5 => 'course not setted'
    );

    protected $module_id = 'travelsoft.currency';

    protected $currency = array();

    protected $currency_iblock_id = null;
    protected $courses_iblock_id = null;
    protected $base_currency_id = null;
    protected $base_courses_id = null;
    protected $currency_format_decimals = null;
    protected $currency_format_dec_point =  null;
    protected $currency_format_thousands_sep = null;
    protected $current_currency = null;
    protected $iso_code_property = null;
	protected $courses_iso_to_id = null;
    
    private function __construct() {

        \Bitrix\Main\Loader::includeModule("iblock");
        $this->currency_iblock_id               = Option::get($this->module_id, 'currency_iblock_id');
        $this->courses_iblock_id                = Option::get($this->module_id, 'courses_iblock_id');
        $this->base_currency_id                 = Option::get($this->module_id, 'base_currency_id');
        $this->base_courses_id                  = Option::get($this->module_id, 'base_courses_id');
        $this->currency_format_decimals         = Option::get($this->module_id, 'currency_format_decimals');
        $this->currency_format_dec_point        = Option::get($this->module_id, 'currency_format_dec_point');
        $this->currency_format_thousands_sep    = Option::get($this->module_id, 'currency_format_thousands_sep');
        $this->iso_code_property                = Option::get($this->module_id, 'iso_code_property');

        $this->setCurrency();

        $this->setCourses();

        $this->setCurrentCurrency();
    }
    
    private function __clone() {}

    static public function getInstance() {

        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
        
    }

    protected function ibEx($ib, $mid) {

        $arIB = IblockTable::getList(
            array(
                'filter' => array('ID' => $ib),
                'select' => array('ID')
            )
        )->fetch();

        if (!$arIB['ID'])
            $this->e($mid);
        
    }
    
    protected function e($mid, $replace) {
        
        $mess = str_replace("#replace#", $replace, $this->exceptions[$mid]);
        
        throw new \Exception('Currency exception: ' . $mess);
    }
    
    public function convertCurrency ($price = null, $in = null, $out = null, $onlyN = false) {

        if ($price <= 0)
            $this->e(1);
        
        if ($in == null || !$this->find('currency', $in))
            $this->e(2, $in);

        if ($out == null) 
            $out = $this->current_currency;

        if (!$this->find('currency', $out))
            $this->e(2, $out);

        if (!isset($this->currency[$in]['course'][$this->currency[$out]['iso']]))
            $this->e(5);
        
        $price = $price / $this->currency[$in]['course'][$this->currency[$out]['iso']];
        if ($onlyN)
            return number_format(
                $price,
                $this->currency_format_decimals,
                $this->currency_format_dec_point,
                $this->currency_format_thousands_sep == "" ? " " : $this->currency_format_thousands_sep
            );

        return $this->format($price, $this->currency[$out]['iso']);
    }

    protected function setCurrentCurrency() {
        
        $this->current_currency = $this->base_currency_id;
        
        $currency = Application::getInstance()->getContext()->getRequest()->get("currency");
        if ($this->find('currency', $currency))
            $_SESSION['current_currency'] = $currency;

        if (isset($_SESSION['current_currency']) && $this->find('currency', $_SESSION['current_currency'])) 
            $this->current_currency = $_SESSION['current_currency'];      
    }
    
    protected function setCurrency() {

        $this->ibEx($this->currency_iblock_id, 3);
        
        $db_res = \CIBlockElement::GetList(
                    false,
                    array('IBLOCK_ID' => $this->currency_iblock_id, 'ACTIVE' => 'Y'),
                    false,
                    false,
                    array('*')
                );

        while ($res = $db_res->GetNextElement()) {
            
            $f = $res->GetFields();
            $p = $res->GetProperties();
			$this->courses_iso_to_id[$p[$this->iso_code_property]['VALUE']] = $f['ID'];
            $this->currency[$f['ID']] = array(
                'name' => $f['NAME'],
                'id' => $f['ID'],
                'course' => array(),
                'iso' => $p[$this->iso_code_property]['VALUE'],
				'commission' => $p["COMMISSION"]["VALUE"]
            );
        }

    }
    
    protected function setCourses() {

        $res = \CIBlockElement::GetByID($this->base_courses_id)->GetNextElement()->GetProperties();

        foreach ($res as $course => $val) {

			//$this->currency[$this->base_currency_id]['course'][$course] = $val['VALUE'];
			$this->currency[$this->base_currency_id]['course'][$course] = $val['VALUE'] + ($val['VALUE']*($this->currency[$this->courses_iso_to_id[$course]]["commission"]/100));
            if($this->currency[$this->base_currency_id]['iso'] == "BYN" && $course == "BYN")
                $this->currency[$this->base_currency_id]['course']["BYN"] = 1;
            
        }

        if (empty($this->currency[$this->base_currency_id]['course']))
            $this->e(4);
        
        foreach ($this->currency as $id => &$currency) {
            
            if ($id == $this->base_currency_id) 
                continue;
            
            $currency['course'] = $this->calcCourse($currency['iso']);

        }

    }
    
    protected function calcCourse($iso) {

        $courses = $this->currency[$this->base_currency_id]['course'];

        $result = array();
       
        if (isset($courses[$iso])) {
            
            $course = $courses[$iso];

            foreach ($courses as $i => $c) {

                $result[$i] = number_format($c/$course, 8, '.', '');
                
            }
            
        }

        return $result;
        
    }
    
    protected function find($case, &$find) {
        
        switch ($case) {
            case 'currency':
                
                if (isset($this->currency[$find])) {
                    return true;
                } else {
                    foreach ($this->currency as $id => $val) {
                        if ($val['iso'] == $find) {
                            $find = $id;
                            return true;
                        }
                    }
                }

                return false;
                
                break;

            default:
                break;
        }
        
    }
    
    protected function format($price, $out) {

        return number_format(
                $price,
                $this->currency_format_decimals,
                $this->currency_format_dec_point,
                $this->currency_format_thousands_sep == "" ? " " : $this->currency_format_thousands_sep
            ) . " " .$out;

    }
    
    public function get($case) {
        
        switch ($case) {
            case 'currency':
                
                return $this->currency;
                
                break;
            
            case 'current_currency':
                
                return $this->currency[$this->current_currency];
                
                break;
            
            case 'base_currency':
                
                return $this->currency[$this->base_currency_id];
                
                break;
            
            default:
                break;
        }
        
    }
    
}
