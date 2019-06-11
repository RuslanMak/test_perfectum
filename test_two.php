1.	$sqlBorrow = "CREATE TABLE borrow (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	id_user_from INT(11) NOT NULL,
	id_user_to INT(11) NOT NULL,
	cash_borrow double(12,2) NOT NULL,
	status VARCHAR(5) NOT NULL DEFAULT 'true'
	)";

	$sqlUsers = "CREATE TABLE MyGuests (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	cash double(12,2) NOT NULL
	)";

2.	UPDATE `users` SET `cash` = `cash` - 100 WHERE `id` = 1 AND `cash` >= 100
	INSERT INTO `a_test_perfectom`.`borrow` (`id_user_from`, `id_user_to`, `cash_borrow`, `status`) VALUES ('1', '2', '100.00', 'true');
	UPDATE `users` SET `cash` = `cash` + 100 WHERE `id` = 2

3.	SELECT SUM(`cash_borrow`) FROM `borrow` WHERE `id_user_from` = 1 AND `id_user_to` = 2 AND `status` LIKE 'true'

4.	SELECT SUM(t.cash) FROM (SELECT cash FROM users WHERE id = 1 UNION ALL SELECT cash_borrow FROM borrow WHERE id_user_from = 1 ) t


5.	SELECT * FROM `borrow` LEFT JOIN users ON borrow.id_user_to = users.id WHERE borrow.id_user_from = 1 AND borrow.status LIKE 'true'