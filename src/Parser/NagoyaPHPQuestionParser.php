<?php
namespace NagoyaPHP\Parser;

use NagoyaPHP\Entity\Passenger;
use NagoyaPHP\Enum\AgeType;
use NagoyaPHP\Enum\PriceType;
use RuntimeException;

/**
 * Nagoya.php #12用のパーサー
 */
class NagoyaPHPQuestionParser implements FareParser, PassengerParser
{
    /**
     * 金額をパースする
     *
     * @param string $str
     *
     * @return float
     */
    public function parseFare(string $str) : float
    {
        assert(strpos($str, ':') !== false);

        return (float) explode(':', $str)[0];
    }

    /**
     * 乗客リストをパースする
     *
     * @param string $str
     *
     * @return PassengerParser[]
     */
    public function parsePassagnerList(string $str) : array
    {
        assert(strpos($str, ':') !== false);
        $passenger_chars = explode(':', $str, 2)[1];
        $sources = explode(',', $passenger_chars);

        $result = [];
        foreach ($sources as $source) {
            assert(strlen($source) === 2);
            $result[] = new Passenger(
                $this->getAgeTypeByString($source[0]),
                $this->getPriceTypeByString($source[1])
            );
        }

        return $result;
    }

    /**
     * 文字列から年齢区分を取得する
     *
     * @param string $age_type_str
     *
     * @return AgeType
     */
    public function getAgeTypeByString(string $age_type_str) : AgeType
    {
        // 今回はEnumの値と入力値が紐づくのでマップは作成しない
        foreach (AgeType::values() as $age_type) {
            if ($age_type->valueOf() === $age_type_str) {
                return $age_type;
            }
        }

        throw new RuntimeException('未定義の年齢区分が指定されています。:' . $age_type_str);
    }

    /**
     * 文字列から料金区分を取得する
     *
     * @param string $price_str
     *
     * @return PriceType
     */
    public function getPriceTypeByString(string $price_str) : PriceType
    {
        // 今回はEnumの値と入力値が紐づくのでマップは作成しない
        foreach (PriceType::values() as $price) {
            if ($price->valueOf() === $price_str) {
                return $price;
            }
        }

        throw new RuntimeException('未定義の料金区分が指定されています。:' . $price_str);
    }
}
