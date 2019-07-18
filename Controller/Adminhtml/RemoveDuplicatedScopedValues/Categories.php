<?php

namespace LavoWeb\RemoveDuplicatedScopedValues\Controller\Adminhtml\RemoveDuplicatedScopedValues;

use LavoWeb\RemoveDuplicatedScopedValues\Helper\Category as CategoryHelper;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Categories extends Action
{
    /** @var CategoryHelper */
    protected $categoryHelper;

    /**
     * Categories constructor.
     * @param Action\Context $context
     * @param CategoryHelper $categoryHelper
     */
    public function __construct(
        Action\Context $context,
        CategoryHelper $categoryHelper
    ) {
        parent::__construct($context);
        $this->categoryHelper = $categoryHelper;
    }

    public function execute()
    {
        $this->categoryHelper->removeDuplicatedScopedValues();
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}