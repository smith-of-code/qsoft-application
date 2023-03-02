<?php

namespace QSoft\Helper;

class StringHelper
{

    /**
     * Возвращает слово с правильным окончанием в зависимости от числа
     * @param float $num
     * @param string $form1 //Рубль
     * @param string $form2 //Рубля
     * @param string $form3 //Рублей
     * @return string
     */
    public static function createWordForm(float $num, string $form1, string $form2, string $form3): string
    {
        $num = abs($num) % 100; // берем число по модулю и сбрасываем сотни (делим на 100, а остаток присваиваем переменной $num)
        $num_x = $num % 10; // сбрасываем десятки и записываем в новую переменную
        if ($num > 10 && $num < 20) { // если число принадлежит отрезку [11:19]
            return $form3;
        }
        if ($num_x > 1 && $num_x < 5) { // иначе если число оканчивается на 2,3,4
            return $form2;
        }
        if ($num_x == 1) { // иначе если оканчивается на 1
            return $form1;
        }
        return $form3;
    }
}
