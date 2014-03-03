<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19.01.14
 * Time: 13:21
 */

namespace yz\shoppingcart;

/**
 * Trait CartPositionTrait
 * @property int $quantity Returns quantity of cart position
 * @property int $cost Returns cost of cart position. Default value is 'price * quantity'
 * @package yz\shoppingcart
 */
trait CartPositionTrait
{
	protected $_quantity;

	public function getQuantity()
	{
		return $this->_quantity;
	}

	public function setQuantity($quantity)
	{
		$this->_quantity = $quantity;
	}

	/**
	 * Default implementation for getCost function. Cost is calculated as price * quantity
	 * @return int
	 */
	public function getCost()
	{
		return $this->getQuantity() * $this->getPrice();
	}
} 