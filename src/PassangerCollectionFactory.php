<?php
namespace NagoyaPHP;

use NagoyaPHP\Parser\PassangerParser;
use NagoyaPHP\Entity\PassangerCollection;

/**
 * 乗客の集合クラス
 */
class PassangerCollectionFactory
{
    private $praser;

    public function __construct(PassangerParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * 年齢区分からリストを取得する
     *
     * @param Age $age
     *
     * @return PassangerCollection
     */
    public function createByString(string $str)
    {
        $passanger_list = $this->parser->parsePassagnerList($str);
        return new PassangerCollection($passanger_list);
    }
}
