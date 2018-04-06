<?php
namespace NagoyaPHP\Calculator;

use NagoyaPHP\Entity\Passenger;
use NagoyaPHP\Entity\PassengerCollection;
use NagoyaPHP\Enum\AgeType;
use SplObjectStorage;

/**
 * バスの運賃計算機
 */
class BusFareCalculator
{
    /**
     * @var PassengerCalculateRules
     */
    private $rules;

    public function __construct(PassengerCalculateRules $rules)
    {
        $this->rules = $rules;
    }

    /**
     * 計算する
     *
     * @param float               $base_fare
     * @param PassengerCollection $collection
     *
     * @return float
     */
    public function calculate(float $base_fare, PassengerCollection $collection) : float
    {
        $total_fare = 0;
        $passenger_bill_list = new SplObjectStorage();

        foreach ($collection as $passenger) {
            $passenger_bill_list[$passenger] = $this->getDiscountedFare($base_fare, $passenger);
        }
        $this->setFreeInfant($passenger_bill_list, $collection);

        // foreachは必ずvalueがobjectになる
        // https://bugs.php.net/bug.php?id=49967
        foreach ($passenger_bill_list as $passenger) {
            $total_fare += $passenger_bill_list[$passenger];
        }

        return $total_fare;
    }

    /**
     * 割引済みの運賃を取得する
     *
     * @param float     $fare
     * @param Passenger $passenger
     *
     * @return float
     */
    public function getDiscountedFare(float $fare, Passenger $passenger) : float
    {
        $age_discount = $this->rules->getFunction($passenger->ageType);
        $price_discount = $this->rules->getFunction($passenger->priceType);

        return $price_discount($age_discount($fare));
    }

    /**
     * 無料幼児を設定する
     *
     * @param SplObjectStorage    $passenger_bill_list
     * @param PassengerCollection $collection
     */
    private function setFreeInfant(SplObjectStorage $passenger_bill_list, PassengerCollection $collection)
    {
        $infant_freeable_count = $this->getInfrantFreeableCount($collection);
        $infant_collection = $collection->getByAgeType(AgeType::INFANT());
        $infant_collection->orderBy(function ($a, $b) use ($passenger_bill_list) {
            return $passenger_bill_list[$b] <=> $passenger_bill_list[$a];
        });

        foreach ($infant_collection as $infant) {
            if (--$infant_freeable_count < 0) {
                break;
            }
            $passenger_bill_list[$infant] = 0;
        }
    }

    /**
     * 無料にできる幼児の数を取得する
     *
     * @param PassengerCollection $collection
     *
     * @return int
     */
    private function getInfrantFreeableCount(PassengerCollection $collection) : int
    {
        return $collection->getByAgeType(AgeType::ADULT())->length() * 2;
    }
}
