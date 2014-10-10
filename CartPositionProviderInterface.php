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
     * @param array $params Parameters for cart position
     * @return CartPositionInterface
     */
    public function getCartPosition($params = []);
} 