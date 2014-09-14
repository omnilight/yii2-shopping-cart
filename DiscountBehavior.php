<?php

namespace yz\shoppingcart;

use yii\base\Behavior;


/**
 * Class DiscountBehavior
 * @package \yz\shoppingcart
 */
class DiscountBehavior extends Behavior
{
    public function events()
    {
        return [
            ShoppingCart::EVENT_COST_CALCULATION => 'onCostCalculation',
            CartPositionInterface::EVENT_COST_CALCULATION => 'onCostCalculation',
        ];
    }

    /**
     * @param CostCalculationEvent $event
     */
    public function onCostCalculation($event)
    {

    }
}