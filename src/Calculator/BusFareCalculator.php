<?php
namespace NagoyaPHP\Calculator;

use NagoyaPHP\Entity\Passanger;
use NagoyaPHP\Entity\PassangerCollection;
use NagoyaPHP\Enum\AgeType;
use SplObjectStorage;

/**
 * バスの運賃計算機
 */
class BusFareCalculator
{
    /**
     * @var PassangerCalculateRules
     */
    private $rules;

    public function __construct(PassangerCalculateRules $rules)
    {
        $this->rules = $rules;
    }

    /**
     * 計算する
     *
     * @param float               $fare
     * @param PassangerCollection $collection
     *
     * @return float
     */
    public function calculate(float $fare, PassangerCollection $collection) : float
    {
        $total_fare = 0;
        $passanger_bill_list = new SplObjectStorage();

        foreach ($collection as $passanger) {
            $passanger_bill_list[$passanger] = $this->getDiscountedFare($fare, $passanger);
        }
        $this->setFreeInfant($passanger_bill_list, $collection);

        // foreachは必ずvalueがobjectになる
        // https://bugs.php.net/bug.php?id=49967
        foreach ($passanger_bill_list as $passanger) {
            $total_fare += $passanger_bill_list[$passanger];
        }

        return $total_fare;
    }

    /**
     * 割引済みの運賃を取得する
     *
     * @param float     $fare
     * @param Passanger $passanger
     *
     * @return float
     */
    public function getDiscountedFare(float $fare, Passanger $passanger) : float
    {
        $age_discount = $this->rules->getFunction($passanger->ageType);
        $price_discount = $this->rules->getFunction($passanger->price);

        return $price_discount($age_discount($fare));
    }

    /**
     * 無料幼児を設定する
     *
     * @param SplObjectStorage    $passanger_bill_list
     * @param PassangerCollection $collection
     */
    private function setFreeInfant(SplObjectStorage $passanger_bill_list, PassangerCollection $collection)
    {
        $infant_freeable_count = $this->getInfrantFreeableCount($collection);
        $infant_collection = $collection->getByAgeType(AgeType::INFANT());
        $infant_collection->orderBy(function ($a, $b) use ($passanger_bill_list) {
            return $passanger_bill_list[$b] <=> $passanger_bill_list[$a];
        });

        foreach ($infant_collection as $infant) {
            if (--$infant_freeable_count < 0) {
                break;
            }
            $passanger_bill_list[$infant] = 0;
        }
    }

    /**
     * 無料にできる幼児の数を取得する
     *
     * @param PassangerCollection $collection
     *
     * @return int
     */
    private function getInfrantFreeableCount(PassangerCollection $collection) : int
    {
        return $collection->getByAgeType(AgeType::ADULT())->length() * 2;
    }
}
