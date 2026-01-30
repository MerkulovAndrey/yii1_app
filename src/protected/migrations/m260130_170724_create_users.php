<?php

class m260130_170724_create_users extends CDbMigration
{
	public function up()
	{
		$this->execute("
			CREATE TABLE users (
				user_id mediumint unsigned auto_increment NOT NULL COMMENT 'Код пользователя',
				user_login varchar(20) NOT NULL COMMENT 'Имя (логин) пользователя',
				user_passw varchar(60) NOT NULL COMMENT 'Пароль пользователя',
				CONSTRAINT users_pk PRIMARY KEY (user_id),
				CONSTRAINT users_unique UNIQUE KEY (user_login)
			)
			ENGINE=InnoDB
			DEFAULT CHARSET=utf8mb4
			COLLATE=utf8mb4_0900_as_cs
			COMMENT='Пользователи системы'
		", []);

		$this->execute("INSERT INTO users (user_login, user_passw) VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3')");
	}

	public function down()
	{
		$this->dropTable('users');
	}
}