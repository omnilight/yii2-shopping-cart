<?php

namespace yz\shoppingcart;
use yii\base\Event;


/**
 * Class CartActionEvent
 */
class CartActionEvent extends Event
{
    const ACTION_UPDATE = 'update';
    const ACTION_POSITION_PUT = 'positionPut';
    const ACTION_BEFORE_REMOVE = 'beforeRemove';
    const ACTION_REMOVE_ALL = 'removeAll';
    const ACTION_SET_POSITIONS = 'setPositions';

    /**
     * Name of the action taken on the cart
     * @var string
     */
    public $action;
    /**
     * Position of the cart that was affected. Could be null if action deals with all positions of the cart
     * @var CartPositionInterface
     */
    public $position;
}