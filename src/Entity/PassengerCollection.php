<?php
namespace NagoyaPHP\Entity;

use IteratorAggregate;
use NagoyaPHP\Enum\AgeType;

/**
 * 乗客の集合クラス
 */
class PassengerCollection implements IteratorAggregate
{
    /**
     * 乗客リスト
     *
     * @var Passenger[]
     */
    private $collection = [];

    public function __construct(array $collection)
    {
        assert(count($collection) === count(array_filter($collection, function ($row) {
            return $row instanceof Passenger;
        })));

        $this->collection = $collection;
    }

    /**
     * ソートする
     *
     * @param callable $func
     */
    public function orderBy(callable $func)
    {
        usort($this->collection, $func);
    }

    /**
     * 年齢区分からリストを取得する
     *
     * @param AgeType $age_type
     *
     * @return PassengerCollection
     */
    public function getByAgeType(AgeType $age_type)
    {
        return new self(array_filter(
            $this->collection,
            function (Passenger $row) use ($age_type) {
                return $row->ageTypeIs($age_type);
            }
        ));
    }

    /**
     * リストの数を取得する
     *
     * @return int
     */
    public function length() : int
    {
        return count($this->collection);
    }

    public function getIterator()
    {
        foreach ($this->collection as $passenger) {
            yield $passenger;
        }
    }
}
