<?php
namespace NagoyaPHP;

use NagoyaPHP\Calculator\BusFareCalculator;
use NagoyaPHP\Calculator\PassengerCalculateRules;
use NagoyaPHP\Parser\FareParser;

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
     * @var FareParser
     */
    private $fareParser;

    /**
     * @var PassengerCollectionFactory
     */
    private $passengerCollectionFactory;

    public function __construct(FareParser $fare_parser, PassengerCollectionFactory $passenger_collection_factory)
    {
        $calculate_rule = new PassengerCalculateRules();
        $this->calculator = new BusFareCalculator($calculate_rule);
        $this->fareParser = $fare_parser;
        $this->passengerCollectionFactory = $passenger_collection_factory;
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
        $base_fare = $this->fareParser->parseFare($input);
        $passenger_collection = $this->passengerCollectionFactory->createByString($input);

        return $this->calculator->calculate($base_fare, $passenger_collection);
    }
}
