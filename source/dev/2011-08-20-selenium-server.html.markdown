---
title: Selenium Server на CentOS
description: Как установить и использовать Selenium на CentOS в консольном режиме.
alias: selenium-server
tags: тестирование
date: 2011-08-20
---

### Установка

Для начала потребуется виртуальный буфер для эмуляции иксов.

```
yum install Xvfb

```

Скрипт автозагрузки:

```bash
#!/bin/bash
#
# /etc/rc.d/init.d/xvfbd
#
# chkconfig: 345 95 28
# description: Starts/Stops X Virtual Framebuffer server
# processname: Xvfb
#

. /etc/init.d/functions

[ "${NETWORKING}" = "no" ] && exit 0

PROG="Xvfb[
PROG_OPTIONS=](7)
-ac -screen 0 1024x768x24"
PROG_OUTPUT="/tmp/Xvfb.out"

case "$1" in
    start)
        echo -n "Starting : X Virtual Frame Buffer "
        $PROG $PROG_OPTIONS>>$PROG_OUTPUT 2>&1 &
        disown -ar
        /bin/usleep 500000
        status Xvfb & >/dev/null && echo_success || echo_failure
        RETVAL=$?
        if [ $RETVAL -eq 0 ]; then
            /bin/touch /var/lock/subsys/Xvfb
            /sbin/pidof -o  %PPID -x Xvfb > /var/run/Xvfb.pid
        fi
        echo
   		;;
    stop)
        echo -n "Shutting down : X Virtual Frame Buffer"
        killproc $PROG
        RETVAL=$?
        [ $RETVAL -eq 0 ] && /bin/rm -f /var/lock/subsys/Xvfb /var/run/Xvfb.pid
        echo
        ;;
    restart|reload)
    	$0 stop
    	$0 start
        RETVAL=$?
      	;;
    status)
    	status Xvfb
    	RETVAL=$?
    	;;
    *)
     echo $"Usage: $0 (start|stop|restart|reload|status)"
     exit 1
esac

exit $RETVAL

```

Добавим его в автозагрузку и запустим.

```bash
chmod +x /etc/init.d/xvfb
chkconfig xvfb on
service xvfb start

```

Таперь Selenium Server.

```bash
mkdir /usr/local/lib/selenium
cd /usr/local/lib/selenium
wget http://selenium.googlecode.com/files/selenium-server-standalone-2.4.0.jar
mkdir -p /var/log/selenium/
chmod a+w /var/log/selenium/

```

/etc/init.d/selenium

```bash
#!/bin/bash

case "${1:-''}" in
    'start')
        if test -f /tmp/selenium.pid
        then
            echo "Selenium is already running."
        else
            DISPLAY=:7 java -jar /usr/local/lib/selenium/selenium-server-standalone-2.4.0.jar -port 4444 > /var/log/selenium/selenium-output.log 2> /var/log/selenium/selenium-error.log & echo $! > /tmp/selenium.pid
            echo "Starting Selenium..."

            error=$?
            if test $error -gt 0
            then
                echo "${bon}Error $error! Couldn't start Selenium!${boff}"
            echo_success
            fi
        fi
    ;;
    'stop')
        if test -f /tmp/selenium.pid
        then
            echo "Stopping Selenium..."
            PID=`cat /tmp/selenium.pid`
            kill -3 $PID
            if kill -9 $PID ;
                then
                    sleep 2
                    test -f /tmp/selenium.pid && rm -f /tmp/selenium.pid
                else
                    echo "Selenium could not be stopped..."
                fi
        else
            echo "Selenium is not running."
        fi
        ;;
    'restart')
       if test -f /tmp/selenium.pid
        then
            kill -HUP `cat /tmp/selenium.pid`
            test -f /tmp/selenium.pid && rm -f /tmp/selenium.pid
            sleep 1
            java -jar /usr/local/lib/selenium/selenium-server-standalone-2.4.0.jar -port 4444 > /var/log/selenium/selenium-output.log 2> /var/log/selenium/selenium-error.log & echo $! > /tmp/selenium.pid
            echo "Reload Selenium..."
        else
            echo "Selenium isn't running..."
        fi
        ;;
    *)      # no parameter specified
        echo "Usage: $SELF start|stop|restart|reload|force-reload|status"
        exit 1
    ;;
esac

```

Запуск процесса:

```bash
chmod +x /etc/init.d/selenium
chkconfig selenium on
service selenium start

```

Подключение FireFox:

```bash
cd /tmp
wget http://mirror.informatik.uni-mannheim.de/pub/mirrors/mozilla.org/firefox/releases/6.0/linux-i686/en-US/firefox-6.0.tar.bz2
tar xvf firefox-6.0.tar.bz2
mv firefox /usr/local/firefox-6.0
ln -s /usr/local/firefox-6.0/firefox /usr/local/bin/firefox

```

### Результат

Пример скрипта:

```ruby
require 'rubygems'
gem "selenium-client"
require "selenium/client"
@selenium_driver = Selenium::Client::Driver.new \
  :host => "localhost",
  :port => 4444,
  :browser => "*firefox",
  :url => "http://html5test.com/",
  :timeout_in_seconds => 10
@selenium_driver.start_new_browser_session
@selenium_driver.open "/"
@selenium_driver.capture_entire_page_screenshot(File.expand_path(File.dirname(__FILE__)) + 'screenshot.png', '')
@selenium_driver.stop

```

```bash
gem install selenium-client
ruby test.rb
```

### Резюме

Серверный selenium легко подключается к rspec и либо CI. Предоставляет больший выбор браузеров, нежели phantomjs.

Стоит сразу посмотреть [Selenium Grid](http://selenium-grid.seleniumhq.org/.)
Он предназначен для распределенного по нескольким серверам тестирования.