<?php
namespace NagoyaPHP\Calculator;

/**
 * 乗客の運賃計算クラス
 */
class PassengerFareCalculator extends Calculator
{
    /**
     * 2で割って10の位を切り捨てた値を取得する
     *
     * @param float $price
     *
     * @return float
     */
    public function halfAndCeilTenPlace(float $price) : float
    {
        return $this->halfAndCeil($price, 1);
    }

    /**
     * 0を取得する
     *
     * @return float
     */
    public function zero() : float
    {
        return 0;
    }
}
