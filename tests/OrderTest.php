<?php declare(strict_types=1);

namespace Tests;

use App\Model\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function test_order_creation() {
        $order = new Order(1,1,1, new \DateTime('2022-03-14 14:25:11'));
        $this->assertInstanceOf(Order::class, $order);
    }

    public function test_order_data() {
        $order = new Order(1,2,3, new \DateTime('2022-03-14 14:25:11'));
        $this->assertEquals(
            new Order(1,2,3, new \DateTime('2022-03-14 14:25:11')),
            $order
        );
    }

    public function test_order_priority_low() {
        $order = new Order(1,2,1, new \DateTime('2022-03-14 14:25:11'));
        $this->assertEquals("low", $order->getPriorityAsText());
    }

    public function test_order_priority_medium() {
        $order = new Order(1,2,2, new \DateTime('2022-03-14 14:25:11'));
        $this->assertEquals("medium", $order->getPriorityAsText());
    }

    public function test_order_priority_high() {
        $order = new Order(1,2,3, new \DateTime('2022-03-14 14:25:11'));
        $this->assertEquals("high", $order->getPriorityAsText());
    }

}