<?php

namespace WebMeridian\JsLayoutExample\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\UrlInterface;

class ConfigProvider implements ConfigProviderInterface
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param UrlInterface $urlBuilder
     */
    public function __construct(UrlInterface $urlBuilder)
    {
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Return configuration array
     *
     * @return array
     */
    public function getConfig()
    {
        $output['checkoutUrl'] = $this->getJsLayoutExampleUrl();

        return $output;
    }

    /**
     * Retrieve jsLayout Example URL
     *
     * @return string
     */
    public function getJsLayoutExampleUrl()
    {
        return $this->urlBuilder->getUrl('jslayout/example');
    }
}
