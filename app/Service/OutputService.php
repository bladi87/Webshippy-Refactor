<?php

namespace App\Service;

use App\Model\Order;

class OutputService
{
    const STR_PAD = 20;
    private array $headers;
    private array $data;

    /**
     * @param array $headers
     * @param array $data
     */
    public function __construct(array $headers, array $data)
    {
        $this->headers = $headers;
        $this->data = $data;
    }

    public function writeHeader() {
        foreach ($this->headers as $h) {
            echo str_pad($h, self::STR_PAD);
        }
        echo "\n";
        foreach ($this->headers as $h) {
            echo str_repeat('=', self::STR_PAD);
        }
        echo "\n";
    }

    public function writeData() {
        /** @var Order $order */
        foreach ($this->data as $order) {
            echo str_pad($order->getProductId(), self::STR_PAD);
            echo str_pad($order->getQuantity(), self::STR_PAD);
            echo str_pad($order->getPriorityAsText(), self::STR_PAD);
            echo str_pad($order->getCreatedAt()->format('Y-m-d H:i:s'), self::STR_PAD);
            echo "\n";
        }
    }
}