create table if not exists arrival_place
(
    id bigint AUTO_INCREMENT primary key NOT NULL,
    user_id bigint null comment 'id пользователя',
    kladr_id text null comment 'id из сервиса dadata',
    address text   null comment 'Город, улица, дом',
    flat text   null comment 'квартира',
    postal_code text   null comment 'индекс',
    entry text   null comment 'подъезд',
    housepin text   null comment 'домофон',
    floor text   null comment 'Этаж'
);