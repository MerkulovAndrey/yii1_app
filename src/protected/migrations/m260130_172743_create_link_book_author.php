<?php

class m260130_172743_create_link_book_author extends CDbMigration
{
	public function up()
	{
		$this->execute("
			CREATE TABLE link_book_author (
				book_id SMALLINT UNSIGNED NOT NULL COMMENT 'Код книги',
				author_id SMALLINT UNSIGNED NOT NULL COMMENT 'Код автора',
				CONSTRAINT link_book_author_unique UNIQUE KEY (book_id,author_id),
				CONSTRAINT link_book_author_authors_FK FOREIGN KEY (author_id) REFERENCES app_db.authors(author_id) ON DELETE CASCADE ON UPDATE CASCADE,
				CONSTRAINT link_book_author_books_FK FOREIGN KEY (book_id) REFERENCES app_db.books(book_id) ON DELETE CASCADE ON UPDATE CASCADE
			)
			ENGINE=InnoDB
			DEFAULT CHARSET=utf8mb4
			COLLATE=utf8mb4_0900_ai_ci
			COMMENT='Таблица связей книг и авторов'
		", []);

		$this->execute("
			INSERT INTO link_book_author (book_id, author_id) VALUES
			(1,5),
			(2,1),
			(3,4),
			(4,6),
			(5,2),
			(6,7),
			(7,3),
			(8,9),
			(9,10),
			(10,8)
		");
	}

	public function down()
	{
		$this->dropTable('link_book_author');
	}
}