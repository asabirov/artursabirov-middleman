---
title: Foreman
announce: Установка и применение foreman
alias: gem-foreman
tags: ruby
date: 2011-08-29
---

Во время разработки приходится запускать множество процессов: thin, faye, spork, sphinx, node.js. Пр. У каждого проекта своё окружение и переключение между ними занимает не мало времени.  Упростить задачу может Foreman.

### Установка

~~~bash
gem install foreman
~~~

Создаем конфиг Procfile, в котором прописываем все процессы для запуска.


~~~
spork: spork
thin: bundle exec rails s thin -p 3003
faye: bundle exec rackup faye.ru -s thin -E development
resque_sheduler: bundle exec rake resque:scheduler

~~~

### Использование

Запуск всех разом

~~~
foreman start

~~~

Или только необходимые

~~~
foreman start thin, faye

~~~

### Автозапуск

Генерация скрипта для inittab:

~~~
foreman export inittab

~~~

и upstart:

~~~
foreman export upstart

~~~


### Ссылки

Документация — [http://ddollar.github.com/foreman/](http://ddollar.github.com/foreman)

Репозиторий — [https://github.com/ddollar/foreman](https://github.com/ddollar/foreman)


### Резюме

Foreman'у не не хватает запуска в фоновом режиме. Чтобы каждый процесс можно было перезапустить не задев остальные. В остальном же со своей задачей прекрасно справляется.