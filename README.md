# zolo



## Getting started

To make it easy for you to get started with GitLab, here's a list of recommended next steps.

Already a pro? Just edit this README.md and make it your own. Want to make it easy? [Use the template at the bottom](#editing-this-readme)!

## Add your files

- [ ] [Create](https://docs.gitlab.com/ee/user/project/repository/web_editor.html#create-a-file) or [upload](https://docs.gitlab.com/ee/user/project/repository/web_editor.html#upload-a-file) files
- [ ] [Add files using the command line](https://docs.gitlab.com/ee/gitlab-basics/add-file.html#add-a-file-using-the-command-line) or push an existing Git repository with the following command:

```
cd existing_repo
git remote add origin https://gitlab.qsoft.ru/development/zolo.git
git branch -M master
git push -uf origin master
```

## Integrate with your tools

- [ ] [Set up project integrations](https://gitlab.qsoft.ru/development/zolo/-/settings/integrations)

## Collaborate with your team

- [ ] [Invite team members and collaborators](https://docs.gitlab.com/ee/user/project/members/)
- [ ] [Create a new merge request](https://docs.gitlab.com/ee/user/project/merge_requests/creating_merge_requests.html)
- [ ] [Automatically close issues from merge requests](https://docs.gitlab.com/ee/user/project/issues/managing_issues.html#closing-issues-automatically)
- [ ] [Enable merge request approvals](https://docs.gitlab.com/ee/user/project/merge_requests/approvals/)
- [ ] [Automatically merge when pipeline succeeds](https://docs.gitlab.com/ee/user/project/merge_requests/merge_when_pipeline_succeeds.html)

## Test and Deploy

Use the built-in continuous integration in GitLab.

- [ ] [Get started with GitLab CI/CD](https://docs.gitlab.com/ee/ci/quick_start/index.html)
- [ ] [Analyze your code for known vulnerabilities with Static Application Security Testing(SAST)](https://docs.gitlab.com/ee/user/application_security/sast/)
- [ ] [Deploy to Kubernetes, Amazon EC2, or Amazon ECS using Auto Deploy](https://docs.gitlab.com/ee/topics/autodevops/requirements.html)
- [ ] [Use pull-based deployments for improved Kubernetes management](https://docs.gitlab.com/ee/user/clusters/agent/)
- [ ] [Set up protected environments](https://docs.gitlab.com/ee/ci/environments/protected_environments.html)

***

# Editing this README

When you're ready to make this README your own, just edit this file and use the handy template below (or feel free to structure it however you want - this is just a starting point!).  Thank you to [makeareadme.com](https://www.makeareadme.com/) for this template.

## Suggestions for a good README
Every project is different, so consider which of these sections apply to yours. The sections used in the template are suggestions for most open source projects. Also keep in mind that while a README can be too long and detailed, too long is better than too short. If you think your README is too long, consider utilizing another form of documentation rather than cutting out information.

## Name
Choose a self-explaining name for your project.

## Description
Let people know what your project can do specifically. Provide context and add a link to any reference visitors might be unfamiliar with. A list of Features or a Background subsection can also be added here. If there are alternatives to your project, this is a good place to list differentiating factors.

## Badges
On some READMEs, you may see small images that convey metadata, such as whether or not all the tests are passing for the project. You can use Shields to add some to your README. Many services also have instructions for adding a badge.

## Visuals
Depending on what you are making, it can be a good idea to include screenshots or even a video (you'll frequently see GIFs rather than actual videos). Tools like ttygif can help, but check out Asciinema for a more sophisticated method.

## Installation
Within a particular ecosystem, there may be a common way of installing things, such as using Yarn, NuGet, or Homebrew. However, consider the possibility that whoever is reading your README is a novice and would like more guidance. Listing specific steps helps remove ambiguity and gets people to using your project as quickly as possible. If it only runs in a specific context like a particular programming language version or operating system or has dependencies that have to be installed manually, also add a Requirements subsection.

## Usage
Use examples liberally, and show the expected output if you can. It's helpful to have inline the smallest example of usage that you can demonstrate, while providing links to more sophisticated examples if they are too long to reasonably include in the README.

## Support
Tell people where they can go to for help. It can be any combination of an issue tracker, a chat room, an email address, etc.

## Roadmap
If you have ideas for releases in the future, it is a good idea to list them in the README.

## Contributing
State if you are open to contributions and what your requirements are for accepting them.

For people who want to make changes to your project, it's helpful to have some documentation on how to get started. Perhaps there is a script that they should run or some environment variables that they need to set. Make these steps explicit. These instructions could also be useful to your future self.

You can also document commands to lint the code or run tests. These steps help to ensure high code quality and reduce the likelihood that the changes inadvertently break something. Having instructions for running tests is especially helpful if it requires external setup, such as starting a Selenium server for testing in a browser.

## Authors and acknowledgment
Show your appreciation to those who have contributed to the project.

## License
For open source projects, say how it is licensed.

## Project status
If you have run out of energy or time for your project, put a note at the top of the README saying that development has slowed down or stopped completely. Someone may choose to fork your project or volunteer to step in as a maintainer or owner, allowing your project to keep going. You can also make an explicit request for maintainers.


## Браузеры

Вёрстка должна корректно отображаться в двух последних версиях следующих браузеров:
- **Internet Explorer** (11 версия)
- **Mozilla Firefox** (две последние версии)
- **Google Chrome** (две последние версии)
- **Safari** (две последние версии)
- **Yandex.Браузер** (две последние версии)
- **Opera** (две последние версии)
- **Microsoft Edge** (две последние версии)


## Структура проекта

### Корень
Корень проекта находится в директории:
`/var/www/zolo/[host_name]/`

### Исходники
Шрифты, иконки, исходники стилей и скриптов лежат в директории `/assets/`.

Директория с исходниками включает в себя следующие поддиректории:
```
fonts/ - содержит файлы со шрифтами
images/ - содержит статические картинки, которые не будут меняться (например, логитип)
icons/ - содержит файлы с svg-иконками, которые затем собираются в шрифтовой спрайт
    svg/
js/ - содержит js
scss/ - содержит исходники файлов со стилями, которые затем преобразуются в один общий файл стилей
    abstract/
    base/
    components/
```


### Готовые файлы проекта
Собранные стили и скрипты, и разметка находятся в `/app/core/local/templates/.default`.
Исходники из `/assets/` после компиляции преобразуются в файлы, которые помещаются в директорию `/app/core/local/templates/.default`.

## Сборщик
На проекте используется сборщик **Webpack**.

Запускается сборщик из корня проекта.

Команды для сборки:
- `npm start` - запуск слежения за файлами.
- `npm run build` - запуск единоразовой сборки проекта.


## Стили

### Препроцессор
Для написания стилей используется препроцессор **Sass** (синтаксис **scss**).

### БЭМ
Стили пишутся по методологии **БЭМ**, где:
`block-name` - блок,  
`block-name__element-name` - элемент,  
`block-name--modifier-name` - модификатор.

Внутри блока описывается внутреняя геометрия и стилизация. Для указания внешней геометрии (позиционирования, отступов и т.д.) испольузем миксы.

Ни один блок не должен влиять на другие блоки и их элементы. Если необходимо выполнить дополнительную стилизацию блока, находящегося внутри другого, то так же используем микс.
``` html
<a class="link" title="Перейти">
    Скачать <i class="link__icon icon icon--arrow"></i>
</a>
```

``` css
// Так нельзя
.link {
    .icon {
        color: $orange;
    }
}

// А вот так можно
.link {
    &__icon {
        color: $orange;
    }
}
```


### Структура
Исходники стилей находятся в поддиректории `scss/`, структура данной поддиректории выглядит следующим образом:
```
abstract/ - содержит "абстракции": функции, миксины, переменные, которые часто используются при стилизации
    _function.scss - содержит описание основных функций
    _mixin.scss - содержит описание основных часто повторяющихся блоков кода (миксинов)
    _variables.scss - содержит описание основных переменных

base/ - содержит подключение шрифтов и базовую стилизацию тегов
    _fonts.scss - содержит подключение шрифтов
    _generic.scss - содержит базовую стилизацию тегов
    _typography.scss - содержит базовую стилизацию тегов


components/ - содержит стилизацию компонентов
    _component-name.scss - содержит стилизацию конкретного компонента

style.scss - главный файл, в который испортируются все остальные
```

Названия всех файлов начинается с нижнего подчёркивания. Имя файла в поддиректории `components/` должно быть таким же, как имя блока, для стилизации которого создан данный файл.


Все файлы подключаются вручную в `style.scss`, например:
``` css
@import 'components/button';
```

Сначала в `style.scss` подключаются стили плагинов, затем стили "абстракций", после - базовые стили, а в завершение всего стили компонентов:
``` css
@import '~plugin-name.scss';

@import 'abstracts/settings';
@import 'abstracts/functions';
@import 'abstracts/mixins';

@import 'base/fonts';
@import 'base/generic';
@import 'base/typography';

@import 'components/button';
```

### CSS-свойства
В файлах `scss` свойства объединяются по смыслу, порядок следования должен соответствовать [css-comb](https://github.com/csscomb/csscomb.js/blob/master/config/csscomb.json). Каждая логическая группа свойств отделяется пустой строкой.

``` css
.container {
    position: relative;

    display: flex;
    align-items: center;
    justify-content: space-between;

    height: 100%;
}
```


### Порядок описания стилей
``` css
.container {
    // Сначала идут стили, описывающие сам блок
    position: relative;

    display: flex;
    align-items: center;
    justify-content: space-between;

    // Затем идут стили для медиазапросов
    @media #{$screen-medium} {
        position: static;
    }

    @media #{$screen-huge} {
        flex-direction: column;
    }

    // После - псевдоэлементы
    &::before {
        position: absolute;
        top: 0;
        left: 0;

        display: block;

        width: rem(10px);
        height: rem(10px);

        content: "";

        background-color: $background-color;
    }

    // Далее - псевдоклассы
    &:hover {
        color: $brand-color;

        @media #{$screen-tablet} {
            color: $brand-color-secondary;
        }
    }

    // Затем - модификаторы
    &--small {
        width: 40%;
    }

    // И после всего - описание элементов, внутри которых сохраняется тот же порядок следования стилей
    &__box {
        width: 50%;
        padding-left: rem(15px);

        &--special {
            position: relative;

            width: 30%;
            padding-right: rem(10px);

            @media #{$screen-tablet} {
                width: 100%;
            }
        }

        &-title {
            font-weight: 700;

            margin-bottom: rem(10px);
        }
    }

    &__icon {
        display: inline-block;

        &:hover {
            transform: scale(1.5);
        }

        &-pic {
            font-size: rem(12px);
        }
    }
}
```


### Работа с часто используемыми переменными
Перед началом нужно работы обязательно ознакомиться с файлом `scss/abstract/_variables.css`.


**Цвета**
``` css
// Переменные со статическими цветами
$white: #ffffff;
$black: #333333;
$mine-shaft: #383838;
$supernova: #ffc700;
...


// На основе переменных со статическими цветами созданы динамические цветовые переменные. 
$text-color: $black;
$text-color-inverse: $white;

$background-color: $white;
$background-color-light: $porcelain;

$brand-color: $outrageous-orange;
$brand-color-secondary: $pale-sky;
...
```


Если при стилизации блока нужно задать какой-то цвет, то сначала ищем динамическую переменную, соответствующую нужному цвету.  Если такой не находится, то берем статическую переменную. И уже в крайних случаях, когда переменной с нужным цветом не найдено, используем цвет напрямую.
``` css
// Сначала ищем динамические переменные
color: $brand-color;

// Если не найдено - статическую
border-color: $supernova;

// Крайний случай - указание напрямую
background-color: #f09083;
```


**Размер шрифта**
Для задания часто повторяющихся размеров шрифтов созданы миксины. Если размеры шрифтов не соответствуют тем, что есть в миксины, то ищем соответствующие переменные и присваиваем их. Если не находим - пишем напрямую.
``` css
...
$font-size-huge: 36px;
$line-height-huge: 50px;

$font-size-large: 24px;
$line-height-large: 28px;

$font-size-big: 18px;
$line-height-big: 24px;

$font-size-medium: 14px;
$line-height-medium: 20px;
...
```

``` css
// Задаем ищу существующую переменную
.spoiler {
    font-size: rem($font-size-large);
}

// Если нужной переменной нет - задаем напрямую
.spoiler {
    font-size: rem(27px);
}
```


### REM
Все значения, заданные в пикселях, необходимо переводить в **rem**, использую функцию `rem()`.

``` css
.spoiler {
    font-size: rem($font-size-big);

    margin-top: rem(15px);
    margin-bottom: rem(25px);

    border-bottom: rem(1px) solid;
    box-shadow: 0 0 rem(2px) rgba($killarney, 0.5);
}
```


### Избегаем magic number
В коде должно быть минимальное количество мест, в которых задаются непонятно откуда взятые цифры. Т.к. используется препроцессор, то вычисления нужно производить непосредственно в scss.
``` css
// Плохо
.tooltip {
    line-height: 1.635;
}

.banner {
    width: 63.83768%;
}

// Хорошо
.tooltip {
    $font-size: 13px;

    font-size: $font-size;
    line-height: (16px / $font-size);
}

.banner {
    $banner-width-by-design: 545px;

    width: percent($banner-width-by-design / $window-width-at-desktop);
}
```

### Избегаем дублирования имени блока при стилизации вложенных элементов
Имя блока должно встречаться в файле только один раз - в самом верху. Вся стилизация вложенных элементов производится за счет использования амперсанда.
``` css
// Плохо
.table {
    &--grey {
        border-bottom: rem(1px) solid $dark;

        .table__row {
            background-color: $grey;
        }
    }

    &__thead {
        font-size: rem(20px);

        .table__col {
            padding: rem(10px);
        }
    }

    &__col {
        padding: rem(5px);
    }
}

// Хоршо
.table {
    &--grey {
        border-bottom: rem(1px) solid $dark;
    }
    &--grey & {
        &__row {
            background-color: $grey;
        }
    }

    &__thead {
        font-size: rem(20px);
    }
    &__thead & {
        &__col {
            padding: rem(10px);
        }
    }

    &__col {
        padding: rem(5px);
    }
}
```
