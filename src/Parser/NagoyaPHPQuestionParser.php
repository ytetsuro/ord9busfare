<?php
namespace NagoyaPHP\Parser;

use NagoyaPHP\Parser\PriceParser;
use NagoyaPHP\Parser\PassangerParser;
use NagoyaPHP\Enum\Price;
use NagoyaPHP\Enum\Age;
use NagoyaPHP\Entity\Passanger;
use RunTimeException;

/**
 * Nagoya.php #12用のパーサー
 */
class NagoyaPHPQuestionParser implements PriceParser,PassangerParser
{
    /**
     * 金額をパースする
     *
     * @param string $str
     *
     * @return float
     */
    public function parsePrice(string $str): float
    {
        assert(strpos($str, ':') !== FALSE);
        return (float)explode(':', $str)[0];
    }

    /**
     * 乗客リストをパースする
     *
     * @param string $str
     *
     * @return PassangerParser[]
     */
    public function parsePassagnerList(string $str): array
    {
        assert(strpos($str, ':') !== FALSE);
        $passanger_chars = explode(':', $str, 2)[1];
        $sources = explode(',', $passanger_chars);

        $result = [];
        foreach ($sources as $source) {
            assert(strlen($source) === 2);
            $result[] = new Passanger(
                $this->getAgeByString($source[0]),
                $this->getPriceByString($source[1])
            );
        }

        return $result;
    }

    /**
     * 文字列から年齢区分を取得する
     *
     * @param string $age_str
     *
     * @return  Age
     */
    public function getAgeByString(string $age_str): Age
    {
        // 今回はEnumの値と入力値が紐づくのでマップは作成しない
        foreach (Age::values() as $age) {
            if ($age->valueOf() === $age_str) {
                return $age;
            }
        }

        throw new RunTimeException('未定義の年齢区分が指定されています。:'.$age_str);
    }

    /**
     * 文字列から料金区分を取得する
     *
     * @param string $price_str
     *
     * @return Price
     */
    public function getPriceByString(string $price_str): Price
    {
        // 今回はEnumの値と入力値が紐づくのでマップは作成しない
        foreach (Price::values() as $price) {
            if ($price->valueOf() === $price_str) {
                return $price;
            }
        }

        throw new RunTimeException('未定義の料金区分が指定されています。:'.$price_str);
    }
}