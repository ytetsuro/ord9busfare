<?php
namespace NagoyaPHP\Enum;

/**
 * 年齢区分
 *
 * @method static AgeType ADULT() 大人を表す年齢区分クラスを返す
 * @method static AgeType CHILD() 子供を表す年齢区分クラスを返す
 * @method static AgeType INFANT() 幼児を表す年齢区分クラスを返す
 */
final class AgeType extends Enum
{
    const ADULT = 'A';
    const CHILD = 'C';
    const INFANT = 'I';
}
