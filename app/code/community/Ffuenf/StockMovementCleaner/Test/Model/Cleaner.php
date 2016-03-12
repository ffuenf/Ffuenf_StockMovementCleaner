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
 * @copyright  Copyright (c) 2016 ffuenf (http://www.ffuenf.de)
 * @license    http://opensource.org/licenses/mit-license.php MIT License
 */

class Ffuenf_StockMovementCleaner_Test_Model_Cleaner extends EcomDev_PHPUnit_Test_Case_Config
{

    /**
     * Tests whether extension model aliases are returning the correct class names
     *
     * @test
     */
    public function testModelAlias()
    {
        $this->assertModelAlias(
            'ffuenf_stockmovementcleaner/observer_cleaner',
            'Ffuenf_StockMovementCleaner_Model_Cleaner'
        );
    }
}
