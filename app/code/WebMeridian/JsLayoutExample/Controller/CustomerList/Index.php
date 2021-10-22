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
    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */
    private $filterBuilder;

    /**
     * @param Context $context
     * @param \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param \Magento\Framework\Api\FilterBuilder $filterBuilder
     */
    public function __construct(
        Context $context,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder
    ) {
        parent::__construct($context);
        $this->customerRepository = $customerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        if ($requestFirstName = $this->getRequest()->getParam('request_name')) {
            $filter = $this->filterBuilder->setField("firstname")
                ->setValue("%" . $requestFirstName . "%")
                ->setConditionType("like")
                ->create();
            $this->searchCriteriaBuilder->addFilters([$filter]);
        }

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
