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
    $cart = new ShoppingCart();

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

If your original model that you want to use as cart position is too heavy to be stored in the session, you
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
        ];
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
