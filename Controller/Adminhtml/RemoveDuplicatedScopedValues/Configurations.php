<?php

namespace LavoWeb\RemoveDuplicatedScopedValues\Controller\Adminhtml\RemoveDuplicatedScopedValues;

use LavoWeb\RemoveDuplicatedScopedValues\Helper\Configuration as ConfigurationHelper;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Configurations extends Action
{
    /** @var ConfigurationHelper */
    protected $configurationHelper;

    /**
     * Configurations constructor.
     * @param Action\Context $context
     * @param ConfigurationHelper $configurationHelper
     */
    public function __construct(
        Action\Context $context,
        ConfigurationHelper $configurationHelper
    ) {
        parent::__construct($context);
        $this->configurationHelper = $configurationHelper;
    }

    public function execute()
    {
        $this->configurationHelper->removeDuplicatedScopedValues();
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}