<?php
/**
  Пример миграции.

  Для создания вызывался
  ./disposer make:migration QueueTables
  Далее файл редактировался вручную, удалялось лишнее, добавлялось нужное.
*/

use QSoft\Migration\Migration;

class QueueTables extends Migration {
    /**
     * Вызывается при накате миграции вызовом
     * ./disposer migrate
     *
     * При этом накатятся все ненакаченные миграции, а не только эта.
     * Какие из миграций накачены, а какие нет можно узнать запустив
     * ./disposer migrate:status
     */
    public function up()
    {
        $conn = \Bitrix\Main\Application::getConnection();

        $conn->query(<<<SQL
            create table jobs
            (
                id           bigint unsigned auto_increment primary key,
                queue        varchar(255)     not null,
                payload      longtext         not null,
                attempts     tinyint unsigned not null,
                reserved     tinyint unsigned not null,
                reserved_at  int unsigned     null,
                available_at int unsigned     not null,
                created_at   int unsigned     not null
            ) charset = utf8;
        SQL);

        $conn->query(<<<SQL
            create index jobs_queue_reserved_reserved_at_index on jobs (queue, reserved, reserved_at)
        SQL);

        $conn->query(<<<SQL
            create table failed_jobs
            (
                id         bigint unsigned auto_increment
                primary key,
                connection text                                not null,
                queue      text                                not null,
                payload    longtext                            not null,
                exception  longtext                            not null,
                failed_at  timestamp default CURRENT_TIMESTAMP not null
            );
        SQL);
    }

    /**
      * Вызывается при откате миграции при вызове
      * ./disposer migrate:rollback
      */
    public function down()
    {
        $conn = \Bitrix\Main\Application::getConnection();

        $conn->query('drop table failed_jobs');
        $conn->query('drop table jobs');
    }
}
