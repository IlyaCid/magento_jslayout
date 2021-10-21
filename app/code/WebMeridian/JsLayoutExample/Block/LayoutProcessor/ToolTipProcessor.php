<?php

namespace WebMeridian\JsLayoutExample\Block\LayoutProcessor;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Store\Model\StoreManagerInterface;

class ToolTipProcessor implements LayoutProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function process($jsLayout)
    {
        $tooltipElement = [
            'tooltip' => [
                'description' => 'Test description'
            ]
        ];

        if ($path = &$jsLayout['components']['jslayoutexample']['children']['steps']['children']['form-step']
        ['children']['input_test']['config']) {
            $path += $tooltipElement;
        }

        return $jsLayout;
    }
}
