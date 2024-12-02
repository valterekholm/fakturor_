--20241126
ALTER TABLE `faktura` CHANGE `nr` `nr` INT(11) UNSIGNED NOT NULL;

--20241202
ALTER TABLE `faktura` CHANGE `kommentarer` `kommentarer` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Fyll i datum för arbetet';
