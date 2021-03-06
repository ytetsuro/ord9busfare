<?php
namespace NagoyaPHP\Calculator;

use NagoyaPHP\Enum\AgeType;
use NagoyaPHP\Enum\Enum;
use NagoyaPHP\Enum\PriceType;
use SplObjectStorage;

class PassengerCalculateRules
{
    /**
     * 計算ルールのリスト
     *
     * @var SplObjectStorage [Enum => Callable]
     */
    private $rules;

    public function __construct()
    {
        $calculator = new PassengerFareCalculator();
        $this->rules = new SplObjectStorage();
        $this->rules[AgeType::CHILD()] = [$calculator, 'halfAndCeilTenPlace'];
        $this->rules[AgeType::INFANT()] = [$calculator, 'halfAndCeilTenPlace'];
        $this->rules[PriceType::WELFARE()] = [$calculator, 'halfAndCeilTenPlace'];
        $this->rules[PriceType::HAS_PASS()] = [$calculator, 'zero'];
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
