<?php

namespace LavoWeb\RemoveDuplicatedScopedValues\Helper;

/**
 * Class Configuration
 * @package LavoWeb\RemoveDuplicatedScopedValues\Helper
 */
class Configuration extends Data
{
    protected $tables = [
        'core_config_data'
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
WHERE `config_id` IN (
    SELECT a.config_id AS config_id
    FROM (SELECT * FROM {$table}) AS a
    INNER JOIN (SELECT * FROM {$table}) AS b ON a.path = b.path AND a.value = b.value AND b.scope_id = 0
    WHERE a.scope_id <> 0;
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
