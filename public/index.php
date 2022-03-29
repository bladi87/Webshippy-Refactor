<?php declare(strict_types=1);

use App\Service\ArgumentHandlerService;
use App\Service\OrderHandlerService;
use App\Service\OutputService;

require_once __DIR__ . '/../vendor/autoload.php';

$argumentHandlerService = new ArgumentHandlerService($argc, $argv);
if ($argumentHandlerService->isValid()) {
    $stock = $argumentHandlerService->getStock();
    $fileReaderService = new OrderHandlerService();
    $fileReaderService->sortOrders();
    $outputService = new OutputService($fileReaderService->getHeaders(), $fileReaderService->getFulfillableOrders($argumentHandlerService->getStock()));
    $outputService->writeHeader();
    $outputService->writeData();
} else {
    echo $argumentHandlerService->getMessage();
}