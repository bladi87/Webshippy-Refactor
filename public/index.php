<?php declare(strict_types=1);

use App\Service\ArgumentHandlerService;
use App\Service\OrderHandlerService;

require_once __DIR__ . '/../vendor/autoload.php';

$argumentHandlerService = new ArgumentHandlerService($argc, $argv);
if ($argumentHandlerService->isValid()) {
    $stock = $argumentHandlerService->getStock();
    $fileReaderService = new OrderHandlerService();
    $fileReaderService->sortOrders();
    $fulfillableOrders = $fileReaderService->getFullfillableOrders($stock);

} else {
    echo $argumentHandlerService->getMessage();
}