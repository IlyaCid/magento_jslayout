<?php
declare(strict_types=1);

namespace WebMeridian\JsLayoutExample\Block\Example;

use Magento\Framework\View\Element\Template;

class OnePage extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\Serialize\SerializerInterface
     */
    private $serializer;

    /**
     * @var \WebMeridian\JsLayoutExample\Model\CompositeConfigProvider
     */
    private $configProvider;

    /**
     * @var array
     */
    protected $layoutProcessors;

    /**
     * @param Template\Context $context
     * @param \WebMeridian\JsLayoutExample\Model\CompositeConfigProvider $configProvider
     * @param \Magento\Framework\Serialize\SerializerInterface $serializer
     * @param array $layoutProcessors
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \WebMeridian\JsLayoutExample\Model\CompositeConfigProvider $configProvider,
        \Magento\Framework\Serialize\SerializerInterface $serializer,
        array $layoutProcessors = [],
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->configProvider = $configProvider;
        $this->layoutProcessors = $layoutProcessors;
        $this->serializer = $serializer;
    }

    /**
     * @return string
     */
    public function getJsLayout()
    {
        foreach ($this->layoutProcessors as $processor) {
            $this->jsLayout = $processor->process($this->jsLayout);
        }

        return $this->serializer->serialize($this->jsLayout);
    }

    /**
     * Retrieve serialized config.
     *
     * @return bool|string
     * @since 100.2.0
     */
    public function getSerializedConfig()
    {
        return  $this->serializer->serialize($this->getCheckoutConfig());
    }

    /**
     * Retrieve checkout configuration
     *
     * @return array
     * @codeCoverageIgnore
     */
    public function getCheckoutConfig()
    {
        return $this->configProvider->getConfig();
    }

}

