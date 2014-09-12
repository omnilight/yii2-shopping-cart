<?php
namespace yz\shoppingcart;

abstract class Discount
{
    protected $shoppingCart;

    public function setShoppingCart(ShoppingCart $shoppingCart)
    {
        $this->shoppingCart = $shoppingCart;
    }

    /**
     * Apply discount
     *
     * @abstract
     * @return void
     */
    abstract public function apply();

}
