<?php

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
    /** Triggered on cost calculation */
    const EVENT_COST_CALCULATION = 'costCalculation';

    /**
     * @return integer
     */
    public function getPrice();

    /**
     * @param bool $withDiscount
     * @return integer
     */
    public function getCost($withDiscount = true);

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