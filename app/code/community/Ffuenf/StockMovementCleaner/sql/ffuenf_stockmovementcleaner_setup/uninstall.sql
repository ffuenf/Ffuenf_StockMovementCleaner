-- add table prefix if you have one
DELETE FROM core_config_data WHERE path like 'ffuenf_stockmovementcleaner/%';
DELETE FROM core_config_data WHERE path = 'advanced/modules_disable_output/Ffuenf_StockMovementCleaner';
DELETE FROM core_resource WHERE code = 'ffuenf_stockmovementcleaner_setup';