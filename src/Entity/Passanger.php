<?php
namespace NagoyaPHP\Entity;

use NagoyaPHP\Enum\AgeType;
use NagoyaPHP\Enum\Price;

/**
 * 乗客クラス
 *
 * @property AgeType $ageType
 * @property Price $price
 */
class Passanger extends Entity
{
    /**
     * 年齢区分
     *
     * @var AgeType
     */
    protected $ageType;

    /**
     * 料金区分
     *
     * @var Price
     */
    protected $price;

    public function __construct(AgeType $age_type, Price $price)
    {
        parent::__construct(['ageType' => $age_type, 'price' => $price]);
    }

    /**
     * 年齢区分が一致するかを調べる
     *
     * @param AgeType $age_type
     *
     * @return bool
     */
    public function ageTypeIs(AgeType $age_type)
    {
        return $age_type === $this->ageType;
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
