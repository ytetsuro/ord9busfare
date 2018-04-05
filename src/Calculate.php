<?php
namespace Bus;
use Bus\Entity\Age\Infant;
use Bus\Entity\Age\Adult;

class Calculate {

    /**
     * 合計料金を計算する
     *
     * @param array $age_list
     *
     * @return float
     */
    public function calcTotalPrice(array $age_list): float
    {
        $this->setInfantFree($age_list);

        $result = 0;
        foreach ($age_list as $age) {
            $result += $age->getPrice();
        }

        return $result;
    }

    /**
     * 無料の幼児の設定を行う
     *
     * @param array $age_list
     *
     * @return void
     */
    private function setInfantFree(array $age_list)
    {
        $adult_count = $this->getAdultCount($age_list);
        $freeable_infant_count = $adult_count*2;
        $infant_list = array_filter($age_list, function($row){
            return $row instanceof Infant;
        });
        usort($infant_list, function($a, $b) {
            if ($b->getPrice() === $a->getPrice()) {
                return 0;
            }

            return ($b->getPrice() < $a->getPrice()) ? -1 : 1 ;
        });

        // @todo: ここ、循環的複雑度が高そうなのでどうにかしたい。
        foreach ( $infant_list as $infant) {
            if (--$freeable_infant_count < 0) {
                break;
            }

            $infant->setFreePrice();
        }
    }

    /**
     * 大人の数を取得する
     *
     * @param array $age_list
     *
     * @return int
     */
    private function getAdultCount(array $age_list): int
    {
        return count(array_filter($age_list, function($row){
           return $row instanceof Adult;
        }));
    }
}
