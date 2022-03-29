<?php declare(strict_types=1);

namespace Tests;

use App\Model\Order;
use App\Service\OrderHandlerService;
use PHPUnit\Framework\TestCase;

class OrderHandlerServiceTest extends TestCase
{

    public function test_order_service_returns_orders_as_array() {
        $orderHandler = new OrderHandlerService();
        $this->assertIsArray($orderHandler->getOrders());
    }

    public function test_orders_array_size() {
        $orderHandler = new OrderHandlerService();
        $this->assertEquals(10, sizeof($orderHandler->getOrders()));
    }

    public function test_orders_array_contains_order_object() {
        $orderHandler = new OrderHandlerService();
        $orders = $orderHandler->getOrders();
        foreach ($orders as $order) {
            $this->assertInstanceOf(Order::class, $order);
        }
    }

    public function test_orders_before_sorting() {
        $orderHandler = new OrderHandlerService();
        $orders = $orderHandler->getOrders();
        /** @var Order $order */
        $order = $orders[0];
        $this->assertEquals(new Order(1,2,3, new \DateTime("2021-03-25 14:51:47")), $order);
    }

    public function test_orders_after_sorting() {
        $orderHandler = new OrderHandlerService();
        $orderHandler->sortOrders();
        $orders = $orderHandler->getOrders();
        /** @var Order $order */
        $order = $orders[0];
        $this->assertEquals(new Order(3,5,3, new \DateTime("2021-03-23 05:01:29")), $order);
    }

    public function test_headers_is_array() {
        $orderHandler = new OrderHandlerService();
        $this->assertIsArray($orderHandler->getHeaders());
    }

    public function test_headers_contains_four_elements() {
        $orderHandler = new OrderHandlerService();
        $this->assertEquals(4, sizeof($orderHandler->getHeaders()));
    }

    public function test_headers_check_content() {
        $orderHandler = new OrderHandlerService();
        $this->assertEquals(
            [
                'product_id',
                'quantity',
                'priority',
                'created_at'
            ], $orderHandler->getHeaders());
    }

    public function test_fulfillable_orders_is_array() {
        $orderHandler = new OrderHandlerService();
        $this->assertIsArray($orderHandler->getFulfillableOrders(
            [1 => 8, 2 => 4, 3 => 5]
        ));
    }

    public function test_fulfillable_orders_is_array_if_stock_is_empty() {
        $orderHandler = new OrderHandlerService();
        $this->assertIsArray($orderHandler->getFulfillableOrders(
            []
        ));
    }

    public function test_fulfillable_orders_1() {
        $orderHandler = new OrderHandlerService();
        $this->assertEquals(4, sizeof($orderHandler->getFulfillableOrders(
            [1 => 4, 2 => 2, 3 => 0]
        )));
    }

    public function test_fulfillable_orders_2() {
        $orderHandler = new OrderHandlerService();
        $this->assertEquals(8, sizeof($orderHandler->getFulfillableOrders([1 => 6, 2 => 4, 3 => 2])));
    }

    public function test_fulfillable_orders_3() {
        $orderHandler = new OrderHandlerService();
        $this->assertEquals(1, sizeof($orderHandler->getFulfillableOrders(
            [1 => 1]
        )));
    }
}