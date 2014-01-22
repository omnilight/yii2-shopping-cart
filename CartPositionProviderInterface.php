<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.01.14
 * Time: 1:15
 */

namespace yz\shoppingcart;


/**
 * Interface CartPositionProviderInterface
 * @property CartPositionInterface $cartPosition
 * @package yz\shoppingcart
 */
interface CartPositionProviderInterface
{
	/**
	 * @return CartPositionInterface
	 */
	public function getCartPosition();
} 