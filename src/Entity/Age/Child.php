<?php
namespace Bus\Entity\Age;

/**
 * 子供クラス
 */
class Child extends Age
{
    /**
     * 記号
     *
     * @var string
     */
    protected $identifier = 'C';

    /**
     * 料金を取得する
     *
     * @param float $price
     *
     * @return float
     */
    public function calcPrice(float $price): float
    {
        return ceil(($price/2)/10)*10;
    }
}
