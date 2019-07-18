<?php

namespace LavoWeb\RemoveDuplicatedScopedValues\Helper;

/**
 * Class Product
 * @package LavoWeb\RemoveDuplicatedScopedValues\Helper
 */
class Product extends Data
{
    protected $tables = [
        'catalog_product_entity_datetime',
        'catalog_product_entity_decimal',
        'catalog_product_entity_int',
        'catalog_product_entity_text',
        'catalog_product_entity_varchar'
    ];

    /**
     * Remove Duplicated Scoped Values
     */
    public function removeDuplicatedScopedValues()
    {
        foreach ($this->tables as $t) {
            $table = $this->connection->getTableName($t);
            $sql = <<<EOF
DELETE FROM `{$table}` 
WHERE `value_id` IN (
    SELECT a.value_id AS value_ids 
    FROM (SELECT * FROM {$table}) AS a 
    INNER JOIN (SELECT * FROM {$table}) AS b ON a.attribute_id = b.attribute_id AND a.entity_id = b.entity_id AND a.value = b.value AND b.store_id = 0
    WHERE a.store_id <> 0
    GROUP BY a.attribute_id, a.entity_id, a.value, a.store_id
);
EOF;
            try {
                $this->connection->query($sql);
            } catch (\Exception $e) {
                // Empty
            }
        }
    }
}
