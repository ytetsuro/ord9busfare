<?php
namespace NagoyaPHP\Parser;

/**
 * 金額パーサー
 */
interface FareParser
{
    /**
     * 金額をパースする
     *
     * @param string $str
     *
     * @return float
     */
    public function parseFare(string $str) : float;
}
