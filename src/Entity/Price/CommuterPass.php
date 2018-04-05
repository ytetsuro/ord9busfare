<?php
namespace Bus\Entity\Price;
use Bus\Entity\Price\Price;

/**
 *  定期券料金クラス
 */
class CommuterPass extends Price {

    /**
     * 記号
     *
     * @var string
     */
    protected $identifier = 'p';

    /**
     * 金額を取得する
     *
     * @return float
     */
    public function get(): float
    {
        return 0;
    }
}
