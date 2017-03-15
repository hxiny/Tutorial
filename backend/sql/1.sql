ALTER TABLE `auth_assignment`
	ADD COLUMN `cell_id` VARCHAR(50) NOT NULL AFTER `created_at`,
	DROP PRIMARY KEY,
	ADD PRIMARY KEY (`item_name`, `user_id`, `cell_id`);
