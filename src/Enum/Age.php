<?php
namespace NagoyaPHP\Enum;

/**
 * 年齢区分
 *
 * @method static Age ADULT() 大人を表す年齢区分クラスを返す
 * @method static Age CHILD() 子供を表す年齢区分クラスを返す
 * @method static Age INFANT() 幼児を表す年齢区分クラスを返す
 */
final class Age extends Enum
{
    const ADULT = 'A';
    const CHILD = 'C';
    const INFANT = 'I';
}
