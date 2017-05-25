<?php

namespace yz\shoppingcart;

use yii\base\Behavior;


/**
 * Class ShippingCostBehavior
 * @package \yz\shoppingcart
 */
class ShippingCostBehavior extends Behavior
{
    public function events()
    {
        return [
            ShoppingCart::EVENT_SHIPPING_COST_CALCULATION => 'onShippingCostCalculation',
        ];
    }

    /**
     * @param CostCalculationEvent $event
     */
    public function onShippingCostCalculation($event)
    {

    }
}