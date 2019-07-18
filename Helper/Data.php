<?php

namespace LavoWeb\RemoveDuplicatedScopedValues\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

/**
 * Class Data
 * @package LavoWeb\RemoveDuplicatedScopedValues\Helper
 */
class Data extends AbstractHelper
{
    /** @var ScopeConfigInterface */
    protected $scopeConfig;

    /** @var ResourceConnection */
    protected $resource;

    /** @var AdapterInterface */
    protected $connection;

    /**
     * Data constructor.
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param ResourceConnection $resource
     */
    public function __construct(Context $context, ScopeConfigInterface $scopeConfig, ResourceConnection $resource)
    {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
        $this->resource = $resource;
        $this->connection = $this->resource->getConnection();
    }

    /**
     * Get config
     *
     * @param string $path
     * @return string
     */
    public function getConfig($path = '')
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get config flag
     *
     * @param string $path
     * @return bool
     */
    public function getConfigFlag($path = '')
    {
        return $this->scopeConfig->isSetFlag($path, ScopeInterface::SCOPE_STORE);
    }
}
