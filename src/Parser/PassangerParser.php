<?php
namespace NagoyaPHP\Parser;

/**
 * 乗客パーサー
 */
interface PassangerParser
{
    /**
     * 乗客リストを取得する
     *
     * @param string $str
     *
     * @return Passanger[]
     */
    public function parsePassagnerList(string $str): array;
}