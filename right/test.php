<?php

use DesignPattern\Right\Budget;
use DesignPattern\Right\Order;
use DesignPattern\Right\OrderFlyweight;

require "vendor/autoload.php";

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