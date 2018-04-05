<?php
namespace Bus\Entity\Price;
use Bus\Entity\Price\Price;

/**
 * 通常料金クラス
 */
class Normal extends Price {

    /**
     * 記号
     *
     * @var string
     */
    protected $identifier = 'n';

    /**
     * 金額を取得する
     *
     * @return float
     */
    public function get(): float
    {
        return $this->price;
    }
}
