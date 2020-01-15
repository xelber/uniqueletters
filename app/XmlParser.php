<?php


namespace App;


class XmlParser
{
    public $xmlContent;

    private $xml;

    public function __construct($xmlContent)
    {
        $this->xmlContent = $xmlContent;
        $this->xml = new \SimpleXMLElement($this->xmlContent);;
    }

    public function getList()
    {
        $list = [];
        foreach ($this->xml as $key => $property)
        {
            $id = (string)$property->uniqueID;
            $list[$id] = $key;
        }

        return $list;
    }

    /**
     * TODO - Price could also come in range, what should be taken instead?
     * TODO - Have taken the average for now.
     * @return array
     */
    public function getPriceListByState()
    {
        $list = [];
        foreach ($this->xml as $key => $property)
        {
            if ( empty($property->price) ) continue;
            $state = (string)$property->address->state;
            if ( empty( $list[$state] ) ) $list[$state] = [];
            $id = (string)$property->uniqueID;

            $list[$state][$id] = $this->getPrice($property);
        }

        return $list;
    }

    public function getPriceAverageByState()
    {
        $list = $this->getPriceListByState();
        $return = [];
        foreach ( $list as $key => $props )
        {
            $return[$key] = round(array_sum($props)/count($props));
        }

        return $return;
    }

    private function getPrice($property)
    {
        if ( empty($property->price->range) ) return (float)$property->price;

        $min = (float)$property->price->range->min;
        $max = (float)$property->price->range->max;

        return ($min+$max)/2;
    }
}