<?php
namespace NagoyaPHP\Entity;

use IteratorAggregate;
use NagoyaPHP\Enum\Age;

/**
 * 乗客の集合クラス
 */
class PassangerCollection implements IteratorAggregate
{
    /**
     * 乗客リスト
     *
     * @var Passanger[]
     */
    private $collection = [];

    public function __construct(array $collection)
    {
        assert(count($collection) === count(array_filter($collection, function ($row) {
            return $row instanceof Passanger;
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
     * @param Age $age
     *
     * @return PassangerCollection
     */
    public function getByAge(Age $age)
    {
        return new self(array_filter(
            $this->collection,
            function (Passanger $row) use ($age) {
                return $row->ageIs($age);
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
        foreach ($this->collection as $passanger) {
            yield $passanger;
        }
    }
}
