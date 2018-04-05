<?php
namespace Bus\Entity\Price;
use Bus\Entity\Price\Price;

/**
 *  福祉料金クラス
 */
class Welfare extends Price {

    /**
     * 記号
     *
     * @var string
     */
    protected $identifier = 'w';

    /**
     * 金額を取得する
     *
     * @return float
     */
    public function get(): float
    {
        return ceil(($this->price/2)/10)*10;
    }
}
