<?php
namespace NagoyaPHP\Entity;

use NagoyaPHP\Enum\AgeType;
use NagoyaPHP\Enum\PriceType;

/**
 * 乗客クラス
 *
 * @property AgeType $ageType
 * @property PriceType $priceType
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
     * @var PriceType
     */
    protected $priceType;

    public function __construct(AgeType $age_type, PriceType $price_type)
    {
        parent::__construct(['ageType' => $age_type, 'priceType' => $price_type]);
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
     * @param PriceType $price_type
     *
     * @return bool
     */
    public function priceTypeIs(PriceType $price_type)
    {
        return $price_type === $this->priceType;
    }
}
