create table if not exists arrival_place
(
    id bigint AUTO_INCREMENT primary key NOT NULL,
    user_id bigint null comment 'id пользователя',
    flat varchar(5)  null comment 'квартира',
    entry varchar(2)  null comment 'подъезд',
    housepin varchar(6)  null comment 'домофон',
    postal_code varchar(6)  null comment 'индекс',
    city varchar(100)  null comment 'город',
    address_short varchar(255)  null comment 'Адрес короткий',
    floor varchar(3)   null comment 'Этаж',
    fias_level varchar(3)   null comment 'уровень объекта',
    geo_lat varchar(255)  null comment 'Широта',
    geo_lon varchar(255)  null comment 'Долгота'
);
alter table `arrival_place` add unique `unique_index`(
    `user_id`,
    `flat`,
    `entry`,
    `housepin`,
    `address_short`,
    `floor`,
    `fias_level`,
    `geo_lat`,
    `geo_lon`,
    `postal_code`,
    `city`
    );