### Создание таблиц под очередь
Необходимо создать две таблицы **jobs** и **failed_jobs**.  
```sql
create table jobs
(
    id           bigint unsigned auto_increment
    primary key,
    queue        varchar(255)     not null,
    payload      longtext         not null,
    attempts     tinyint unsigned not null,
    reserved     tinyint unsigned not null,
    reserved_at  int unsigned     null,
    available_at int unsigned     not null,
    created_at   int unsigned     not null
)
    charset = utf8;

create index jobs_queue_reserved_reserved_at_index
    on jobs (queue, reserved, reserved_at);
```

```sql
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
```

### Создание файла конфига
Пример файла конфигурации:  
```php
return [
    'default' => 'bx',
    'connections' => [
        'bx' => [
            'driver' => 'bx',
            'queue' => 'default',
            'retry_after' => 60,
            'bx_connection' => 'default',
            'bx_table' => QSoft\Queue\ORM\JobTable::class,
        ],
    ],

    'failed' => [
        'bx_connection' => 'default',
        'bx_table' => QSoft\Queue\ORM\FailedJobTable::class,
    ],
];
```

### Регистрация пакета:
Необходимо зарегистрировать настройки работы с очередью 
в конфигураторе и добавить ServiceProvider.
```php
/**
 * $app - объект приложения из пакета qsoft/application
 * $config - файл конфигурации описанный выше
 */
$app->get('config')->set('queue', $config);

/**
 * Регистрация сервис провайдера
 */
$app->register(new QSoft\Queue\QueueServiceProvider($app));
``` 
После этого в контейнере станут доступны консольные команды
для работы с очередью.
```php
// Запустить выполенение задач
$app->get('command.queue.work'); 

// Список неудачных задач
$app->get('command.queue.failed'); 

// Удалить неудачную задачу
$app->get('command.queue.forget');
 
// Очистить список неудачных задач
$app->get('command.queue.flush'); 

// Вернуть неудачную задачу в очередь
$app->get('command.queue.retry'); 
```

### Документация
[Работа с очередью](https://laravel.com/docs/5.5/queues)
