<?php

namespace WebMeridian\JsLayoutExample\Controller\CustomerList;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Index  extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    private $customerRepository;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    public function __construct(
        Context $context,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        parent::__construct($context);
        $this->customerRepository = $customerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function execute()
    {

        $customers = $this->customerRepository->getList($this->searchCriteriaBuilder->create())->getItems();
        $data = [];
        foreach ($customers as $customer) {
            $data[] = [
                'id' => $customer->getId(),
                'firstName' => $customer->getFirstname(),
                'lastName' => $customer->getLastname(),
                'email' => $customer->getEmail()
            ];
        }
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        return $result->setData([
            'customers' => $data
        ]);
    }
}
