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
 * @property float $quantity
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
		$this->quantity = $quantity;
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