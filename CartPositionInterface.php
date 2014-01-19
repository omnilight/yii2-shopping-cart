<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 18.01.14
 * Time: 22:25
 */

namespace yz\shoppingcart;


/**
 * Interface CartItemInterface
 * @package yz\shoppingcart
 */
interface CartPositionInterface
{
	/**
	 * @return integer
	 */
	public function getPrice();

	/**
	 * @return integer
	 */
	public function getCost();

	/**
	 * @return string
	 */
	public function getId();

	/**
	 * @param int $quantity
	 */
	public function setQuantity($quantity);

	/**
	 * @return int
	 */
	public function getQuantity();
} 