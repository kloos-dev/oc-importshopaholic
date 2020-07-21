<?php namespace Codecycler\ImportShopaholic\Classes\Event;

use Codecycler\ImportShopaholic\Classes\Item\ImportValue;

class BeforeImport
{
    public function handle($sModelClass, $arImportData)
    {
        $arProcessedData = [];

        foreach ($arImportData as $sValueKey => $sValueValue) {
            $obImportValue = new ImportValue($sValueKey, $sValueValue);
            $arProcessedData[$sValueKey] = $obImportValue->get();
        }

        return $arProcessedData;
    }
}