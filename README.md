Shopping cart for Yii 2
=======================

This extension adds shopping cart for Yii framework 2.0

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist omnilight/yii2-shopping-cart "*"
```

or add

```json
"omnilight/yii2-shopping-cart": "*"
```

to the `require` section of your composer.json.

How to use
----------

In your model:
```php
class Product extends ActiveRecord implements CartPositionInterface
{
    use CartPositionTrait;

    public function getPrice()
    {
        return $this->price;
    }

    public function getId()
    {
        return $this->id;
    }
}
```

In your controller:
```php
public function actionAddToCart($id)
{
    $cart = Yii::$app->cart;

    $model = Product::findOne($id);
    if ($model) {
        $cart->put($model, 1);
        return $this->redirect(['cart-view']);
    }
    throw new NotFoundHttpException();
}
```

Also you can use cart as global application component:

```php
[
    'components' => [
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
            'cartId' => 'my_application_cart',
        ]
    ]
]
```

And use it in the following way:

```php
\Yii::$app->cart->put($cartPosition, 1);
```

In order to get number of items in the cart:

```php
$itemsCount = \Yii::$app->cart->getCount();
```

In order to get total cost of items in the cart:

```php
$total = \Yii::$app->cart->getCost();
```

If the original model that you want to use as cart position is too heavy to be stored in the session, you
can create a separate class implementing CartPositionInterface, and original model can implement
CartPositionProviderInterface:

```php
// app\models\Product.php

class Product extends ActiveRecord implements CartPositionProviderInterface
{
    public function getCartPosition()
    {
        return \Yii::createObject([
            'class' => 'app\models\ProductCartPosition',
            'id' => $this->id,
        ]);
    }
}

// app\models\ProductCartPosition.php

class ProductCartPosition extends Object implements CartPositionInterface
{
    /**
     * @var Product
     */
    protected $_product;

    public $id;

    public function getId()
    {
        return $this->id;
    }

    public function getPrice()
    {
        return $this->getProduct()->price;
    }

    /**
     * @return Product
    */
    public function getProduct()
    {
        if ($this->_product === null) {
            $this->_product = Product::findOne($this->id);
        }
        return $this->_product;
    }
}
```

This way gives us ability to create separate cart positions for the same product, that differs only on some property,
for example price or color:

```php
// app\models\ProductCartPosition.php

class ProductCartPosition extends Object implements CartPositionInterface
{
    public $id;
    public $price;
    public $color;

    //...
    public function getId()
    {
        return md5(serialize([$this->id, $this->price, $this->color]));
    }

    //...
}
```

Using discounts
---------------

Discounts are implemented as behaviors that could attached to the cart or it's positions. To use them, follow this steps:

1. Define discount class as a subclass of yz\shoppingcart\DiscountBehavior
```php
// app/components/MyDiscount.php

class MyDiscount extends DiscountBehavior
{
    /**
     * @param CostCalculationEvent $event
     */
    public function onCostCalculation($event)
    {
        // Some discount logic, for example
        $event->discountValue = 100;
    }
}
```

2. Add this behavior to the cart:

```php
$cart->attachBehavior('myDiscount', ['class' => 'app\components\MyDiscount']);
```

If discount is suitable not for the whole cart, but for the individual positions, than it is possible to attach
discount to the cart position itself:

```
$cart->getPositionById($positionId)->attachBehavior('myDiscount', ['class' => 'app\components\MyDiscount']);
```

Note, that the same behavior could be used for both cart and position classes.

3. To get total cost with discount applied:

```php
$total = \Yii::$app->cart->getCost(true);
```

4. During the calculation the following events are triggered: 
- `ShoppingCart::EVENT_COST_CALCULATION` once per calculation.
- `CartPositionInterface::EVENT_COST_CALCULATION` for each position in the cart.
 
You can also subscribe on this events to perform discount calculation:

```php
$cart->on(ShoppingCart::EVENT_COST_CALCULATION, function ($event) {
    $event->discountValue = 100;
});
```
