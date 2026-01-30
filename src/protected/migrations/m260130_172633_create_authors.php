<?php

class m260130_172633_create_authors extends CDbMigration
{
	public function up()
	{
		$this->execute("
			CREATE TABLE `authors` (
			`author_id` smallint unsigned NOT NULL AUTO_INCREMENT COMMENT 'Код автора',
			`author_lname` varchar(50) COLLATE utf8mb4_0900_as_cs NOT NULL COMMENT 'Фамилия автора',
			`author_fname` varchar(50) COLLATE utf8mb4_0900_as_cs NOT NULL COMMENT 'Имя автора',
			`author_sname` varchar(50) COLLATE utf8mb4_0900_as_cs DEFAULT NULL COMMENT 'Отчество автора',
			PRIMARY KEY (`author_id`),
			KEY `authors_author_lname_IDX` (`author_lname`) USING BTREE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_cs COMMENT='Авторы книг'
		", []);

		$this->execute("
			INSERT INTO authors (author_fname, author_lname, author_sname) VALUES
			('Ханья', 'Янагихара', ''),
			('Лю', 'Цысинь', ''),
			('Мария', 'Степанова', ''),
			('Салли', 'Руни', ''),
			('Донна', 'Тартт', ''),
			('Алекс', 'Михаэлидес', ''),
			('Алексей', 'Сальников', ''),
			('Марина', 'Степнова', ''),
			('Кейт', 'Расселл', 'Элизабет'),
			('Евгений', 'Водолазкин', '')
		");
	}

	public function down()
	{
		$this->dropTable('authors');
	}
}