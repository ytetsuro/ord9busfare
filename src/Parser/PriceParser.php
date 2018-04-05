<?php
namespace NagoyaPHP\Parser;

/**
 * 金額パーサー
 */
interface PriceParser
{
    /**
     * 金額をパースする
     *
     * @param string $str
     *
     * @return float
     */
    public function parsePrice(string $str) : float;
}
