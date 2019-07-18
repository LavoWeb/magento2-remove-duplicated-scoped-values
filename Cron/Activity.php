<?php

namespace LavoWeb\RemoveDuplicatedScopedValues\Cron;

use Magento\Framework\Module\Manager;
use LavoWeb\RemoveDuplicatedScopedValues\Helper\Category as CategoryHelper;
use LavoWeb\RemoveDuplicatedScopedValues\Helper\Product as ProductHelper;

class Activity
{
    /** @var CategoryHelper */
    protected $categoryHelper;

    /** @var ProductHelper */
    protected $productHelper;

    /** @var Manager */
    protected $moduleManager;

    /**
     * Activity constructor.
     * @param Manager $moduleManager
     * @param CategoryHelper $categoryHelper
     * @param ProductHelper $productHelper
     */
    public function __construct(Manager $moduleManager, CategoryHelper $categoryHelper, ProductHelper $productHelper)
    {
        $this->moduleManager = $moduleManager;
        $this->categoryHelper = $categoryHelper;
        $this->productHelper = $productHelper;
    }

    public function execute()
    {
        if ($this->moduleManager->isEnabled('LavoWeb_RemoveDuplicatedScopedValues')) {
            $this->categoryHelper->removeDuplicatedScopedValues();
            $this->productHelper->removeDuplicatedScopedValues();
        }
    }
}
