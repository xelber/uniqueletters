<?php


namespace App;


use Symfony\Component\Yaml\Yaml;

class XmlParser
{
    public $xmlContent;

    private $xml;

    public function __construct($xmlContent)
    {
        $this->xmlContent = $xmlContent;
        $this->xml = new \SimpleXMLElement($this->xmlContent);;
    }

    public function yaml()
    {

    }

    public function getAsCsv()
    {
        $rows = [];
        foreach ($this->xml as $key => $property)
        {
            $rows[] = $this->getPropertyAaArray($key, $property);
        }

        return $rows;
    }

    private function getPropertyAaArray($key, $property)
    {
        return [
            'agentId' => (string)$property->agentID,
            'uniqueId' => (string)$property->uniqueID,
            'propertyType' => $key,
            'listingStatus' => (string)$property->attributes()['status'],
            'state' => (string)$property->address->state,
            'displayPrice' => $this->getPrice($property),
            'dateModified' => $this->getPropertyModDate($property),
        ];
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

    private function getPropertyModDate($property)
    {
        $date = (string)$property->attributes()['modTime'];
        $date = substr_replace($date, ' ', 10, 1);

        return $date;
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
        if ( !empty($property->rent) ) return (float)$property->rent;
        if ( empty($property->price->range) ) return (float)$property->price;

        $min = (float)$property->price->range->min;
        $max = (float)$property->price->range->max;

        return ($min+$max)/2;
    }
}