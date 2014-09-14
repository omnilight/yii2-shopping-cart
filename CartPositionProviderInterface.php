<?php

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