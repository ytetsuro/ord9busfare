<?php
namespace Bus\Entity\Price;
use Bus\Entity\Entity;

/**
 * 通常料金クラス
 */
abstract class Price {

    /**
     * 記号
     *
     * @var string
     */
    protected $identifier;

    /**
     * 金額
     *
     * @var float
     */
    protected $price;

    public function __construct(float $price)
    {
        assert(isset($this->identifier));
        $this->price = $price;
    }

    /**
     * 金額を取得する
     *
     * @return float
     */
    abstract public function get(): float;

    /**
     * 料金記号を返す
     *
     * @return  string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}
