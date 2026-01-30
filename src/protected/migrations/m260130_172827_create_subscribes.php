<?php

class m260130_172827_create_subscribes extends CDbMigration
{
	public function up()
	{
		$this->execute("
			CREATE TABLE subscribes (
				guest_phone varchar(12) NOT NULL COMMENT 'Телефон посетителя',
				author_id SMALLINT UNSIGNED NOT NULL COMMENT 'Код автора',
				CONSTRAINT subscribes_unique UNIQUE KEY (guest_phone,author_id),
				CONSTRAINT subscribes_authors_FK FOREIGN KEY (author_id) REFERENCES app_db.authors(author_id) ON DELETE CASCADE ON UPDATE CASCADE
			)
			ENGINE=InnoDB
			DEFAULT CHARSET=utf8mb4
			COLLATE=utf8mb4_0900_ai_ci
			COMMENT='Подписки на новые книги авторов'
		", []);

		$this->execute("
			CREATE INDEX subscribes_author_id_IDX USING BTREE ON subscribes (author_id)
		", []);

	}

	public function down()
	{
		$this->dropTable('subscribes');
	}
}