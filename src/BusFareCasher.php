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
     * @var BusFareCalculator
     */
    private $calculator;

    /**
     * @var PriceParser
     */
    private $priceParser;

    /**
     * @var PassangerCollectionFactory
     */
    private $passangerCollectionFactory;

    public function __construct(PriceParser $price_parser, PassangerCollectionFactory $passanger_collection_factory)
    {
        $calculate_rule = new PassangerCalculateRules();
        $this->calculator = new BusFareCalculator($calculate_rule);
        $this->priceParser = $price_parser;
        $this->passangerCollectionFactory = $passanger_collection_factory;
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
        $price = $this->priceParser->parsePrice($input);
        $passanger_collection = $this->passangerCollectionFactory->createByString($input);

        return $this->calculator->calculate($price, $passanger_collection);
    }
}
