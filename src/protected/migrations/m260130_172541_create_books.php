<?php

class m260130_172541_create_books extends CDbMigration
{
	public function up()
	{
		$this->execute("
			CREATE TABLE `books` (
				`book_id` smallint unsigned NOT NULL AUTO_INCREMENT COMMENT 'Код книги',
				`book_title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL COMMENT 'Название книги',
				`book_year` smallint unsigned NOT NULL COMMENT 'Год выпуска книги',
				`book_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs COMMENT 'Описание книги',
				`book_isbn` varchar(22) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL COMMENT 'ISBN',
				`book_pic` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs DEFAULT NULL COMMENT 'Фото главной страницы',
				PRIMARY KEY (`book_id`),
				UNIQUE KEY `books_unique` (`book_isbn`),
				KEY `books_book_title_IDX` (`book_title`) USING BTREE,
				KEY `books_book_year_IDX` (`book_year`) USING BTREE,
				KEY `books_book_isbn_IDX` (`book_isbn`) USING BTREE,
				FULLTEXT KEY `books_book_desc_IDX` (`book_desc`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_cs COMMENT='Книги'
		", []);

		$this->execute("
			INSERT INTO books (book_title, book_year, book_desc, book_isbn, book_pic) VALUES
			('Щегол', 2013, 'роман о силе искусства и травме потери', 'ISBN 978‑5‑17‑085328‑4', ''),
			('Маленькая жизнь', 2015, 'эпическая история четырёх друзей в Нью‑Йорке', 'ISBN 978‑5‑17‑145626‑8', ''),
			('Нормальные люди', 2018, 'история отношений Коннелла и Марианны — двух ирландских подростков из разных социальных слоёв', 'ISBN 978‑5‑60421966‑7', ''),
			('Безмолвный пациент', 2019, 'психологический триллер о художнице Алисии Беренсон, убившей мужа и замолчавшей', 'ISBN 978‑5‑04‑100912‑5', ''),
			('Задача трёх тел', 2008, 'первый роман трилогии «В память о прошлом Земли»', 'ISBN 978‑5‑04‑199448‑3', ''),
			('Петровы в гриппе и вокруг него', 2008, 'абсурдистский роман о семье автослесаря Петрова, где грипп становится метафорой хаоса современной жизни', 'ISBN 978‑5‑17‑106937‑4', ''),
			('Памяти памяти', 2017, 'гибридный текст — мемуары, эссе и исследование семейной истории', 'ISBN 978‑5‑98379‑217‑9', ''),
			('Моя тёмная Ванесса', 2020, 'провокационный роман о токсичных отношениях 15‑летней Ванессы с 42‑летним учителем', 'ISBN 978‑5‑04‑161892‑1', ''),
			('Лавр', 2012, '«житие» средневекового целителя Арсения, который после смерти возлюбленной принимает имя Лавр и посвящает жизнь помощи людям', 'ISBN 978‑5‑17‑078791‑7', ''),
			('Сад', 2020, 'исторический роман о Тусе Борятинской — нежеланном ребёнке аристократической семьи XIX века', 'ISBN 978‑5‑17‑120624‑8', '')
		");
	}

	public function down()
	{
		$this->dropTable('books');
	}
}