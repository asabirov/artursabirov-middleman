---
title: Cramp и Rails
announce: Как совместить сайт Rails c Cramp или Node.JS.
alias: assync-servers
tags: rails, ruby, node.js, erlang
date: 2011-10-19
---


Если вам нужна асинхронность, то лучше сразу задуматься, нужен ли rails вовсе. На Cramp или Node.js можно без проблем совместить comet-транспорт с обычными http-request'ами. Cramp хорошо сочитается с Sinatra, который недавно обзавелся своей версией [Assets Pipeline](https://github.com/stevehodgkiss/sinatra-asset-pipeline.)


### Cramp

[Cramp](http://cramp.in/.)
Легкий фреймворк, использует EventMachine и файберсы. Умеет  работать с http, веб-сокетами, flash-сокетами и long-polling-запросами для старых браузеров.

Пример приложения на Cramp взят отсюда — http://www.html5rocks.com/en/tutorials/casestudies/sunlight_streamcongress.html.

app.ru

~~~
require "rubygems"
require "bundler"
Bundler.require
require 'cramp'
require 'http_router'
require 'active_support/json'
require 'thin'

Cramp::Websocket.backend = :thin # используем асинхронный сервер thin

class LiveSocket < Cramp::Websocket
   periodic_timer :check_activities, :every => 15

   def check_activities
     @latest_activity ||= nil
     new_activities = find_activities_since(@latest_activity)
     @latest_activity = new_activities.first unless new_activities.empty?
     render new_activities.to_json
   end
 end

routes = HttpRouter.new do
  add('/live').to(LiveSocket)
end
run routes

~~~

Запуск приложения

~~~
bundle exec thin --timeout 0 -R app.ru start

~~~

### Goliath

Сам я лично с ним не работал, но и упомянуть о нем не мог. Довольно известное решение в узких кругах. Посмотрите обязательно — [https://github.com/postrank-labs/goliath](https://github.com/postrank-labs/goliath.)


### Node.js

Это конечно не ruby-way, зато выбор ноды дает нам некоторое [преимущество в производительности](http://posterous.mclov.in/unscientific-nodejs-vs-cramp-benchmarks.)
Что будет немаловажным при нагрузках.

Дополнительные npm модули для транспорта и маршрутизации:

* [Faye](http://faye.jcoglan.com.)

* [Jaggernaut](https://github.com/maccman/juggernaut)
* [Socket.io](https://github.com/learnboost/socket.io)

Подойдет любой из них. Возможности у них примерно равны.

Пример приложения с использованием Faye (app.js):


~~~javascript
var Faye   = require('faye'),
    server = new Faye.NodeAdapter({mount: '/live'});

server.listen(9292); // создаем сервер

var client = server.getClient()

// прослушка канала messages
client.subscribe('/messages', function(message) {
  alert(message.text);
});

// публикация в канал messages
client.publish('/messages', {
  text: 'Hello world'
});

~~~

Запуск:

~~~forever app.js~~~


### Erlang

Сложность языка накладывают свои ограничения по скорости разработки и квалификации, но это лучший выбор если вы ограничены в серверных ресурсах.

Пример работы с веб-сокетами на фреймворке MochiWeb — [https://github.com/RJ/mochiweb-websockets/tree/master/examples/websockets](https://github.com/RJ/mochiweb-websockets/tree/master/examples/websockets)


### Склейка 

Ситуация теперь следующая. Сайт на 80м порту (пусть будет Nginx), real-time сервер на 9292. Чтобы избежать нарушения [same-origin-policy](http://en.wikipedia.org/wiki/Same_origin_policy)
нам потребуется объединить обе части сервера. 

Этой проблемы можно было избежать, написав всё на Node.JS или Cramp. О чем говорил в начале статьи.


### HAPRoxy

Сам Nginx не умеет маршрутизировать websocket'ы и http на одном хосте. В этом поможет HAProxy — очень простой и производительный proxy-сервер.

~~~
wget http://haproxy.1wt.eu/download/1.4/src/haproxy-1.4.18.tar.gz
tar zxvf http://haproxy.1wt.eu/download/1.4/src/haproxy-1.4.18.tar.gz
mv haproxy-1.4.18 /usr/local/haproxy
ln -s /usr/local/haproxy/haproxy /usr/sbin/haproxy

~~~

Скрипт автозапуска для CentOS:

~~~bash
# description: HA-Proxy is a TCP/HTTP reverse proxy which is particularly suited \
#              for high availability environments.
# processname: haproxy
# chkconfig: 345 20 80
# config: /etc/haproxy.cfg
# pidfile: /var/run/haproxy.pid

# Source function library.
if [ -f /etc/init.d/functions ]; then
  . /etc/init.d/functions
elif [ -f /etc/rc.d/init.d/functions ] ; then
  . /etc/rc.d/init.d/functions
else
  exit 0
fi

# Source networking configuration.
. /etc/sysconfig/network

# Check that networking is up.
[ ${NETWORKING} = "no" ] && exit 0

[ -f /etc/haproxy.cfg ] || exit 1

RETVAL=0

start() {
  /usr/sbin/haproxy -c -q -f /etc/haproxy.cfg
  if [ $? -ne 0 ]; then
    echo "Errors found in configuration file."
    return 1
  fi

  echo -n "Starting HAproxy: "
  daemon /usr/sbin/haproxy -D -f /etc/haproxy.cfg -p /var/run/haproxy.pid
  RETVAL=$?
  echo
  [ $RETVAL -eq 0 ] && touch /var/lock/subsys/haproxy
  return $RETVAL
}

stop() {
  echo -n "Shutting down HAproxy: "
  killproc haproxy -USR1
  RETVAL=$?
  echo
  [ $RETVAL -eq 0 ] && rm -f /var/lock/subsys/haproxy
  [ $RETVAL -eq 0 ] && rm -f /var/run/haproxy.pid
  return $RETVAL
}

restart() {
  /usr/sbin/haproxy -c -q -f /etc/haproxy.cfg
  if [ $? -ne 0 ]; then
    echo "Errors found in configuration file, check it with 'haproxy check'."
    return 1
  fi
  stop
  start
}

check() {
  /usr/sbin/haproxy -c -q -V -f /etc/haproxy.cfg
}

rhstatus() {
  status haproxy
}

condrestart() {
  [ -e /var/lock/subsys/haproxy ] && restart || :
}

# See how we were called.
case "$1" in
  start)
    start
    ;;
  stop)
    stop
    ;;
  restart)
    restart
    ;;
  reload)
    restart
    ;;
  condrestart)
    condrestart
    ;;
  status)
    rhstatus
    ;;
  check)
    check
    ;;
  *)
    echo $"Usage: haproxy {start|stop|restart|reload|condrestart|status|check}"
    RETVAL=1
esac

exit $RETVAL

~~~

~~~
chkconfig haproxy on

~~~

Настроим конфигурацию для адреса 85.17.162.170. Nginx будет 8081 порту, Node.JS на 9292. Вместо Node.JS может быть любой бэкэнд, конфиг от этого не сильно изменится.

/etc/haproxy.conf

~~~
global
    maxconn	4096
    spread-checks 5
    pidfile	/var/run/haproxy.pid
    
    user	haproxy
    group	haproxy
    
defaults
    mode http
    option forwardfor
    option abortonclose
    option httpclose
    no option accept-invalid-http-request
    no option accept-invalid-http-response
    option forwardfor except 127.0.0.1 header X-Forwarded-For

frontend all 85.17.162.170:80
    timeout client 1d
    
    acl is_nodejs url_sub faye # если мы используется Faye
    acl is_nodejs hdr(upgrade) -i websocket # определяем веб-сокеты по заголовкам
    acl is_nodejs hdr_beg(Host) -i ws # определяем веб-сокеты по ws://
    use_backend nodejs_backend if is_nodejs # нужные отправляем на Node.JS
    default_backend   nginx_backend    # остальные на nginx
    
backend nodejs_backend
    server server1 85.17.162.170:9292 maxconn 200 check
    balance roundrobin    
    timeout queue 5s
    timeout server  86400000
 
backend nginx_backend
    balance roundrobin
    option forwardfor
    timeout connect 100s    
    timeout server 25s
    server server1 85.17.162.170:8081 check

~~~

Необходимо убедиться, что Nginx больше не прослушивает 80й порт и в конфигах стоит "listen 85.17.162.92:8081".

Запуск.

~~~
service haproxy start

~~~


### Frontend

Рассмотрим на примере с Faye. 

Подключаем faye.js. 

~~~html
<script type="text/javascript" src="http://domain.com/faye.js"></script>
~~~

Этот файл генерируется самим faye.

Подключаемся к каналу /messages:

~~~html
var client = new Faye.Client('http://domain.com/live');
var subscription = client.subscribe('/messages', function(message) {
    console.log(message)
});

~~~


### Frontend

Рассмотрим на примере с Faye. 

Подключаем faye.js. 

~~~html
<script type="text/javascript" src="http://domain.com/faye.js"></script>
~~~

Этот файл генерируется самим faye.

Подключаемся к каналу /messages:

~~~html
var client = new Faye.Client('http://domain.com/live');
var subscription = client.subscribe('/messages', function(message) {
    console.log(message)
});

~~~


### Резюме

Real-time приложения требуют особого подхода и далеко не все классические инструменты подходят для этих целей. Ruby хоть умеет создавать треды, обладает реализацией eventmachine и даже облегчает код файберсами, но сильно проигрывает в производительности асинхронным технологиям. В Node.JS и Erlang изначально были продуманы проблемы многозадачности и эффективного использования ресурсов. В real-time приложениях это может быть критически важным фактором.