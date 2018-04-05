<?php
namespace NagoyaPHP;

use NagoyaPHP\Calculator\BusFareCalculator;
use NagoyaPHP\Calculator\PassangerCalculateRules;
use NagoyaPHP\Parser\PriceParser;

/**
 * バスの運賃会計
 */
class BusFareCasher
{
    /**
     * @var PassangerCalculateRules
     */
    private $calculator;

    /**
     * @var PriceParser
     */
    private $price_parser;

    /**
     * @var PassangerCollectionFactory
     */
    private $passanger_collection;

    public function __construct(PriceParser $price_parser, PassangerCollectionFactory $passanger_collection_factory)
    {
        $calculate_rule = new PassangerCalculateRules();
        $this->calculator = new BusFareCalculator($calculate_rule);
        $this->price_parser = $price_parser;
        $this->passanger_collection_factory = $passanger_collection_factory;
    }

    /**
     * 運賃を取得する
     *
     * @param string $input
     *
     * @return float
     */
    public function getFare(string $input) : float
    {
        $price = $this->price_parser->parsePrice($input);
        $passanger_collection = $this->passanger_collection_factory->createByString($input);

        return $this->calculator->calculate($price, $passanger_collection);
    }
}
