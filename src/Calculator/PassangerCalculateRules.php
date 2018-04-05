<?php
namespace NagoyaPHP\Calculator;

use NagoyaPHP\Enum\Age;
use NagoyaPHP\Enum\Enum;
use NagoyaPHP\Enum\Price;
use SplObjectStorage;

class PassangerCalculateRules
{
    /**
     * 計算ルールのリスト
     *
     * @var SplObjectStorage [Enum => Callable $value]
     */
    private $rules;

    public function __construct()
    {
        $calculator = new PassangerFareCalculator();
        $this->rules = new SplObjectStorage();
        $this->rules[Age::CHILD()] = [$calculator, 'halfAndCeilTenPlace'];
        $this->rules[Age::INFANT()] = [$calculator, 'halfAndCeilTenPlace'];
        $this->rules[Price::WELFARE()] = [$calculator, 'halfAndCeilTenPlace'];
        $this->rules[Price::HAS_PASS()] = [$calculator, 'zero'];
    }

    /**
     * 計算処理を取得する
     *
     * @param Enum $enum
     *
     * @return callable
     */
    public function getFunction(Enum $enum) : callable
    {
        $result = function ($price) {
            return $price;
        };

        if (isset($this->rules[$enum])) {
            $result = $this->rules[$enum];
        }

        return $result;
    }
}
