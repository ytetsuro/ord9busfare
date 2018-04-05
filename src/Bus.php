<?php
namespace Bus;
use Bus\Calculate;
use Bus\Parser;

class Bus
{
    private $calculate;
    private $parser;

    public function __construct()
    {
        $this->calculate = new Calculate();
        $this->parser = new Parser();
    }

    public function parseAndCalc(string $str): float
    {
        $age_list = $this->parser->parseAgeList($str);
        return $this->calculate->calcTotalPrice($age_list);
    }
}
