<?php declare(strict_types=1);

use App\Service\ArgumentHandlerService;

require_once __DIR__ . '/../vendor/autoload.php';

$argumentHandlerService = new ArgumentHandlerService($argc, $argv);
if ($argumentHandlerService->isValid()) {
    $stock = $argumentHandlerService->getStock();


} else {
    echo $argumentHandlerService->getMessage();
}