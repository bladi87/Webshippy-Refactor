<?php declare(strict_types=1);

namespace App\Service;

use App\Model\Order;
use JetBrains\PhpStorm\Pure;
use function PHPUnit\Framework\isEmpty;

class OrderHandlerService
{
    const CSV_PATH = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'orders.csv';

    /**
     * @var Order[]
     */
    private array $orders = [];
    /**
     * @var string[]
     */
    private array $headers = [];

    public function __construct()
    {
        $csv = array_map('str_getcsv', file(self::CSV_PATH));
        foreach ($csv as $key => $item) {
            if ($key == 0) {
                $this->headers = $item;
            } else {
                $this->orders[] = new Order(
                    (int)$item[0],
                    (int)$item[1],
                    (int)$item[2],
                    new \DateTime($item[3])
                );
            }
        }
    }

    /**
     * @return Order[]
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @return string[]
     */
    public function getHeaders(): mixed
    {
        return $this->headers;
    }

    public function sortOrders()
    {
        usort($this->orders, function (Order $a, Order $b) {
            $pc = -1 * ($a->getPriority() <=> $b->getPriority());
            return $pc == 0 ? $a->getCreatedAt() <=> $b->getCreatedAt() : $pc;
        });
    }

    public function getFulfillableOrders(array $stock): array
    {
        $fulfillableOrders = [];
        if (empty($stock)) {
            return $fulfillableOrders;
        }
        /** @var Order $order */
        foreach ($this->orders as $order) {
            if (array_key_exists($order->getProductId(), $stock) && $stock[$order->getProductId()] >= $order->getQuantity()) {
                $fulfillableOrders[] = $order;
            }
        }
        return $fulfillableOrders;
    }

}