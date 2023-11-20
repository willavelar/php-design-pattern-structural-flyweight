## Flyweight

Flyweight is a structural design pattern that lets you fit more objects into the available amount of RAM by sharing common parts of state between multiple objects instead of keeping all of the data in each object.

-----

we need to create ten thousand orders for a customer

### The problem

If we do it this way, we are wasting a lot of memory, repeating data, which is always from the same client, which we don't need

```php
<?php
class Budget 
{
    public float $value;
    public int $items;
}
```
```php
<?php
class Order
{
    public string $clientName;
    public \DateTimeInterface $endDate;
    public Budget $budget;
}
```
```php
<?php
$orders = [];

for ($i = 0; $i < 10000; $i++) {

    $order = new Order();
    $order->clientName = md5((string) rand(1 , 100000));
    $order->budget = new Budget();
    $order->endDate = new DateTimeImmutable();

    $orders[] = $order;

}

echo memory_get_peak_usage();
```

### The solution

Now, using the Flyweight pattern, we get data that doesn't change, and we don't need to recreate it every time, thus making the whole abstraction much faster

```php
<?php
class OrderFlyweight
{
    public string $clientName;
    public \DateTimeInterface $endDate;
}
```
```php
<?php
class Order
{
    public OrderFlyweight $orderFlyweight;
    public Budget $budget;
}
```
```php
<?php
$orders = [];

$orderFlyweight = new OrderFlyweight();
$orderFlyweight->endDate = new DateTimeImmutable();
$orderFlyweight->clientName = md5((string) rand(1 , 100000));

for ($i = 0; $i < 10000; $i++) {

    $order = new Order();
    $order->orderFlyweight = $orderFlyweight;
    $order->budget = new Budget();

    $orders[] = $order;

}

echo memory_get_peak_usage();
```


-----

### Installation for test

![PHP Version Support](https://img.shields.io/badge/php-7.4%2B-brightgreen.svg?style=flat-square) ![Composer Version Support](https://img.shields.io/badge/composer-2.2.9%2B-brightgreen.svg?style=flat-square)

```bash
composer install
```

```bash
php wrong/test.php
php right/test.php
```