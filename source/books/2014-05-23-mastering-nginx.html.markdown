---
title: Mastering Nginx
alias: mastering-nginx
date: 2014-05-23 13:47 MSK
tags: Инструменты
feed_prefix: Книги
image: mastering-nginx.jpg
---


Книга состоит из перечня директив с их описанием и несколькими use-case’ами.
Рассказывается, как настроить ssl, банасировку бекендов, как ограничить доступ и защитить бекенд от ddos’а.


###Несколько кейсов из книги

Регулярные выражения создают глобальные переменные ($1, $2, $3…), как во многих популярных языках:

~~~nginx
rewrite '^/images/([a-z]{2})/([a-z0-9]{5})/(.*)\.(png|jpg|gif)$' / data?file=$3.$4 last;
~~~

Или в логах:

~~~nginx
log_format imagelog '[$time_local] $image_file $image_type '
    '$body_bytes_sent $status';

location / {
    rewrite ^/(.*)\.(png|jpg|gif)$ /images/$1.$2;
    set $image_file $1;
    set $image_type $2;
}

access_log logs/example.com-images_access.log imagelog;
~~~

Генерация статической страницы:

~~~nginx
location = /image404.html {
    return 404 "image not found\n";
}
~~~


Примитивная защита от DDOS. Ограничение в 1 запрос в секунду для ip-адреса:

~~~nginx
http {
     limit_req_zone $binary_remote_addr zone=requests:10m rate=1r/s;
     limit_req_log_level warn;
     server {
          limit_req zone=requests burst=10 nodelay;
     }
}
~~~

Или 10 запросов в течение 10 минут:

~~~nginx
http {
      limit_conn_zone $binary_remote_addr zone=connections:10m;
      limit_conn_log_level notice;
      server {
          limit_conn connections 10;
      }
}
~~~

Кэширование всех запросов к бекенду в memcache:

~~~nginx
server {
    location / {
        set $memcached_key "$uri?$args»;
        memcached_pass 127.0.0.1:11211;
        error_page 404 502 504 = @app;
    }
    location @app {
        proxy_pass 127.0.0.1:8080;
    }
}
~~~


Ничего интереснее об nginx’у я не нашел, но и эта книга вполне поможет узнать много нового об этом веб-сервере.
