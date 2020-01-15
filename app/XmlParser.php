<?php


namespace App;


class XmlParser
{
    public $xmlContent;

    public function __construct($xmlContent)
    {
        $this->xmlContent = $xmlContent;
    }

    public function getList()
    {
        $propertyList = new \SimpleXMLElement($this->xmlContent);
        $list = [];
        foreach ($propertyList as $key => $property)
        {
            $id = (string)$property->uniqueID;
            $list[$id] = $key;
        }

        return $list;
    }
}