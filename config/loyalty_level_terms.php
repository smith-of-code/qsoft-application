<?php

use QSoft\Helper\LoyaltyProgramHelper;

/**
 * Настройки Программы лояльности
 *
 * Ограничения:
 * - self_period_months - Задается числом, кратным 3 (число месяцев в квартале)
 * - team_period_months - Задается числом, кратным 3 (число месяцев в квартале)
 *
 * Типы условий:
 * - hold_level_terms - условия удержания данного уровня;
 * - upgrade_level_terms - условия перехода на данный уровень;
 *
 * Виды начислений бонусных баллов:
 * - personal_bonuses_for_cost - бонусные баллы за личную покупку, от стоимости товаров в заказе после применения скидок (кроме товаров с Перс. акцией);
 * - personal_bonuses_for_stock - бонусные баллы за личную покупку, от стоимости товаров в заказе, к которым была применена Персональная акция;
 * - group_bonuses_for_cost - бонусные баллы за групповую покупку, от стоимости заказа члена группы после применения скидок;
 * - upgrade_level_bonuses - бонус за переход на заданный уровень;
 */
return [
    'types' => [
        'K' => 'consultant',
        'B' => 'customer',
    ],
    'consultant' => [
        'K1' => [
            'label' => 'K1', // Название для вывода в публичной части
            'level' => 1, // Уровень (значение для сортировки уровней)
            'self_max_bonuses' => 100000, // Максимальное количество бонусов
            'team_max_bonuses' => 100000, // Максимальное количество бонусов
            'hold_level_terms' => [
                'self_min_amount' => 5000.0, // Минимальная сумма личных покупок за 1 отчетный период (руб)
                'self_total' => 5000.0, // Сумма личных покупок за месяц (руб)
                'self_period_months' => 3, // Количество месяцев
                'team_min_amount' => .0, // Минимальная сумма групповых покупок за 1 отчетный период (руб)
            ],
            'benefits' => [
                'referral_size' => 100, // Бонус за приглашение Консультанта (ББ)
                'personal_discount' => 7, // Персональная скидка на все товары (%)
                'personal_bonuses_for_cost' => [
                    'size' => 1, // Бонус (ББ) за каждые STEP рублей
                    'step' => 100,
                ],
                'personal_bonuses_for_stock' => [
                    'size' => 2, // Бонус (ББ) за каждые STEP рублей
                    'step' => 100,
                ],
                'group_bonuses_for_cost' => [
                    'size' => 1, // Бонус (ББ) за каждые STEP рублей
                    'step' => 100,
                ],
            ],
        ],
        'K2' => [
            'label' => 'K2', // Название для вывода в публичной части
            'level' => 2, // Уровень (значение для сортировки уровней)
            'self_max_bonuses' => 200000, // Максимальное количество бонусов
            'team_max_bonuses' => 100000, // Максимальное количество бонусов
            'hold_level_terms' => [
                'self_min_amount' => 15000.0, // Минимальная сумма личных покупок за 1 отчетный период (руб)
                'self_total' => 5000.0, // Сумма личных покупок за месяц (руб)
                'self_period_months' => 3,  // Количество месяцев
                'team_min_amount' => 21000.0, // Минимальная сумма групповых покупок за 1 отчетный период (руб)
                'team_total' => 7000.0, // Сумма групповых покупок за месяц (руб)
                'team_period_months' => 3,  // Количество месяцев
            ],
            'upgrade_level_terms' => [
                'self_total' => 10000.0, // Сумма личных покупок за период (руб)
                'self_period_months' => 3,  // Количество месяцев (продолжительность периода)
                'team_total' => 10000.0, // Сумма групповых покупок за период (руб)
                'team_period_months' => 3,  // Количество месяцев (продолжительность периода)
            ],
            'benefits' => [
                'referral_size' => 150, // Бонус за приглашение Консультанта (ББ)
                'personal_discount' => 10, // Персональная скидка на все товары (%)
                'personal_bonuses_for_cost' => [
                    'size' => 2, // Бонус (ББ) за каждые STEP рублей
                    'step' => 100,
                ],
                'personal_bonuses_for_stock' => [
                    'size' => 2, // Бонус (ББ) за каждые STEP рублей
                    'step' => 100,
                ],
                'group_bonuses_for_cost' => [
                    'size' => 2, // Бонус (ББ) за каждые STEP рублей
                    'step' => 200,
                ],
                'upgrade_level_bonuses' => 100, // Бонус (ББ) за переход на этот уровень
            ],
        ],
        'K3' => [
            'label' => 'K3', // Название для вывода в публичной части
            'level' => 3, // Уровень (значение для сортировки уровней)
            'self_max_bonuses' => 300000, // Максимальное количество бонусов
            'team_max_bonuses' => 200000, // Максимальное количество бонусов
            'hold_level_terms' => [
                'self_min_amount' => 30000.0, // Минимальная сумма личных покупок за 1 отчетный период (руб)
                'self_total' => 10000.0, // Сумма личных покупок за месяц (руб)
                'self_period_months' => 3,  // Количество месяцев
                'team_min_amount' => 60000.0, // Минимальная сумма групповых покупок за 1 отчетный период (руб)
                'team_total' => 20000.0, // Сумма групповых покупок за месяц (руб)
                'team_period_months' => 3,  // Количество месяцев
            ],
            'upgrade_level_terms' => [
                'self_total' => 50000.0, // Сумма личных покупок за период (руб)
                'self_period_months' => 6,  // Количество месяцев (продолжительность периода)
                'team_total' => 100000.0, // Сумма групповых покупок за период (руб)
                'team_period_months' => 6,  // Количество месяцев (продолжительность периода)
            ],
            'benefits' => [
                'referral_size' => 200, // Бонус за приглашение Консультанта (ББ)
                'personal_discount' => 12, // Персональная скидка на все товары (%)
                'personal_bonuses_for_cost' => [
                    'size' => 3, // Бонус (ББ) за каждые STEP рублей
                    'step' => 100,
                ],
                'personal_bonuses_for_stock' => [
                    'size' => 2, // Бонус (ББ) за каждые STEP рублей
                    'step' => 100,
                ],
                'group_bonuses_for_cost' => [
                    'size' => 4, // Бонус (ББ) за каждые STEP рублей
                    'step' => 200,
                ],
                'upgrade_level_bonuses' => 300, // Бонус (ББ) за переход на этот уровень + удержание в течении 6 месяцев
            ],
        ]
    ],
    'customer' => [
        'B1' => [
            'level' => 1, // Уровень (значение для сортировки уровней)
            'benefits' => [
                'personal_discount' => 2, // Персональная скидка на все товары (%)
            ],
        ],
        'B2' => [
            'level' => 2, // Уровень (значение для сортировки уровней)
            'hold_level_terms' => [
                'self_total' => 3000.0, // Сумма личных покупок за период (руб)
                'self_period_months' => 1,  // Количество месяцев (продолжительность периода)
            ],
            'upgrade_level_terms' => [
                'self_total' => 3000.0, // Сумма личных покупок за период (руб)
                'self_period_months' => 1,  // Количество месяцев (продолжительность периода)
            ],
            'benefits' => [
                'personal_discount' => 3, // Персональная скидка на все товары (%)
            ],
        ],
        'B3' => [
            'level' => 3, // Уровень (значение для сортировки уровней)
            'hold_level_terms' => [
                'self_total' => 5000.0, // Сумма личных покупок за период (руб)
                'self_period_months' => 1,  // Количество месяцев (продолжительность периода)
            ],
            'upgrade_level_terms' => [
                'self_total' => 5000.0, // Сумма личных покупок за период (руб)
                'self_period_months' => 1,  // Количество месяцев (продолжительность периода)
            ],
            'benefits' => [
                'personal_discount' => 5, // Персональная скидка на все товары (%)
            ],
        ]
    ]
];