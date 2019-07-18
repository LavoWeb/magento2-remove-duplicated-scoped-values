<?php

namespace LavoWeb\RemoveDuplicatedScopedValues\Controller\Adminhtml\RemoveDuplicatedScopedValues;

use LavoWeb\RemoveDuplicatedScopedValues\Helper\Product as ProductHelper;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Products extends Action
{
    /** @var ProductHelper */
    protected $productHelper;

    /**
     * Products constructor.
     * @param Action\Context $context
     * @param ProductHelper $productHelper
     */
    public function __construct(
        Action\Context $context,
        ProductHelper $productHelper
    ) {
        parent::__construct($context);
        $this->productHelper = $productHelper;
    }

    public function execute()
    {
        $this->productHelper->removeDuplicatedScopedValues();
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}