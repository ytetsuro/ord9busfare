<?php
namespace NagoyaPHP\Enum;

/**
 * 金額区分
 *
 * @method static PriceType NORMAL() 通常料金であることを表す料金区分クラスを返す
 * @method static PriceType WELFARE() 福祉料金であることを表す料金区分クラスを返す
 * @method static PriceType HAS_PASS() 定期券料金であることを表す料金区分クラスを返す
 */
final class PriceType extends Enum
{
    const NORMAL = 'n';
    const WELFARE = 'w';
    const HAS_PASS = 'p';
}
