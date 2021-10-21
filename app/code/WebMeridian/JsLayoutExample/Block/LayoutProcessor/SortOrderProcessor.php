<?php

namespace WebMeridian\JsLayoutExample\Block\LayoutProcessor;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

class SortOrderProcessor implements LayoutProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function process($jsLayout)
    {
        $jsLayout['components']['jslayoutexample']['children']['steps']['children']['form-step']
        ['children']['input_test']['sortOrder'] = 30;

        return $jsLayout;
    }
}
