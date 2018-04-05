<?php
namespace Bus;
use Bus\Entity\Age\Adult;
use Bus\Entity\Age\Age;
use Bus\Entity\Age\Child;
use Bus\Entity\Age\Infant;
use Bus\Entity\Entity;
use Bus\Entity\Price\CommuterPass;
use Bus\Entity\Price\Normal;
use Bus\Entity\Price\Price;
use Bus\Entity\Price\Welfare;

/**
 * 料金計算をパースするクラス
 */
class Parser
{
    /**
     * 年齢クラス
     *
     * @var array
     */
    private $age_class_map = [
        'A' => Adult::class,
        'C' => Child::class,
        'I' => Infant::class,
    ];

    /**
     * 利用金クラス
     *
     * @var array
     */
    private $price_class_map = [
        'n' => Normal::class,
        'p' => CommuterPass::class,
        'w' => Welfare::class,
    ];

    /**
     * 年齢リストを取得する
     * @todo: ここ、ださい。パースと生成を同時に行なっているのSRPに違反していないか不安
     *
     * @param string $input
     *
     * @return Age[]
     */
    public function parseAgeList(string $input): array
    {
        assert(strpos($input, ':') !== FALSE);
        list($base_price, $identifier_collection_str) = explode(':', $input, 2);

        $identifier_collection = array_map('trim', explode(',', $identifier_collection_str));

        $age_list = [];
        foreach ($identifier_collection as $identifier) {
            assert(strlen($identifier) === 2);

            $price = $this->createPrice($identifier[1], (float)$base_price);
            $age_list[] = $this->createAge($identifier[0], $price);
        }

        return $age_list;
    }

    /**
     * 年齢クラスを生成する
     *
     * @param string $identifier
     * @param Price $price
     *
     * @return Age
     */
    private function createAge(string $identifier, Price $price): Age
    {
        assert(isset($this->age_class_map[$identifier]));
        return new $this->age_class_map[$identifier]($price);
    }

    /**
     * 金額クラスを生成する
     *
     * @param string $identifier
     * @param float $price
     *
     * @return Price
     */
    private function createPrice(string $identifier, float $price): Price
    {
        assert(isset($this->price_class_map[$identifier]));
        return new $this->price_class_map[$identifier]($price);
    }
}
