<?php

namespace LavoWeb\RemoveDuplicatedScopedValues\Cron;

use Magento\Framework\Module\Manager;
use LavoWeb\RemoveDuplicatedScopedValues\Helper\Category as CategoryHelper;
use LavoWeb\RemoveDuplicatedScopedValues\Helper\Configuration as ConfigurationHelper;
use LavoWeb\RemoveDuplicatedScopedValues\Helper\Product as ProductHelper;

class Activity
{
    /** @var CategoryHelper */
    protected $categoryHelper;

    /** @var ConfigurationHelper */
    protected $configurationHelper;

    /** @var ProductHelper */
    protected $productHelper;

    /** @var Manager */
    protected $moduleManager;

    /**
     * Activity constructor.
     * @param Manager $moduleManager
     * @param CategoryHelper $categoryHelper
     * @param ConfigurationHelper $configurationHelper
     * @param ProductHelper $productHelper
     */
    public function __construct(Manager $moduleManager, CategoryHelper $categoryHelper, ConfigurationHelper $configurationHelper, ProductHelper $productHelper)
    {
        $this->moduleManager = $moduleManager;
        $this->categoryHelper = $categoryHelper;
        $this->productHelper = $productHelper;
    }

    public function execute()
    {
        if ($this->moduleManager->isEnabled('LavoWeb_RemoveDuplicatedScopedValues')) {
            $this->categoryHelper->removeDuplicatedScopedValues();
            $this->configurationHelper->removeDuplicatedScopedValues();
            $this->productHelper->removeDuplicatedScopedValues();
        }
    }
}
