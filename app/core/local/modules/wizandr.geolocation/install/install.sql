create table if not exists arrival_place
(
    id bigint AUTO_INCREMENT primary key NOT NULL,
    user_id bigint null comment 'id пользователя',
    arrival text   null comment 'место доставки'
);