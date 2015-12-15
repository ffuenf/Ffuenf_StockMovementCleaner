<?php

/**
 * Ffuenf_StockMovementCleaner extension.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category   Ffuenf
 *
 * @author     Achim Rosenhagen <a.rosenhagen@ffuenf.de>
 * @copyright  Copyright (c) 2015 ffuenf (http://www.ffuenf.de)
 * @license    http://opensource.org/licenses/mit-license.php MIT License
 */

class Ffuenf_StockMovementCleaner_Model_Cleaner
{
    /**
     * Clean old stock movement entries.
     * This method will be called via a Magento crontab task.
     *
     * @return null|array<String>
     */
    public function clean()
    {
        if (!Mage::helper('ffuenf_stockmovementcleaner')->isExtensionActive()) {
            return;
        }
        $report = array();
        $writeConnection = Mage::getSingleton('core/resource')->getConnection('core_write'); /* @var $writeConnection Varien_Db_Adapter_Pdo_Mysql */
        $tableName = Mage::getSingleton('core/resource')->getTableName('bubble_stock_movement');
        $tableName = $writeConnection->quoteIdentifier($tableName, true);
        $olderThan = intval(Mage::getStoreConfig('ffuenf_stockmovementcleaner/general/clean_movements_older_than'));
        $olderThan = max($olderThan, 1);
        // delete where older than 1 Year
        // DELETE FROM `bubble_stock_movement` WHERE `created_at` < NOW() - INTERVAL 365 DAY;
        $startTime = time();
        $sqlOld = sprintf('DELETE FROM %s WHERE created_at < DATE_SUB(Now(), INTERVAL %s DAY)',
            $tableName,
            $olderThan
        );
        $stmt = $writeConnection->query($sqlOld);
        $report['movements']['old']['count'] = $stmt->rowCount();
        $report['movements']['old']['duration'] = time() - $startTime;
        Mage::log('[STOCKMOVEMENTCLEANER] Cleaning stock movements older than ' . $olderThan . ' days (duration: ' . $report['movements']['old']['duration'] . ', row count: ' . $report['movements']['old']['count'] . ')');
        return $report;
    }
}
