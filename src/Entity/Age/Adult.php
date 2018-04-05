<?php
namespace Bus\Entity\Age;

/**
 * 大人クラス
 */
class Adult extends Age
{
    /**
     * 記号
     *
     * @var string
     */
    protected $identifier = 'A';

    /**
     * 料金を取得する
     *
     * @param float $price
     *
     * @return float
     */
    public function calcPrice(float $price): float
    {
        return $price;
    }
}
