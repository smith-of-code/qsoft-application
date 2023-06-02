create table if not exists arrival_place
(
    id bigint AUTO_INCREMENT primary key NOT NULL,
    user_id bigint null comment 'id пользователя',
    kladr_id varchar(30) null comment 'id из сервиса dadata',
    address varchar(255)  null comment 'Город, улица, дом',
    flat varchar(5)  null comment 'квартира',
    postal_code varchar(6)   null comment 'индекс',
    entry varchar(2)  null comment 'подъезд',
    housepin varchar(6)  null comment 'домофон',
    address_short varchar(255)  null comment 'Адрес короткий',
    floor varchar(3)   null comment 'Этаж',
    fias_level varchar(3)   null comment 'уровень объекта',
    city varchar(100)   null comment 'Город',
    region varchar(100)   null comment 'Регион'
);
alter table `arrival_place` add unique `unique_index`(
    `user_id`,
    `kladr_id`,
    `address`,
    `flat`,
    `postal_code`,
    `entry`,
    `housepin`,
    `address_short`,
    `floor`,
    `fias_level`,
    `city`,
    `region`
    );