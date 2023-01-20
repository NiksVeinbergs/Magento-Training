<?php
/**
 * @author       Niks Veinbergs
 * @copyright    Copyright (c) 2023
 */
declare(strict_types=1);
namespace Magebit\Learning\ViewModel\Product;

/**
 * Class Attributes
 */
class Attributes implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     *Array of attributes which have higher priority
     */
    const ATTRIBUTE_NAMES = ['activity', 'features_bags', 'features'];

    /**
     * Checks for needed attributes and if some of them are missing adds other to list (if there is some)
     *
     * @param array $allAttributes
     * @return array
     */
    public function getSortedAttributes(array $allAttributes): array
    {
        $usedAttributes = [];

        //At first get neededAttributes and store in usedAttributes array
        foreach ($allAttributes as $_data) {
            if (in_array($_data['code'], self::ATTRIBUTE_NAMES)) {
                $usedAttributes[$_data['code']] = [
                    'label' => $_data['label'],
                    'code' => $_data['code'],
                    'value' => $_data['value']
                ];
            }
        }

        //Then get additional attributes if needed are missing and store in usedAttributes array
        foreach ($allAttributes as $_data) {
            if (!array_search($_data['code'], array_column($usedAttributes, 'code')) && count($usedAttributes) < count(self::ATTRIBUTE_NAMES)) {
                $usedAttributes[$_data['code']] = [
                    'label' => $_data['label'],
                    'code' => $_data['code'],
                    'value' => $_data['value'],
                ];
            }
        }

        return $usedAttributes;
    }
}
