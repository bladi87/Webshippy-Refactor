<?php declare(strict_types=1);

namespace Tests;

use App\Model\Order;
use App\Service\OutputService;
use PHPUnit\Framework\TestCase;

class OutputServiceTest extends TestCase
{

    public function test_header_output() {
        $headers = [
            'product_id',
            'quantity',
            'priority',
            'created_at'
        ];
        $outputService = new OutputService($headers, []);
        $outputService->writeHeader();
        $this->expectOutputString("product_id          quantity            priority            created_at          
================================================================================
");
    }

    public function test_data_output() {
        $fulfillableOrders = [
            new Order(1, 2, 1, new \DateTime('2022-03-14 14:25:11')),
            new Order(2, 5, 1, new \DateTime('2022-03-14 14:25:11')),
            new Order(3, 6, 2, new \DateTime('2022-03-14 14:25:11')),
            new Order(4, 7, 3, new \DateTime('2022-03-14 14:25:11'))
        ];
        $outputService = new OutputService([], $fulfillableOrders);
        $outputService->writeData();
        $this->expectOutputString("1                   2                   low                 2022-03-14 14:25:11 
2                   5                   low                 2022-03-14 14:25:11 
3                   6                   medium              2022-03-14 14:25:11 
4                   7                   high                2022-03-14 14:25:11 
");
    }

}