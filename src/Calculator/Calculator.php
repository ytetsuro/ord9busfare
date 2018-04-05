<?php
namespace NagoyaPHP\Calculator;

/**
 * 計算クラス
 */
class Calculator
{
    /**
     * 2で割って切り捨てした数値を返す
     *
     * @param float $value
     * @param int   $ceil_figure_length
     *
     * @return float
     */
    public function halfAndCeil(float $value, $ceil_figure_length = 0) : float
    {
        return $this->ceil($value / 2, $ceil_figure_length);
    }

    /**
     * 切り捨てする
     *
     * @param float $value              値
     * @param int   $ceil_figure_length 割る桁数
     *
     * @return float
     */
    public function ceil(float $value, int $ceil_figure_length = 0) : float
    {
        $ceil_figure = (int) ('1' . str_repeat('0', abs($ceil_figure_length)));
        if ($ceil_figure_length < 0) {
            return ceil($value * $ceil_figure) / $ceil_figure;
        }

        return ceil($value / $ceil_figure) * $ceil_figure;
    }
}
