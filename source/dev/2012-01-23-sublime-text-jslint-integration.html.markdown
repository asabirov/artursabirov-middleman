---
title: JSLint в Sublime Text
announce: Подключение JSLint в SublimeText
alias: sublime-text-jslint-integration
tags: javascript
date: 2012-01-23
---

Расскажу, как совместить подключить JSLint в  Sublime Text 2.

#cut#

Консольный JSLint — [http://www.javascriptlint.com/download.htm](http://www.javascriptlint.com/download.htm)

Создаем новый build-сценарий: Tools → Build Systems → New Build System

![](/dev/2012-01-23-sublime-text-jslint-integration/sublime_jslint.png)


Вставляем и настраиваем путь до jslint (windows):

~~~javascript
{
   [cmd]()
["d:/lib/jsl/jsl.exe", "-process", "$file"],
   [selector]()
"source.js"
}

~~~

Сохраняем файл, жмем CTRL+B и смотрим результат.

![](/dev/2012-01-23-sublime-text-jslint-integration/sublime_jslint2.png)

