<?php
namespace NagoyaPHP\Entity;

use NagoyaPHP\Enum\Age;
use NagoyaPHP\Enum\Price;

/**
 * 乗客クラス
 */
class Passanger extends Entity
{
    /**
     * 年齢区分
     *
     * @var Age
     */
    protected $age;

    /**
     * 料金区分
     *
     * @var Price
     */
    protected $price;

    public function __construct(Age $age, Price $price)
    {
        $this->age = $age;
        $this->price = $price;
    }

    /**
     * 年齢区分が一致するかを調べる
     *
     * @param Age $age
     *
     * @return bool
     */
    public function ageIs(Age $age)
    {
        return $age === $this->age;
    }

    /**
     * 料金区分が一致するかを調べる
     *
     * @param Price $price
     *
     * @return bool
     */
    public function priceIs(Price $price)
    {
        return $price === $this->price;
    }
}
