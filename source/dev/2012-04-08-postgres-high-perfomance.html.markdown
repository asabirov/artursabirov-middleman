---
title: PostgreSQL 9.0 High Performance
announce: Избранное из книги PostgreSQL 9.0 High Performance
alias: postgres-high-perfomance
tags: postgresql
date: 2012-04-08
---

Читая книгу [PostgreSQL 9.0 High Performance](http://www.goodreads.com/book/show/10033368-postgresql-9-0-high-performance,)
выписал некоторые интересные моменты, которые могут оказаться полезными простым разработчикам.



## Полезные команды.

EXPLAIN ANALYZE [sql] — анализ выполненного запроса (используемые ноды, время выполнения, использование индексов).

VACUUM — дефрагментация базы. Можно запускать, если отключен autovacuum. Рекомендуется выполнять после большого удаления данных.

REINDEX INDEX [index_name] — перестройка индекса.

REINDEX TABLE [table_name] — перестройка индексов всей таблицы.


## Анализаторы логов

* [pgFouine](http://pgfouine.projects.postgresql.org/,)
* [pgsi](http://bucardo.org/wiki/Pgsi,)
* [mk-query-digest](http://www.maatkit.org/doc/mk-query-digest.html)

pgFouine — наиболее удобный, хоть и требует веб-сервер для запуска.

## Рекомендации по использованию индексов

Ставьте индексы на поля, по которым происходит поиск или сортировка.

Исключите использование ненужных индексов (найти их поможет EXPLAIN ANALYZE)



## Индексы

B-Tree – индекс по-умолчанию. Подходит для всех типов.

Hash — эффективен при поиске по равенству: column_name = 'value'.

GIN — дает быстрый поиск, но долгое обновление при INSERT. Применим для полнотекстового поиска.

GiST — для полнотекстового поиска. Быстрый поиск, но долгое обновление индекса. Так же применим для полнотекстового поиска.


При поиске с использованием LIKE или POSIX задать специальный параметр: 

~~~sql
CREATE INDEX index_name ON table_name(column_name varchar_pattern_ops);
~~~
Для других типов: text_pattern_ops, bpchar_pattern_ops, name_pattern_ops.


## Составной индекс

При поиске по по двум и более колонкам можно использовать составной индекс:

~~~sql
CREATE INDEX index_name ON table_name(col_1, col_2);
~~~

## Частичный индекс

В случае, если поиск совершается только по какому-то одному значению:

~~~sql
CREATE INDEX index_name ON table name WHERE column_name IS value;
~~~

## Сортировка индексов

При сортировке по индексу в одну сторону, например DESC, можно настроить и сам индекс:

~~~sql
CREATE INDEX index_name ON  table_name(column_name DESC);
~~~

Если имеются значения NULL, можно подвинуть их в начало:

~~~sql
CREATE INDEX index_name ON  table_name(column_name NULLS FIRST);
~~~

По умолчанию значения NULL хранятся в конце.


## Обработка значений в индексе

Если в запросах используются функции:

~~~sql
SELECT * FROM table_name WHERE lower(column_name) = 'x';
~~~

Можно подготовить значения и в самом индексе:

~~~sql
CREATE INDEX index_name ON table_name(lower(column_name)); 
~~~

## OFFSET 0

Использование «OFFSET 0» ускорит выполнение вложенных запросов:

~~~sql
SELECT l.prod_id FROM orderlines l
WHERE EXISTS (SELECT * FROM customers JOIN orders USING (customerid) WHERE orders.orderid = l.orderid OFFSET 0)
AND l.orderdate='2004-12-01';
~~~

## Ускорение SELECT count(*)

В PostgreSQL, в отличии от других БД, медленный подсчет строк.

~~~sql
SELECT count(*)  FROM t;
~~~

Его можно ускорить, добавив какое-нибудь условие WHERE:

~~~sql
SELECT count(*) FROM t WHERE k>10 and k<20;
~~~

## FOREIGN KEYS

Добавление и изменение большого количества данных может оказаться медленным из-за использования внешних ключей (FOREIGN KEYS). Поэтому их можно  приглушить до окончания операции:

~~~sql
BEGIN;
SET CONSTRAINTS ALL DEFERRED;
[update or insert statements]
COMMIT;
~~~
