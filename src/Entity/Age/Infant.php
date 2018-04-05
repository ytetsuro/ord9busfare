<?php
namespace Bus\Entity\Age;

/**
 * 幼児クラス
 */
class Infant extends Age
{
    /**
     * 記号
     *
     * @var string
     */
    protected $identifier = 'I';

    /**
     * 無料扱いにする
     *
     * @var bool
     */
    protected $is_free = false;

    public function setFreePrice()
    {
        $this->is_free = true;
    }

    /**
     * 料金を取得する
     *
     * @param float $price
     *
     * @return float
     */
    public function calcPrice(float $price): float
    {
        if ($this->is_free) {
            return 0;
        }

        return ceil(($price/2)/10)*10;
    }
}
