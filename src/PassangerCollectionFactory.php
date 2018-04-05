<?php
namespace NagoyaPHP;

use NagoyaPHP\Entity\PassangerCollection;
use NagoyaPHP\Parser\PassangerParser;

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
     * 文字列から乗客の集合クラスを取得する
     *
     * @param string $str
     *
     * @return PassangerCollection
     */
    public function createByString(string $str): PassangerCollection
    {
        $passanger_list = $this->parser->parsePassagnerList($str);

        return new PassangerCollection($passanger_list);
    }
}
