---
title: Генераторы JSON для Rails
announce: Сравнение генераторов json для ruby/rails
alias: rails-json-generators
tags: rails
date: 2011-08-09
---

Сериализация объектов обычное явление в проектах Rails, для этих целей обычно используется сериализатор из ActiveSupport, но для составных контейнеров не очень удобен.

### Нативный ERB

Самый простой вариант.

~~~ruby
class CountriesController < ApplicationController
  def index
    @counties = Country.all
    respond_to do |format|
      format.json render :partial => "countries/index.json"
  end
end
~~~


~~~ruby
<%- @countries.each do |country|%>
{
    'name': '<%= country.long_name %>',
    'code': '<%= country.code %>'
}
<% end -%>
~~~

Выбор старообрядцев.


### RABL

Самый популярный на github.


~~~ruby
gem "json_builder"
~~~

~~~ruby
collection @posts
attributes :id, :title, :subject
child(:user) { attributes :full_name }
node(:read) { |post| post.read_by?(@user) }
~~~

http://localhost:3000/posts.json

~~~json
[{  post :
  {
    id : 5, title: "...", subject: "...",
    user : { full_name : "..." },
    read : true
  }
}]
~~~

Rabl легко интегрируется в Sinatra и Padrino.

[https://github.com/nesquena/rabl](https://github.com/nesquena/rabl)


### JSON Builder

Второй по популярности.


~~~
gem "json_builder"
~~~

<br />

~~~ruby
class PostsController < ApplicationController
  respond_to :json
  
  def index
    @posts = Post.all
    respond_with @posts
  end
end
~~~


~~~ruby
json.posts do
  json.array! @posts do
    @posts.each do |user|
      json.array_item! do
        render :partial => 'post', :locals => { :json => json, :post => post }
      end
    end
  end
end
~~~


http://localhost:3000/posts.json

~~~json
{
  [posts]()
[
    {
      id: 1,
      name: "Garrett Bjerkhoel",
      body: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod."
    }, {
      id: 2,
      name: "John Doe",
      body: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod."
    }
  ]
}

~~~

Разработчик отмечает отличную скорость генерации. Только вот низкоуровневая работа с типами совсем не вызывает восторга.


[https://github.com/dewski/json_builder](https://github.com/dewski/json_builder)


### Jsonify

Совсем новый проект, стремительно набирающий популярность.


~~~ruby
gem "jsonify-rails"
~~~


~~~ruby
json.post do
  json.title @post.title
  json.body_plain @post.body_plain
  json.body_html @post.body
end
~~~

http://localhost:3000/posts.json

~~~json
{
    post :{
        title: "...",
        body_plain:  "...",
        body_html: ""
    }
}
~~~

[https://github.com/bsiggelkow/jsonify](https://github.com/bsiggelkow/jsonify)

[Wrapper для Rails — https://github.com/bsiggelkow/jsonify-rails](https://github.com/bsiggelkow/jsonify-rails)



### Argonaut, Tokamak и Tequila

Проекты скорее мертвые, чем просто «стабильные». Argonaut и Tokamak не совместимы с Rails 3.1. 

[https://github.com/abril/tokamak](https://github.com/abril/tokamak)


[https://github.com/jbr/argonaut](https://github.com/jbr/argonaut)

[http://inem.github.com/tequila.html](http://inem.github.com/tequila.html)

Мой выбор пал на jsonify, благодаря простому DSL.