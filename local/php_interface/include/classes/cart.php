<?

namespace travelsoft;

/**
* Travelsoft class of booking cart
*
* @author dimabresky
*
*/
class Cart {

	protected $cart = null;

	
	//"ID" 	
	//"NAME" 
	//"ROOM_NAME" 
	//"CHECK_IN" 	
	//"CHECK_OUT"
	//"PEOPLE" 
	//"PRICE"	
	//"CURRENCY"
		
	
	public function __construct () {

		
		if (!is_array($_SESSION['TRAVELSOFT_CART']))
			$_SESSION['TRAVELSOFT_CART'] = array();

		// init basket
		$this->cart = &$_SESSION['TRAVELSOFT_CART'];

	}

	/**
	* cart is empty ???
	*
	* @return boolean
	*
	*/
	public function isEmpty () {

		if (empty($this->cart))
			return true;

		return false;

	}

	/**
	* add product in cart
	*
	* @param array $product
	*
	* @return number of row product in cart
	*/
	public function add ( $product ) {

		//array_push($this->cart, $product);
        $this->cart = array($product);

	}

	/**
	* delete product(s) from cart
	*
	* @param array filter
	*
	* @return bolean
	*/
	public function delete ( $numRow ) {

		unset($this->cart[$numRow]);
		
	}

	/**
	* update product in cart
	*
	* @param iteger $numRow
	*
	* @param array $productFileds
	*
	* @return bolean
	*/
	public function update ( $numRow, $productFields ) {

		if (isset($this->cart[$numRow])) {
			
			$updated = false;
			foreach ($productFields as $key => $value) {
				
				if(isset($this->cart[$numRow][$key])) {
					$updated = true;
					$this->cart[$numRow][$key] = $value;
				}

			}

			if ($updated) return true;
		}

		return false;
	}

	/**
	* get products of cart
	* 
	* @return array of cart
	*/
	public function get () {

		return $this->cart;

	}

	/**
	* clear cart
	*
	* @param array $search
	*
	*/
	public function clear () {

		$this->cart = array();

	}

	/**
	* check exists position
	* @param $numRow
	* @return boolean
	*/
	public function checkPosition($numRow) {

		if (isset($this->cart[$numRow]))
			return true;

		return false;

	}


	/**
	* find field value in cart row
	*
	* @param array $search
	*
	*/
	/*protected function _find ( (array)$search ) {


	}*/



	

}