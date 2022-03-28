<?php declare(strict_types=1);

namespace App\Service;

class ArgumentHandlerService
{
    const ERROR_PARAMETER_NUMBER = "Ambiguous number of parameters!";
    const ERROR_INVALID_JSON = "Invalid json!";
    const ERROR_INVALID_DATA = "Stock data must contain numbers only!";

    private int $argumentNumber;
    private array $argumentList;
    private string $message;
    private bool $valid = false;
    private array $stock;

    /**
     * @param int $argumentNumber
     * @param array $argumentList
     */
    public function __construct(int $argumentNumber, array $argumentList)
    {
        $this->argumentNumber = $argumentNumber;
        $this->argumentList = $argumentList;
        $this->message = "";
        $this->stock = [];
        $this->validateArguments();
    }

    private function validateArguments() {
        $this->valid =
            $this->isNumberOfArgumentsValid() &&
            $this->isValidJson() &&
            $this->isValidStockData()
        ;
    }

    public function isValid(): bool
    {
        return $this->valid;
    }

    private function isNumberOfArgumentsValid(): bool
    {
        if ($this->argumentNumber == 2) {
            return true;
        }
        $this->message = self::ERROR_PARAMETER_NUMBER;
        return false;
    }

    private function isValidJson(): bool
    {
        $data = json_decode($this->argumentList[1], true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $this->stock = $data;
            return true;
        }
        $this->message = self::ERROR_INVALID_JSON;
        return false;
    }

    private function isValidStockData(): bool
    {
        foreach ($this->stock as $key => $value) {
            if (!is_numeric($key) || !is_numeric($value)) {
                $this->message = self::ERROR_INVALID_DATA;
                return false;
            }
        }
        return true;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getStock(): array
    {
        return $this->valid ? $this->stock : [];
    }


}