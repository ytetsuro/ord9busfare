<?php
namespace NagoyaPHP;

use NagoyaPHP\Entity\PassengerCollection;
use NagoyaPHP\Parser\PassengerParser;

/**
 * 乗客の集合クラスのファクトリ
 */
class PassengerCollectionFactory
{
    /**
     * @var PassengerParser
     */
    private $parser;

    public function __construct(PassengerParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * 文字列から乗客の集合クラスを取得する
     *
     * @param string $str
     *
     * @return PassengerCollection
     */
    public function createByString(string $str) : PassengerCollection
    {
        $passenger_list = $this->parser->parsePassagnerList($str);

        return new PassengerCollection($passenger_list);
    }
}
