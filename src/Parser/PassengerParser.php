<?php
namespace NagoyaPHP\Parser;

/**
 * 乗客パーサー
 */
interface PassengerParser
{
    /**
     * 乗客リストを取得する
     *
     * @param string $str
     *
     * @return array Passenger[]
     */
    public function parsePassagnerList(string $str) : array;
}
