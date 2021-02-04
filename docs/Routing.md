
# Маршрутизация. SimpleMVC

## Главный вопрос маршрутизации

Далее рассмотрим подробнее _как именно система понимает какой именно [контроллер](Controllers.md) соответствует данному маршруту_.

Для начала можно считать, что маршрут - это просто адрес запрашиваемой страницы. Сначала мы расмотрим схему и порядок взаимодействия Ядра и Приложения, а после уточним смысл понятия "Маршрут" более детально.


## Схема работы прихожения

Кратко описать процесс работы фреймворка можно так:

1. У Приложения есть единственный файл (т.н. "**точка входа**" в нашем случае это файл [web/index.php](https://github.com/it-for-free/SimpleMVC-example/blob/master/web/index.php)), с которого начинается обработка _любого_ запроса пришедшего от клиента (см. [подробнее о Клиент-Серверной архитектуре](http://fkn.ktu10.com/?q=node/9330)). Т.е. это означается что _все_ скрипты нашего сайта начинают работать именно с этого файла.
2. В точке входа Приложение получается экземпляр класса `\ItForFree\SimpleMVC\Application` ([см. реализацию](https://github.com/it-for-free/SimpleMVC/blob/master/src/Application.php) - отвечает за работу ядра в целом, подключая по мере необходимости другие части ярда), устанавливает ему конфигурацию (о получении конфигурции поговорим в следующих разделах) и запускает его, вызвав метод `run()`:
 
 ```php
 \ItForFree\SimpleMVC\Application::get()
    ->setConfiguration($config)
    ->run();
 ```
3. Вызов метода `run()` фактически запускает функционал ядра, который, анализируя текущее состояние адреса страницы (URL), принимает решение о том, _какой контроллер отвечает за данный адрес_ и какое именно _действие котроллера_ должно быть вызвано. Далее  фрагмент кода из метода `run()`:

```php
// .....
$route = $this->getConfigObject('core.url.class')::getRoute();
/**
* @var \ItForFree\SimpleMVC\Router
*/
$Router = $this->getConfigObject('core.router.class');
$Router->callControllerAction($route); // определяем и вызываем нужно действие контроллера
// .....
```
-- как видим за процесс определения имени контроллера, имени действий и их вызов происходят в методе `callControllerAction()`, реализованном  уже другой классе Ядра, а именно `\ItForFree\SimpleMVC\Router` ([исх. код](https://github.com/it-for-free/SimpleMVC/blob/master/src/Router.php)).


**Ещё раз схема работы, но теперь кратко**

Таким, образом можно сказать, что взаимодействие Приложения и Ядра в части маршрутизации проходят по цепочке в таком порядке (по времени работы кода Приложения или Ядра):

 1. `Приложение` (запускает функционал ядра через `Applliction->run()` в своей точке входа)
 2. `Ядро` (используя свои классы определяет контроллер и действие, соответствующие маршруту (url) создает экземпляр контроллера и вызывает на нем метод)
 3. `Приложение` (выполняется код действий контроллера, и все что это действие вызовет)


## Маршрут

**Маршрут** - это некая строка (или подстрока) в адресе страницы (обычно она так или иначе присутствует в адресах всех страниц сайта), которая соспосталяется движком приложения с конкретным сценарием работы.

Т.е. можно сказать, что маршрут является частью URL, на который приходит запрос клиента. Какая именно часть считается маршрутом - зависит уже от сервера (т.е. от нашего Приложения).

### Придаставление маршрута в адресе страницы

Например, есть адрес:
```
http://example.loc/user/list
```

Для Приложения интерес здесь предствляет та часть URL, что идет после доменного имени - в данном случае это `user/list`, ведь именно её можно ассоциировать в логике системы с каким-нибудь дейтсвием (в данном случае логично напрашивается вывод списка пользователей).

Рассмотрим пример маршрута из Приложения SimpleMVC-example, авторизуемся под админом (его учетная запись есть в дампе стартовой БД) и перейдем на страницу списка пользователей, тогда в адресной строке браузера мы увидим адрес вроде:

```
http://smvc.loc/index.php?route=admin/adminusers/index
```

Здесь значением маршрута для движка (в нашем случае - Ядра SimplrMVC) будет являтся значение GET-параметра `route` в данном случае это значение равно `admin/adminusers/index`

## Как маршрут сопоставляется с действие контроллера

Как уже говорилось выше, за сопоставление отвечает `\ItForFree\SimpleMVC\Router`

