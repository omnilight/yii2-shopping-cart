<?php

namespace yz\shoppingcart;

use yii\base\Component;
use yii\base\Event;


/**
 * Class ShoppingCart
 * @property CartPositionInterface[] $positions
 * @property int $count Total count of positions in the cart
 * @property int $cost Total cost of positions in the cart
 * @property bool $isEmpty Returns true if cart is empty
 * @package \yz\shoppingcart
 */
class ShoppingCart extends Component
{
	const EVENT_POSITION_PUT = 'putPosition';
	const EVENT_POSITION_UPDATE = 'updatePosition';
	const EVENT_BEFORE_POSITION_REMOVE = 'removePosition';

	/**
	 * Shopping cart ID to support multiple carts
	 * @var string
	 */
	public $cartId = __CLASS__;

	/**
	 * @var CartPositionInterface[]
	 */
	protected $_positions = [];

	public function init()
	{
		$this->loadFromSession();
	}

	/**
	 * @param CartPositionInterface $position
	 * @param int $quantity
	 */
	public function put($position, $quantity = 1)
	{
		if (isset($this->_positions[$position->getId()])) {
			$this->_positions[$position->getId()]->setQuantity(
				$this->_positions[$position->getId()]->getQuantity() + $quantity);
		} else {
			$position->setQuantity($quantity);
			$this->_positions[$position->getId()] = $position;
		}
		$this->trigger(self::EVENT_POSITION_PUT, new Event([
			'data' => $this->_positions[$position->getId()],
		]));
		$this->saveToSession();
	}

	/**
	 * @param CartPositionInterface $position
	 * @param int $quantity
	 */
	public function update($position, $quantity)
	{
		if (isset($this->_positions[$position->getId()])) {
			$this->_positions[$position->getId()]->setQuantity($quantity);
		} else {
			$position->setQuantity($quantity);
			$this->_positions[$position->getId()] = $position;
		}
		$this->trigger(self::EVENT_POSITION_UPDATE, new Event([
			'data' => $this->_positions[$position->getId()],
		]));
		$this->saveToSession();
	}

	/**
	 * @param CartPositionInterface $position
	 */
	public function remove($position)
	{
		$this->trigger(self::EVENT_BEFORE_POSITION_REMOVE, new Event([
			'data' => $this->_positions[$position->getId()],
		]));
		unset($this->_positions[$position->getId()]);
		$this->saveToSession();
	}

	public function removeAll()
	{
		$this->_positions = [];
		$this->saveToSession();
	}

	/**
	 * @param string $id
	 * @return CartPositionInterface
	 */
	public function getPositionById($id)
	{
		return $this->_positions[$id];
	}

	/**
	 * @return CartPositionInterface[]
	 */
	public function getPositions()
	{
		return $this->_positions;
	}

	/**
	 * @return bool
	 */
	public function getIsEmpty()
	{
		return count($this->_positions) == 0;
	}

	/**
	 * @return int
	 */
	public function getCount()
	{
		$count = 0;
		foreach ($this->_positions as $position)
			$count += $position->getQuantity();
		return $count;
	}

	/**
	 * @return int
	 */
	public function getCost()
	{
		$cost = 0;
		foreach ($this->_positions as $position)
			$cost += $position->getCost();
		return $cost;
	}

	protected function saveToSession()
	{
		\Yii::$app->session[$this->cartId] = serialize($this->_positions);
	}

	protected function loadFromSession()
	{
		if (isset(\Yii::$app->session[$this->cartId]))
			$this->_positions = unserialize(\Yii::$app->session[$this->cartId]);
	}
}