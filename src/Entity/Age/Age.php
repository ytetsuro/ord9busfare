<?php
namespace Bus\Entity\Age;
use Bus\Entity\Price\Price;

/**
 * 年齢区分クラス
 */
abstract class Age {

    /**
     * 記号
     *
     * @var string
     */
    protected $identifier;

    /**
     * 利用金
     *
     * @var Price
     */
    protected $price;

    public function __construct(Price $price)
    {
        assert(isset($this->identifier));
        $this->price = $price;
    }

    /**
     * 料金記号を返す
     *
     * @return  string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * 利用金を返す
     *
     * @return float
     */
    public function getPrice(): float
    {
        $price = $this->price->get();
        if ($price === 0) {
            return $price;
        }

        return $this->calcPrice($price);
    }

    abstract public function calcPrice(float $price): float;
}
