---
title: Rails-footnote и RubyMine
announce: Как связать xdebug-backtrace с PhpStorm и rails-footnotes с RubyMine
alias: connect-xdebug-backtrace-with-phpstorm-and-foornotes-with-rubymine
tags: продуктивность
date: 2013-01-22
---

### PhpStorm  и Xdebug

В backtrace'е у XDebug предусмотрен простой переход к нужному файлу и на нужную строку. Только использует он протокол txmt (TextMate), что не пригодно с PhpStorm.

![](/dev/2013-01-22-connect-xdebug-backtrace-with-phpstorm-and-foornotes-with-rubymine/xdebug.png)


Решение нашел тут: [http://youtrack.jetbrains.com/issue/IDEA-65879](http://youtrack.jetbrains.com/issue/IDEA-65879)

Ставим плагин Remote Call: [http://plugins.jetbrains.net/plugin?pr=webide&pluginId=6027](http://plugins.jetbrains.net/plugin?pr=webide&pluginId=6027)

И прописываем в конфиге xdebug:

```
xdebug.file_link_format = "javascript: var r = new XMLHttpRequest; r.open(\"get\", \"http://localhost:8091?message=%f:%l\");r.send()"

```


### RubyMine и Rails Footnotes

В Gemfile.rb:

```ruby
gem 'rails-footnotes', '>= 3.7.9', :group => :development
```

$ rails generate rails_footnotes:install

Добавляем фильтр в config/initializers/rails_footnotes.rb:

```ruby
if defined?(Footnotes) && Rails.env.development?
  Footnotes.run! 

  Footnotes::Filter.prefix = "javascript: var r = new XMLHttpRequest; r.open('get', 'http://localhost:8091?message=%s:%d:%d');r.send()"
end

```

![](/dev/2013-01-22-connect-xdebug-backtrace-with-phpstorm-and-foornotes-with-rubymine/footnotes.png)


### Ссылки

[https://github.com/digidigo/ruby_footprints](https://github.com/digidigo/ruby_footprints)

[https://github.com/Zolotov/RemoteCall](https://github.com/Zolotov/RemoteCall)

