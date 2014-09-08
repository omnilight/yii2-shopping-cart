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
 * @property int $price
 * @property int $cost
 * @property string $id
 * @property int $quantity
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