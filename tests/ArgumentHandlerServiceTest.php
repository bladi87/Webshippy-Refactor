<?php declare(strict_types=1);

namespace Tests;

use App\Service\ArgumentHandlerService;
use PHPUnit\Framework\TestCase;

class ArgumentHandlerServiceTest extends TestCase
{
    const VALID_JSON = '{"1":8,"2":4,"3":5}';
    const VALID_JSON_WITH_WRONG_DATA = '{"1":8,"2":4,"3":"five"}';

    public function test_wrong_number_of_arguments() {
        $argumentHandler = new ArgumentHandlerService(3, ["index.php", self::VALID_JSON]);
        $this->assertFalse($argumentHandler->isValid());
    }

    public function test_wrong_number_of_arguments_message() {
        $argumentHandler = new ArgumentHandlerService(1, ["index.php", self::VALID_JSON]);
        $this->assertEquals("Ambiguous number of parameters!", $argumentHandler->getMessage());
    }

    public function test_good_number_of_arguments_and_valid_json() {
        $argumentHandler = new ArgumentHandlerService(2, ["index.php", self::VALID_JSON]);
        $this->assertTrue($argumentHandler->isValid());
    }

    public function test_good_number_of_arguments_and_valid_json_message_is_empty() {
        $argumentHandler = new ArgumentHandlerService(2, ["index.php", self::VALID_JSON]);
        $this->assertSame("", $argumentHandler->getMessage());
    }

    public function test_input_is_not_valid_json() {
        $argumentHandler = new ArgumentHandlerService(2, ["index.php", "some text"]);
        $this->assertFalse($argumentHandler->isValid());
    }

    public function test_input_is_not_valid_json_error_message() {
        $argumentHandler = new ArgumentHandlerService(2, ["index.php", "some text"]);
        $this->assertSame("Invalid json!", $argumentHandler->getMessage());
    }

    public function test_input_json_is_valid_but_contains_wrong_data() {
        $argumentHandler = new ArgumentHandlerService(2, ["index.php", self::VALID_JSON_WITH_WRONG_DATA]);
        $this->assertFalse($argumentHandler->isValid());
    }

    public function test_input_json_is_valid_but_contains_wrong_data_message() {
        $argumentHandler = new ArgumentHandlerService(2, ["index.php", self::VALID_JSON_WITH_WRONG_DATA]);
        $this->assertSame("Stock data must contain numbers only!", $argumentHandler->getMessage());
    }

    public function test_input_valid_get_stock() {
        $argumentHandler = new ArgumentHandlerService(2, ["index.php", self::VALID_JSON]);
        $this->assertSame(
            [1 => 8, 2 => 4, 3 => 5],
            $argumentHandler->getStock()
        );
    }

    public function test_input_wrong_get_stock_returns_empty_array() {
        $argumentHandler = new ArgumentHandlerService(2, ["index.php", self::VALID_JSON_WITH_WRONG_DATA]);
        $this->assertSame(
            [],
            $argumentHandler->getStock()
        );
    }

}