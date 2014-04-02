<?php
/**
 * Export to PHP Array plugin for PHPMyAdmin
 * @version 0.2b
 */

//
// Database `artursabirov`
//

// `artursabirov`.`posts`
$posts = array(
  array('id' => '3','title' => 'Начало','slug' => 'origins','body' => 'Вот и всё. Блог запущен и обратного пути, как говорится, нет.

На текущий момент запланированы периодические сливы информации на темы Ruby, Rails, CoffeeScript, Javascript, Flex, Capistrano, Rspec.


','body_html' => '<p>Вот и всё. Блог запущен и обратного пути, как говорится, нет.</p>
<p>На текущий момент запланированы периодические сливы информации на темы Ruby, Rails, CoffeeScript, Javascript, Flex, Capistrano, Rspec.</p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => '','published_at' => '2011-08-08 18:30:19','created_at' => '2011-08-08 18:30:19','updated_at' => '2011-09-23 07:45:43','edited_at' => '2011-08-08 18:30:19'),
  array('id' => '4','title' => 'Сборка сложных JSON для Rails','slug' => 'rails-json-generators','body' => 'Сериализация объектов обычное явление в проектах Rails. И для этих целей чаще всего используется обычное to_json метод из пакета ActiveSupport. 

Всё хорошо. Пока не появляется особых требований к хэшу. Например, подключить ассоциации моделей. И чтобы не перегружать лишней логикой контроллеры, можно воспользоваться builder\'ами.
#cut#

h3. Нативный ERB

Самый простой вариант.

```ruby
class CountriesController < ApplicationController
  def index
    @counties = Country.all
    respond_to do |format|
      format.json render :partial => "countries/index.json"
  end
end

```


```ruby

<%- @countries.each do |country|%>
{
    \'name\': \'<%= country.long_name %>\',
    \'code\': \'<%= country.code %>\'
}
<% end -%>

```

Выбор старообрядцев.


h3. RABL

Самый популярный на github.


```ruby
gem "json_builder"
```

<br />

```ruby

collection @posts
attributes :id, :title, :subject
child(:user) { attributes :full_name }
node(:read) { |post| post.read_by?(@user) }

```

<br />

http://localhost:3000/posts.json

```json

[{  post :
  {
    id : 5, title: "...", subject: "...",
    user : { full_name : "..." },
    read : true
  }
}]

```

Джем умеет работать также с фреймворками Sinatra, Padrino. Вероятно, это и послужило причиной его популярности.

"https://github.com/nesquena/rabl":https://github.com/nesquena/rabl


h3. JSON Builder

Второй по популярности.


```
gem "json_builder".

```

<br />

```ruby
class PostsController < ApplicationController
  respond_to :json
  
  def index
    @posts = Post.all
    respond_with @posts
  end
end

```

<br />

```ruby
json.posts do
  json.array! @posts do
    @posts.each do |user|
      json.array_item! do
        render :partial => \'post\', :locals => { :json => json, :post => post }
      end
    end
  end
end

```

<br />

http://localhost:3000/posts.json

```json
{
  "posts": [
    {
      "id": 1,
      "name": "Garrett Bjerkhoel",
      "body": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod."
    }, {
      "id": 2,
      "name": "John Doe",
      "body": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod."
    }
  ]
}

```

Разработчик отмечает отличную скорость генерации. Только вот низкоуровневая работа с типами совсем не вызывает восторга.


"https://github.com/dewski/json_builder":https://github.com/dewski/json_builder


h3. Jsonify

Совсем новый проект, стремительно набирающий популярность.


```ruby
gem "jsonify-rails"
```

<br />

```ruby
json.post do
  json.title @post.title
  json.body_plain @post.body_plain
  json.body_html @post.body
end

```

<br />

http://localhost:3000/posts.json

```json
{"post": { "title": "...", "body_plain": "...", "body_html": ""}}
```

Шикарные возможности и прозрачная логика.


"https://github.com/bsiggelkow/jsonify":https://github.com/bsiggelkow/jsonify

"Wrapper для Rails — https://github.com/bsiggelkow/jsonify-rails":https://github.com/bsiggelkow/jsonify-rails



h3. Argonaut, Tokamak и Tequila

Проекты скорее мертвые, чем просто «стабильные». Argonaut и Tokamak не совместимы с Rails 3.1. 

"https://github.com/abril/tokamak":https://github.com/abril/tokamak 

"https://github.com/jbr/argonaut":https://github.com/jbr/argonaut

"http://inem.github.com/tequila.html":http://inem.github.com/tequila.html

<br />

Если вы не определились в выбором, то я бы рекомендовал jsonify. Легкий в использовании и солидный по "функционалу":https://github.com/bsiggelkow/jsonify.','body_html' => '<p>Сериализация объектов обычное явление в проектах Rails. И для этих целей чаще всего используется обычное to_json метод из пакета ActiveSupport.</p>
<p>Всё хорошо. Пока не появляется особых требований к хэшу. Например, подключить ассоциации моделей. И чтобы не перегружать лишней логикой контроллеры, можно воспользоваться builder&#8217;ами.<br />
#cut#</p>
<h3>Нативный <span class="caps">ERB</span></h3>
<p>Самый простой вариант.</p>

```ruby
class CountriesController &lt; ApplicationController
  def index
    @counties = Country.all
    respond_to do |format|
      format.json render :partial =&gt; "countries/index.json"
  end
end

```


```erb

&lt;%- @countries.each do |country|%&gt;
{
    \'name\': \'&lt;%= country.long_name %&gt;\',
    \'code\': \'&lt;%= country.code %&gt;\'
}
&lt;% end -%&gt;

```
<p>Выбор старообрядцев.</p>
<h3><span class="caps">RABL</span></h3>
<p>Самый популярный джем судя по количеству форков и следящих в github.</p>

```ruby
gem "json_builder"
```
<p><br /></p>

```ruby

collection @posts
attributes :id, :title, :subject
child(:user) { attributes :full_name }
node(:read) { |post| post.read_by?(@user) }

```
<p><br /></p>

http://localhost:3000/posts.json

```json
[{  post :
  {
    id : 5, title: "...", subject: "...",
    user : { full_name : "..." },
    read : true
  }
}]

```
<p>Джем умеет работать также с фреймворками Sinatra, Padrino. Вероятно, это и послужило причиной его популярности.</p>
<p><a href="https://github.com/nesquena/rabl">https://github.com/nesquena/rabl</a></p>
<h3><span class="caps">JSON</span> Builder</h3>
<p>Второй по популярности.</p>

```ruby
gem "json_builder".
```
<p><br /></p>

```ruby
class PostsController &lt; ApplicationController
  respond_to :json
  
  def index
    @posts = Post.all
    respond_with @posts
  end
end

```
<p><br /></p>

```ruby
json.posts do
  json.array! @posts do
    @posts.each do |user|
      json.array_item! do
        render :partial =&gt; \'post\', :locals =&gt; { :json =&gt; json, :post =&gt; post }
      end
    end
  end
end

```
<p><br /></p>

```json
{
  "posts": [
    {
      "id": 1,
      "name": "Garrett Bjerkhoel",
      "body": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod."
    }, {
      "id": 2,
      "name": "John Doe",
      "body": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod."
    }
  ]
}

```
<p>Разработчик отмечает отличную скорость генерации. Только вот низкоуровневая работа с типами совсем не вызывает восторга.</p>
<p><a href="https://github.com/dewski/json_builder">https://github.com/dewski/json_builder</a></p>
<h3>Jsonify</h3>
<p>Совсем новый проект, стремительно набирающий популярность.</p>

```ruby
gem "jsonify-rails"
```
<p><br /></p>

```ruby
json.post do
  json.title @post.title
  json.body_plain @post.body_plain
  json.body_html @post.body
end

```
<p><br /></p>

http://localhost:3000/posts.json

```json
{"post": { "title": "...", "body_plain": "...", "body_html": ""}}
```
<p>Шикарные возможности и прозрачная логика.</p>
<p><a href="https://github.com/bsiggelkow/jsonify">https://github.com/bsiggelkow/jsonify</a></p>
<p><a href="https://github.com/bsiggelkow/jsonify-rails">Wrapper для Rails — https://github.com/bsiggelkow/jsonify-rails</a></p>
<h3>Argonaut, Tokamak и Tequila</h3>
<p>Проекты скорее мертвые, чем просто «стабильные». Argonaut и Tokamak не совместимы с Rails 3.1.</p>
<p><a href="https://github.com/abril/tokamak">https://github.com/abril/tokamak</a></p>
<p><a href="https://github.com/jbr/argonaut">https://github.com/jbr/argonaut</a></p>
<p><a href="http://inem.github.com/tequila.html">http://inem.github.com/tequila.html</a></p>
<p><br /></p>
<p>Если вы не определились в выбором, то я бы рекомендовал jsonify. Легкий в использовании и солидный по <a href="https://github.com/bsiggelkow/jsonify">функционалу</a>.</p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'rails','published_at' => '2011-08-09 21:04:54','created_at' => '2011-08-09 21:04:54','updated_at' => '2011-09-23 07:44:30','edited_at' => '2011-08-09 21:04:54'),
  array('id' => '5','title' => 'Deadline, Тома ДеМарко','slug' => 'deadline-demarco','body' => 'С регулярной периодичностью попадалось на глаза название этой книги. Казалось бы, для чего рядовому технарю читать про управление проектами. 

Время шло. Пока случайно не попал на тренинг, коучера, "Александра Орлова":http://devconf.ru/mk на DevConf. Что немного приоткрыло мне глаза на тему менеджмента.

И вот по приезду в моей электронной библиотеке, наравне с "многотомником Д.Кнута":http://en.wikipedia.org/wiki/The_Art_of_Computer_Programming, появились книги по управлению командой и проектами. Одна из них — Deadline, Тома ДеМарко.
#cut#

Честно сказать, был удивлен. «Роман об управлении проектами» оказался действительно романом. Со своим сюжетом и главными героями. Прямо в контексте истории подаются такие академические темы, как управление рисками, набор персонала, моделирование процессов, мотивация и конфликты. 

Стоит отметить, что книга была написана еще в "1997 году":http://www.goodreads.com/book/show/123716.The_Deadline. Некоторые вещи в ней серьезно устарели (завод cd-rom, название продуктов), да и в плане менеджмента появилось «гибкие» методологии. Но это не понизило её полезности.

Почитайте, не пожалеете.

<a href="http://www.amazon.com/Deadline-Novel-About-Project-Management/dp/tags-on-product/0932633390"><img src="http://artursabirov.ru/system/DeadLine.jpg" style="height:150px;margin-right:20px"/></a> <a href="http://www.imobilco.ru/books/-/465885/"><img src="http://artursabirov.ru/system/DeadLine_ru.jpg" style="height:150px" /></a>

P.S.: Если же читать не хочется, вот — "«Записная книжка Вебстера»":http://habrahabr.ru/blogs/pm/67931/

','body_html' => '<p>С регулярной периодичностью попадалось на глаза название этой книги. Казалось бы, для чего рядовому технарю читать про управление проектами.</p>
<p>Время шло. Пока случайно не попал на тренинг, коучера, <a href="http://devconf.ru/mk">Александра Орлова</a> на DevConf. Что немного приоткрыло мне глаза на тему менеджмента.</p>
<p>И вот по приезду в моей электронной библиотеке, наравне с <a href="http://en.wikipedia.org/wiki/The_Art_of_Computer_Programming">многотомником Д.Кнута</a>, появились книги по управлению командой и проектами. Одна из них — Deadline, Тома ДеМарко.<br />
#cut#</p>
<p>Честно сказать, был удивлен. «Роман об управлении проектами» оказался действительно романом. Со своим сюжетом и главными героями. Прямо в контексте истории подаются такие академические темы, как управление рисками, набор персонала, моделирование процессов, мотивация и конфликты.</p>
<p>Стоит отметить, что книга была написана еще в <a href="http://www.goodreads.com/book/show/123716.The_Deadline">1997 году</a>. Некоторые вещи в ней серьезно устарели (завод cd-rom, название продуктов), да и в плане менеджмента появилось «гибкие» методологии. Но это не понизило её полезности.</p>
<p>Почитайте, не пожалеете.</p>
<p><a href="http://www.amazon.com/Deadline-Novel-About-Project-Management/dp/tags-on-product/0932633390"><img src="http://artursabirov.ru/system/DeadLine.jpg" style="height:150px;margin-right:20px"/></a> <a href="http://www.imobilco.ru/books/-/465885/"><img src="http://artursabirov.ru/system/DeadLine_ru.jpg" style="height:150px" /></a></p>
<p>P.S.: Если же читать не хочется, вот — <a href="http://habrahabr.ru/blogs/pm/67931/">«Записная книжка Вебстера»</a></p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'книги','published_at' => '2011-08-13 11:38:43','created_at' => '2011-08-13 11:38:43','updated_at' => '2011-08-16 08:21:56','edited_at' => '2011-08-13 11:38:43'),
  array('id' => '6','title' => 'IT-подкасты на русском и английском языках','slug' => 'it-podcasts','body' => 'В нашем городе мало технически продвинутых программистов. Многие из-за этого ловят эффект «гуру», получают звание сеньора и окончательно останавливаются в развитии. Подкасты же помогают осознать слабость своих знаний и помогают поддерживать себя в форме.
#cut#

h3. Радио-Т

Проверенный временем, еженедельный развлекательно-новостной подкаст о технологиях, железе и программировании. Лучший в своем жанре.

Ведущие:

* Евгений Борт, Чикаго ("@umputun":http://twitter.com/umputun)
* Григорий Бакунов, зам. руководителя департамента разработки в Яндексе ("@bobuk":http://twitter.com/bobuk)
* Сергей Петренко, генеральный директор Яндекс.Украина ("@gray_ru":http://twitter.com/gray_ru)
* Марина Корецкая, NIC.UA, Киев ("@marin_k_a":http://twitter.com/marin_k_a)

"http://radio-t.com":http://radio-t.com


h3. Рунетология

Интервью со «знаменитостями» российского IT-рынка. 

Ведущий Максим Спиридонов, продюсер веб-проектов ("@MaximSpiridonov":http://twitter.com/MaximSpiridonov)

"http://runetologia.podfm.ru/":http://runetologia.podfm.ru


h3. Рунет сегодня

На каждый выпуск приглашаются эксперты для обсуждения последних событий рунета.

Ведущий Максим Спиридонов ("@MaximSpiridonov":http://twitter.com/MaximSpiridonov)

"http://runet-segodnya.podfm.ru":http://runet-segodnya.podfm.ru


h3. Безымянный подкаст о Ruby

Обсуждение новостей связанных с Ruby и RubyOnRails.

Ведущие:
* Дмитрий, Израиль ("@labria":http://twitter.com/labria")
* Григорий, Израиль  ("@green_mouse":http://twitter.com/green_mouse)

"http://ruby.rpod.ru":http://ruby.rpod.ru


h3. Время новостей

Еженедельная новостная программа об IT.

Ведущие:
* Сергей Болисов, Саранск ("@exel_ru":http://twitter.com/exel_ru)
* Влад Филатов ("@filatovvlad":http://twitter.com/filatovvlad)

"http://timeofnewz.podfm.ru":http://timeofnewz.podfm.ru


h3. Откровенно про IT карьеризм

Беседы с менеджерами, тимлидами, коучерами и владельцами IT-компаний.

Ведущие:
* Михаил Марченко, scrum-мастер из Харькова ("@shami13":http://twitter.com/shami13)
* Ольга Давыдова, HR manager, бизнес-тренер из Харькова.

"http://it-career.rpod.ru":http://it-career.rpod.ru


h3. Study Group Community

Обсуждения на тему гибких методологий, программировании. Довольно хардкорный для обычного прослушивания.

Ведущий Денис Миллер, agile couch ("agilizt.livejournal.com":http://agilizt.livejournal.com)

"http://sg.rpod.ru":http://sg.rpod.ru


h3. Подкаст веб-фрилансера.

Личные рассуждения о программировании и фрилансе. 

Ведущий Андрей Агаларов, программист-фрилансер из Новосибирска, "блог zeroxor.ru":http://www.zeroxor.ru


h3. Радио Бермудский Треугольник

Ежемесячный подкаст 3х бывших программистов о жизни, работе и учебе за границей. 

Ведущие:
* Яков Фейн (Budam), управляющий директор Farata Systems из Нью Джерси ("@yfain":http://twitter.com/yfain)
* Даник из Бремена
* Леонид Титков (Лёник) из Лондона

"http://btradio.wordpress.com":http://btradio.wordpress.com


h3. Витая пара

Обсуждение IT-новостей.

Ведущие: 
* Александр Обливальный, системный админмистратор из Новосибирска ("Google+":https://plus.google.com/113525124935787559342)
* Юлия Классен, программист из Новосибирска ("Google+":https://profiles.google.com/112256373429516023084)

"http://tp.rpod.ru":http://tp.rpod.ru


h3. Еженедельный подкаст от Umputun

Разговоры на тему жизни в США. Часто задевается IT-тематика и продукция Apple.

Ведущий Евгений Борт, Радио-Т ("@umputun":http://twitter.com/umputun)

"http://podcast.umputun.com":http://podcast.umputun.com


h3. Америчка

Отдельный подкаст от Будама. В основном о жизни в США. 

Яков Фейн ("@yfain":http://twitter.com/yfain)

"http://americhka.us":http://americhka.us


h3. The Changelog (en)

Самый популярный подкаст среди гиков. Беседы с разработчиками популярных opensource проектов. 

Ведущие:
* Adam Stacoviak, веб-разработчик из Хьюстона ("@adamstac":http://twitter.com/adamstac)
* Wynn Netherland, дизайнер-разработчик аз Далласа
* Steve Klabnik, ruby-программист из Питсбурга ("@steveklabnik":http://twitter.com/steveklabnik)

"http://changelogshow.com":http://changelogshow.com


h3. Teach Me To Code (en)

Интервью с экспертами. Фриланс, программирование.

Ведущий Charles Max Wood, ruby-разработчик, коучер.

"http://teachmetocode.com/podcast":http://teachmetocode.com/podcast
<br />


h3. This Developer\'s Life (en)

Подкаст на темы IT-образования, управления проектами и программировании. 

"http://thisdeveloperslife.com":http://thisdeveloperslife.com


h3. Software Engineering Radio (en)

Интервью с разработчиками, архитекторами и аналитиками известных IT-компаний.

"http://www.se-radio.net":http://www.se-radio.net


h3. Ruby5 (en)

Очень короткие и веселые выпуски новостей связанных с ruby. 

"http://ruby5.envylabs.com/episodes":http://ruby5.envylabs.com/episodes


h3. Founder Talks (en)

Аналог рунетологии. Интервью с владельцами успешных проектов.

"http://5by5.tv/founderstalk/":http://5by5.tv/founderstalk/


h3. Еще

"ZFCasts":http://zfcasts.ru — ZendFramefork.
"Podcast9":http://podcast9.podfm.ru/ — Microsoft.
"Сделайте мне красиво":http://makeitsexy.rpod.ru — HTML5, JS.
"The Programatic Bookshelf podacasts (en)":http://pragprog.com/podcasts — Ruby, интервью с разработчиками.
"Javaposse (en)":http://javaposse.com — Java.
"Hancel Minutes (en)":http://www.hanselminutes.com/archives.aspx — ASP.NET, C++, Microsoft.
"FLOSS (en)":http://twit.tv/FLOSS — об open-source проектах.
"Herding code (en)":http://herdingcode.com — .NET, Java, Ruby и PHP.
"Deep Fried Bytes (en)":http://deepfriedbytes.com/ — .NET
"No BS IT (en)":http://nobsit.libsyn.com — Java, Android
"YayQuery (en)":http://yayquery.com/ — Javascript, HTML, Web
"Thepipeline (en)":http://5by5.tv/pipeline/ — предпринимательство, стартапы.
"JavascriptShow (en)":http://javascriptshow.com/ — Javascript.
"NodeUP (en)":http://nodeup.com
','body_html' => '<p>В нашем городе мало технически продвинутых программистов. Многие из-за этого ловят эффект «гуру», получают звание сеньора и окончательно останавливаются в развитии. Подкасты же помогают осознать слабость своих знаний и помогают поддерживать себя в форме.<br />
#cut#</p>
<h3>Радио-Т</h3>
<p>Проверенный временем, еженедельный развлекательно-новостной подкаст о технологиях, железе и программировании. Лучший в своем жанре.</p>
<p>Ведущие:</p>
<ul>
	<li>Евгений Борт, Чикаго (<a href="http://twitter.com/umputun">@umputun</a>)</li>
	<li>Григорий Бакунов, зам. руководителя департамента разработки в Яндексе (<a href="http://twitter.com/bobuk">@bobuk</a>)</li>
	<li>Сергей Петренко, генеральный директор Яндекс.Украина (<a href="http://twitter.com/gray_ru">@gray_ru</a>)</li>
	<li>Марина Корецкая, <span class="caps">NIC</span>.UA, Киев (<a href="http://twitter.com/marin_k_a">@marin_k_a</a>)</li>
</ul>
<p><a href="http://radio-t.com">http://radio-t.com</a></p>
<h3>Рунетология</h3>
<p>Интервью со «знаменитостями» российского IT-рынка.</p>
<p>Ведущий Максим Спиридонов, продюсер веб-проектов (<a href="http://twitter.com/MaximSpiridonov">@MaximSpiridonov</a>)</p>
<p><a href="http://runetologia.podfm.ru">http://runetologia.podfm.ru/</a></p>
<h3>Рунет сегодня</h3>
<p>На каждый выпуск приглашаются эксперты для обсуждения последних событий рунета.</p>
<p>Ведущий Максим Спиридонов (<a href="http://twitter.com/MaximSpiridonov">@MaximSpiridonov</a>)</p>
<p><a href="http://runet-segodnya.podfm.ru">http://runet-segodnya.podfm.ru</a></p>
<h3>Безымянный подкаст о Ruby</h3>
<p>Обсуждение новостей связанных с Ruby и RubyOnRails.</p>
<p>Ведущие:</p>
<ul>
	<li>Дмитрий, Израиль (<a href="http://twitter.com/labria">@labria</a>&quot;)</li>
	<li>Григорий, Израиль  (<a href="http://twitter.com/green_mouse">@green_mouse</a>)</li>
</ul>
<p><a href="http://ruby.rpod.ru">http://ruby.rpod.ru</a></p>
<h3>Время новостей</h3>
<p>Еженедельная новостная программа об IT.</p>
<p>Ведущие:</p>
<ul>
	<li>Сергей Болисов, Саранск (<a href="http://twitter.com/exel_ru">@exel_ru</a>)</li>
	<li>Влад Филатов (<a href="http://twitter.com/filatovvlad">@filatovvlad</a>)</li>
</ul>
<p><a href="http://timeofnewz.podfm.ru">http://timeofnewz.podfm.ru</a></p>
<h3>Откровенно про IT карьеризм</h3>
<p>Беседы с менеджерами, тимлидами, коучерами и владельцами IT-компаний.</p>
<p>Ведущие:</p>
<ul>
	<li>Михаил Марченко, scrum-мастер из Харькова (<a href="http://twitter.com/shami13">@shami13</a>)</li>
	<li>Ольга Давыдова, HR manager, бизнес-тренер из Харькова.</li>
</ul>
<p><a href="http://it-career.rpod.ru">http://it-career.rpod.ru</a></p>
<h3>Study Group Community</h3>
<p>Обсуждения на тему гибких методологий, программировании. Довольно хардкорный для обычного прослушивания.</p>
<p>Ведущий Денис Миллер, agile couch (<a href="http://agilizt.livejournal.com">agilizt.livejournal.com</a>)</p>
<p><a href="http://sg.rpod.ru">http://sg.rpod.ru</a></p>
<h3>Подкаст веб-фрилансера.</h3>
<p>Личные рассуждения о программировании и фрилансе.</p>
<p>Ведущий Андрей Агаларов, программист-фрилансер из Новосибирска, <a href="http://www.zeroxor.ru">блог zeroxor.ru</a></p>
<h3>Радио Бермудский Треугольник</h3>
<p>Ежемесячный подкаст 3х бывших программистов о жизни, работе и учебе за границей.</p>
<p>Ведущие:</p>
<ul>
	<li>Яков Фейн (Budam), управляющий директор Farata Systems из Нью Джерси (<a href="http://twitter.com/yfain">@yfain</a>)</li>
	<li>Даник из Бремена</li>
	<li>Леонид Титков (Лёник) из Лондона</li>
</ul>
<p><a href="http://btradio.wordpress.com">http://btradio.wordpress.com</a></p>
<h3>Витая пара</h3>
<p>Обсуждение IT-новостей.</p>
<p>Ведущие:</p>
<ul>
	<li>Александр Обливальный, системный админмистратор из Новосибирска (<a href="https://plus.google.com/113525124935787559342">Google+</a>)</li>
	<li>Юлия Классен, программист из Новосибирска (<a href="https://profiles.google.com/112256373429516023084">Google+</a>)</li>
</ul>
<p><a href="http://tp.rpod.ru">http://tp.rpod.ru</a></p>
<h3>Еженедельный подкаст от Umputun</h3>
<p>Разговоры на тему жизни в США. Часто задевается IT-тематика и продукция Apple.</p>
<p>Ведущий Евгений Борт, Радио-Т (<a href="http://twitter.com/umputun">@umputun</a>)</p>
<p><a href="http://podcast.umputun.com">http://podcast.umputun.com</a></p>
<h3>Америчка</h3>
<p>Отдельный подкаст от Будама. В основном о жизни в США.</p>
<p>Яков Фейн (<a href="http://twitter.com/yfain">@yfain</a>)</p>
<p><a href="http://americhka.us">http://americhka.us</a></p>
<h3>The Changelog (en)</h3>
<p>Самый популярный подкаст среди гиков. Беседы с разработчиками популярных opensource проектов.</p>
<p>Ведущие:</p>
<ul>
	<li>Adam Stacoviak, веб-разработчик из Хьюстона (<a href="http://twitter.com/adamstac">@adamstac</a>)</li>
	<li>Wynn Netherland, дизайнер-разработчик аз Далласа</li>
	<li>Steve Klabnik, ruby-программист из Питсбурга (<a href="http://twitter.com/steveklabnik">@steveklabnik</a>)</li>
</ul>
<p><a href="http://changelogshow.com">http://changelogshow.com</a></p>
<h3>Teach Me To Code (en)</h3>
<p>Интервью с экспертами. Фриланс, программирование.</p>
<p>Ведущий Charles Max Wood, ruby-разработчик, коучер.</p>
<p><a href="http://teachmetocode.com/podcast">http://teachmetocode.com/podcast</a><br />
<br /></p>
<h3>This Developer&#8217;s Life (en)</h3>
<p>Подкаст на темы IT-образования, управления проектами и программировании.</p>
<p><a href="http://thisdeveloperslife.com">http://thisdeveloperslife.com</a></p>
<h3>Software Engineering Radio (en)</h3>
<p>Интервью с разработчиками, архитекторами и аналитиками известных IT-компаний.</p>
<p><a href="http://www.se-radio.net">http://www.se-radio.net</a></p>
<h3>Ruby5 (en)</h3>
<p>Очень короткие и веселые выпуски новостей связанных с ruby.</p>
<p><a href="http://ruby5.envylabs.com/episodes">http://ruby5.envylabs.com/episodes</a></p>
<h3>Founder Talks (en)</h3>
<p>Аналог рунетологии. Интервью с владельцами успешных проектов.</p>
<p><a href="http://5by5.tv/founderstalk/">http://5by5.tv/founderstalk/</a></p>
<h3>Еще</h3>
<p><a href="http://zfcasts.ru">ZFCasts</a> — ZendFramefork.<br />
<a href="http://podcast9.podfm.ru/">Podcast9</a> — Microsoft.<br />
<a href="http://makeitsexy.rpod.ru">Сделайте мне красиво</a> — HTML5, JS.<br />
<a href="http://pragprog.com/podcasts" title="en">The Programatic Bookshelf podacasts</a> — Ruby, интервью с разработчиками.<br />
<a href="http://javaposse.com" title="en">Javaposse</a> — Java.<br />
<a href="http://www.hanselminutes.com/archives.aspx" title="en">Hancel Minutes</a> — <span class="caps">ASP</span>.<span class="caps">NET</span>, C++, Microsoft.<br />
<a href="http://twit.tv/FLOSS" title="en"><span class="caps">FLOSS</span></a> — об open-source проектах.<br />
<a href="http://herdingcode.com" title="en">Herding code</a> — .<span class="caps">NET</span>, Java, Ruby и <span class="caps">PHP</span>.<br />
<a href="http://deepfriedbytes.com/" title="en">Deep Fried Bytes</a> — .<span class="caps">NET</span><br />
<a href="http://nobsit.libsyn.com" title="en">No BS IT</a> — Java, Android<br />
<a href="http://yayquery.com/" title="en">YayQuery</a> — Javascript, <span class="caps">HTML</span>, Web<br />
<a href="http://5by5.tv/pipeline/" title="en">Thepipeline</a> — предпринимательство, стартапы.<br />
<a href="http://javascriptshow.com/" title="en">JavascriptShow</a> — Javascript.<br />
<a href="http://nodeup.com" title="en">NodeUP</a></p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => '','published_at' => '2011-08-16 07:23:45','created_at' => '2011-08-16 07:23:45','updated_at' => '2011-09-23 07:37:46','edited_at' => '2011-08-16 07:23:45'),
  array('id' => '7','title' => 'Selenium Server на CentOS','slug' => 'selenium-server','body' => 'Интеграционное тестирование задача интересная и весьма полезная. На текущий момент самым популярным решением является Selenium. 

Только вот скорость его работы весьма невелика. Оно и понятно, нужно запустить браузер, открыть страницу, выполнить JS код тестов. А если еще и браузеров несколько.

Немного упрощает задачу вынос всего этого безобразия на отдельный сервер. Чем, собственно, и займемся. 

#cut#

h3. Установка

Для начала потребуется виртуальный буфер для эмуляции иксов.

```
yum install Xvfb

```

Добавим скрипт автозагрузки. 

<pre>

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

PROG="Xvfb"
PROG_OPTIONS=":7 -ac -screen 0 1024x768x24"
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

case "${1:-\'\'}" in
    \'start\')
        if test -f /tmp/selenium.pid
        then
            echo "Selenium is already running."
        else
            DISPLAY=:7 java -jar /usr/local/lib/selenium/selenium-server-standalone-2.4.0.jar -port 4444 > /var/log/selenium/selenium-output.log 2> /var/log/selenium/selenium-error.log & echo $! > /tmp/selenium.pid
            echo "Starting Selenium..."

            error=$?
            if test $error -gt 0
            then
                echo "${bon}Error $error! Couldn\'t start Selenium!${boff}"
            echo_success
            fi
        fi
    ;;
    \'stop\')
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
    \'restart\')
       if test -f /tmp/selenium.pid
        then
            kill -HUP `cat /tmp/selenium.pid`
            test -f /tmp/selenium.pid && rm -f /tmp/selenium.pid
            sleep 1
            java -jar /usr/local/lib/selenium/selenium-server-standalone-2.4.0.jar -port 4444 > /var/log/selenium/selenium-output.log 2> /var/log/selenium/selenium-error.log & echo $! > /tmp/selenium.pid
            echo "Reload Selenium..."
        else
            echo "Selenium isn\'t running..."
        fi
        ;;
    *)      # no parameter specified
        echo "Usage: $SELF start|stop|restart|reload|force-reload|status"
        exit 1
    ;;
esac

```

Запускаем.

```bash
chmod +x /etc/init.d/selenium
chkconfig selenium on
service selenium start

```

Ставим FireFox 6.

```bash
cd /tmp
wget http://mirror.informatik.uni-mannheim.de/pub/mirrors/mozilla.org/firefox/releases/6.0/linux-i686/en-US/firefox-6.0.tar.bz2
tar xvf firefox-6.0.tar.bz2
mv firefox /usr/local/firefox-6.0
ln -s /usr/local/firefox-6.0/firefox /usr/local/bin/firefox

```

h3. Результат

Проверить результат можно простым ruby скриптом. Он сохраняет скриншот страницы http://html5test.com/ используя сервер Selenium.

```ruby
require \'rubygems\'
gem "selenium-client"
require "selenium/client"
@selenium_driver = Selenium::Client::Driver.new \\
  :host => "localhost",
  :port => 4444,
  :browser => "*firefox",
  :url => "http://html5test.com/",
  :timeout_in_seconds => 10
@selenium_driver.start_new_browser_session
@selenium_driver.open "/"
@selenium_driver.capture_entire_page_screenshot(File.expand_path(File.dirname(__FILE__)) + \'screenshot.png\', \'\')
@selenium_driver.stop

```

```bash
gem install selenium-client
ruby test.rb

```
<br />

h3. Итог

Созданный Selenium сервер можно будет подключить к rspec, либо к системе "Continuous integration":http://ru.wikipedia.org/wiki/Непрерывная_интеграция.

Стоит сразу посмотреть "Selenium Grid":http://selenium-grid.seleniumhq.org/. Он предназначен для распределенного по нескольким серверам тестирования.


h3. Полезные материалы
* "Capybara — ruby gem для упрощения написания интеграционных тестов":https://github.com/jnicklas/capybara
* "Официальный сайт Selenium":http://seleniumhq.org/
* "Поддерживаемые в Selenium браузеры":http://seleniumhq.org/about/platforms.html
* "Установка FireFox на CentOS 5. «libstdc++.so.6: cannot open shared object file»":http://blog.bloke.com/2011/03/install-firefox-4-on-centos-5-5/
* "Дистрибутивы Firefox":https://ftp.mozilla.org/pub/mozilla.org/firefox/releases/
* "Xfvb init script":http://eldapo.lembobrothers.com/2009/05/27/an-xvfb-init-script
* "Установка Selenium Grid на Linux":http://svn.openqa.org/fisheye/browse/~raw,r=514/selenium-grid/trunk/doc/website/step_by_step_installation_instructions_for_linux.html
* "Selenium Grid и Rspec":http://www.slideshare.net/garnierjm/fast-web-acceptance-testing-with-seleniumgrid-presentation

','body_html' => '<p>Интеграционное тестирование задача интересная и весьма полезная. На текущий момент самым популярным решением является Selenium.</p>
<p>Только вот скорость его работы весьма невелика. Оно и понятно, нужно запустить браузер, открыть страницу, выполнить JS код тестов. А если еще и браузеров несколько.</p>
<p>Немного упрощает задачу вынос всего этого безобразия на отдельный сервер. Чем, собственно, и займемся.</p>
<p>#cut#</p>
<h3>Установка</h3>
<p>Для начала потребуется виртуальный буфер для эмуляции иксов.</p>

```bash
yum install Xvfb
```
<p>Добавим скрипт автозагрузки /etc/init.d/xvfb.</p>

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

[ "${NETWORKING}" = "no" ] &amp;&amp; exit 0

PROG="Xvfb"
PROG_OPTIONS=":7 -ac -screen 0 1024x768x24"
PROG_OUTPUT="/tmp/Xvfb.out"

case "$1" in
    start)
        echo -n "Starting : X Virtual Frame Buffer "
        $PROG $PROG_OPTIONS&gt;&gt;$PROG_OUTPUT 2&gt;&amp;1 &amp;
        disown -ar
        /bin/usleep 500000
        status Xvfb &amp; &gt;/dev/null &amp;&amp; echo_success || echo_failure
        RETVAL=$?
        if [ $RETVAL -eq 0 ]; then
            /bin/touch /var/lock/subsys/Xvfb
            /sbin/pidof -o  %PPID -x Xvfb &gt; /var/run/Xvfb.pid
        fi
        echo
   		;;
    stop)
        echo -n "Shutting down : X Virtual Frame Buffer"
        killproc $PROG
        RETVAL=$?
        [ $RETVAL -eq 0 ] &amp;&amp; /bin/rm -f /var/lock/subsys/Xvfb /var/run/Xvfb.pid
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
<p>Добавим его в автозагрузку и запустим.</p>

```bash
chmod +x /etc/init.d/xvfb
chkconfig xvfb on
service xvfb start

```
<p>Таперь Selenium Server.<br />

```bash
mkdir /usr/local/lib/selenium
cd /usr/local/lib/selenium
wget http://selenium.googlecode.com/files/selenium-server-standalone-2.4.0.jar
mkdir -p /var/log/selenium/
chmod a+w /var/log/selenium/

```</p>
<p>Его скрипт автозагрузки /etc/init.d/selenium.</p>

```bash
#!/bin/bash

case "${1:-\'\'}" in
    \'start\')
        if test -f /tmp/selenium.pid
        then
            echo "Selenium is already running."
        else
            DISPLAY=:7 java -jar /usr/local/lib/selenium/selenium-server-standalone-2.4.0.jar -port 4444 &gt; /var/log/selenium/selenium-output.log 2&gt; /var/log/selenium/selenium-error.log &amp; echo $! &gt; /tmp/selenium.pid
            echo "Starting Selenium..."

            error=$?
            if test $error -gt 0
            then
                echo "${bon}Error $error! Couldn\'t start Selenium!${boff}"
            echo_success
            fi
        fi
    ;;
    \'stop\')
        if test -f /tmp/selenium.pid
        then
            echo "Stopping Selenium..."
            PID=`cat /tmp/selenium.pid`
            kill -3 $PID
            if kill -9 $PID ;
                then
                    sleep 2
                    test -f /tmp/selenium.pid &amp;&amp; rm -f /tmp/selenium.pid
                else
                    echo "Selenium could not be stopped..."
                fi
        else
            echo "Selenium is not running."
        fi
        ;;
    \'restart\')
       if test -f /tmp/selenium.pid
        then
            kill -HUP `cat /tmp/selenium.pid`
            test -f /tmp/selenium.pid &amp;&amp; rm -f /tmp/selenium.pid
            sleep 1
            java -jar /usr/local/lib/selenium/selenium-server-standalone-2.4.0.jar -port 4444 &gt; /var/log/selenium/selenium-output.log 2&gt; /var/log/selenium/selenium-error.log &amp; echo $! &gt; /tmp/selenium.pid
            echo "Reload Selenium..."
        else
            echo "Selenium isn\'t running..."
        fi
        ;;
    *)      # no parameter specified
        echo "Usage: $SELF start|stop|restart|reload|force-reload|status"
        exit 1
    ;;
esac

```

<p>Запускаем.<br />

```bash
chmod +x /etc/init.d/selenium
chkconfig selenium on
service selenium start

```

<p>Ставим FireFox 6.</p>

```bash
cd /tmp
wget http://mirror.informatik.uni-mannheim.de/pub/mirrors/mozilla.org/firefox/releases/6.0/linux-i686/en-US/firefox-6.0.tar.bz2
tar xvf firefox-6.0.tar.bz2
mv firefox /usr/local/firefox-6.0
ln -s /usr/local/firefox-6.0/firefox /usr/local/bin/firefox

```
<h3>Результат</h3>
<p>Проверить результат можно простым ruby скриптом. Он сохраняет скриншот страницы http://html5test.com/ используя сервер Selenium.<br />

```ruby
require \'rubygems\'
gem "selenium-client"
require "selenium/client"
@selenium_driver = Selenium::Client::Driver.new \\
  :host =&gt; "localhost",
  :port =&gt; 4444,
  :browser =&gt; "*firefox",
  :url =&gt; "http://html5test.com/",
  :timeout_in_seconds =&gt; 10
@selenium_driver.start_new_browser_session
@selenium_driver.open "/"
@selenium_driver.capture_entire_page_screenshot(File.expand_path(File.dirname(__FILE__)) + \'screenshot.png\', \'\')
@selenium_driver.stop

```

```ruby gem install selenium-client
ruby test.rb

```
<p><br /></p>
<h3>Итог</h3>
<p>Созданный Selenium сервер можно будет подключить к rspec, либо к системе <a href="http://ru.wikipedia.org/wiki/Непрерывная_интеграция">Continuous integration</a>.</p>
<p>Стоит сразу посмотреть <a href="http://selenium-grid.seleniumhq.org/">Selenium Grid</a>. Он предназначен для распределенного по нескольким серверам тестирования.</p>
<h3>Полезные материалы</h3>
<ul>
	<li><a href="https://github.com/jnicklas/capybara">Capybara — ruby gem для упрощения написания интеграционных тестов</a></li>
	<li><a href="http://seleniumhq.org/">Официальный сайт Selenium</a></li>
	<li><a href="http://seleniumhq.org/about/platforms.html">Поддерживаемые в Selenium браузеры</a></li>
	<li><a href="http://blog.bloke.com/2011/03/install-firefox-4-on-centos-5-5/">Установка FireFox на CentOS 5. «libstdc++.so.6: cannot open shared object file»</a></li>
	<li><a href="https://ftp.mozilla.org/pub/mozilla.org/firefox/releases/">Дистрибутивы Firefox</a></li>
	<li><a href="http://eldapo.lembobrothers.com/2009/05/27/an-xvfb-init-script">Xfvb init script</a></li>
	<li><a href="http://svn.openqa.org/fisheye/browse/~raw,r=514/selenium-grid/trunk/doc/website/step_by_step_installation_instructions_for_linux.html">Установка Selenium Grid на Linux</a></li>
	<li><a href="http://www.slideshare.net/garnierjm/fast-web-acceptance-testing-with-seleniumgrid-presentation">Selenium Grid и Rspec</a></li>
</ul>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'тестирование','published_at' => '2011-08-20 13:01:35','created_at' => '2011-08-20 13:01:35','updated_at' => '2012-04-05 05:13:16','edited_at' => '2011-08-20 13:01:35'),
  array('id' => '8','title' => 'jQuery-плагин для замены видео YouTube на превьюшки','slug' => 'youtube-mocks','body' => 'Встроенное видео на странице нередко вызывает неудобства. Вырезающиеся popop-элементы, визуальные артефакты при скроллинге. Да и размазанные «превьюшки» выглядят неприятно. 

И встретив удобное решение на Google+, накидал схожий по действию плагин к jquery.

Работает он в режиме post-processing. Иначе говоря, видео заменяются после загрузки страницы. Это, конечно, имеет ряд недостатков. Однако, избавляет от вмешательства в серверный код.

#cut#

h3. Установка

```html
<link href="css/jquery.youtubeMocks.css" type="text/css" rel="stylesheet" />
<script src="js/jquery-1.6.1.min.js" type="text/javascript"></script>  
<script src="js/jquery.youtubeMocks.js" type="text/javascript"></script>
<script text="text/javascript">
$(function(){
  $(document).youtubeMocks();
});
</script>

```

"Пример использования":http://squarefaction.ru/game/heavy-rain
"Исходники на github":https://github.com/cjslade/jquery-youtubeMocks
"Скачать в zip-архиве":https://github.com/cjslade/jquery-youtubeMocks/zipball/master
','body_html' => '<p>Встроенное видео на странице нередко вызывает неудобства. Вырезающиеся popop-элементы, визуальные артефакты при скроллинге. Да и размазанные «превьюшки» выглядят неприятно.</p>
<p>И встретив удобное решение на Google+, накидал схожий по действию плагин к jquery.</p>
<p>Работает он в режиме post-processing. Иначе говоря, видео заменяются после загрузки страницы. Это, конечно, имеет ряд недостатков. Однако, избавляет от вмешательства в серверный код.</p>
<p>#cut#</p>
<h3>Установка</h3>

```html
&lt;link href="css/jquery.youtubeMocks.css" type="text/css" rel="stylesheet" /&gt;
&lt;script src="js/jquery-1.6.1.min.js" type="text/javascript"&gt;&lt;/script&gt;  
&lt;script src="js/jquery.youtubeMocks.js" type="text/javascript"&gt;&lt;/script&gt;
&lt;script text="text/javascript"&gt;
$(function(){
  $(document).youtubeMocks();
});
&lt;/script&gt;

```
<p><a href="http://squarefaction.ru/game/heavy-rain">Пример использования</a><br />
<a href="https://github.com/cjslade/jquery-youtubeMocks">Исходники на github</a><br />
<a href="https://github.com/cjslade/jquery-youtubeMocks/zipball/master">Скачать в zip-архиве</a></p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'javascript','published_at' => '2011-08-23 07:25:05','created_at' => '2011-08-23 07:25:05','updated_at' => '2011-08-23 11:17:50','edited_at' => '2011-08-23 07:25:05'),
  array('id' => '10','title' => 'Смена сервера Rack на Thin для development окружения','slug' => 'rails-thin-windows','body' => 'Не знаю, как дела обстоят на других платформах. Но на виндовой машинке Rack стабильно валится от sprockets. 
#cut#

Для установки потребуется указать совместимые версии джемов с mingw. 

Gemfile

```ruby
group :development do
  gem "thin", "1.2.11"
  gem "eventmachine", "1.0.0.beta.3"
end

```

```ssh
rails s thin
```

','body_html' => '<p>Не знаю, как дела обстоят на других платформах. Но на виндовой машинке Rack стабильно валится от sprockets. <br />
#cut#</p>
<p>Для установки потребуется указать совместимые версии джемов с mingw.</p>

Gemfile

```ruby
group :development do
  gem "thin", "1.2.11"
  gem "eventmachine", "1.0.0.beta.3"
end

```bash
rails s thin
```
','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'rails','published_at' => '2011-08-26 19:19:06','created_at' => '2011-08-26 19:19:06','updated_at' => '2011-09-23 07:23:23','edited_at' => '2011-08-26 19:19:06'),
  array('id' => '11','title' => 'Foreman','slug' => 'gem-foreman','body' => 'Во время разработки приходится запускать множество процессов: thin, faye, spork, sphinx, node.js. Пр. У каждого проекта своё окружение и переключение между ними занимает не мало времени.  Упростить задачу может Foreman.
#cut#

h3. Установка

```bash
gem install foreman
```

Создаем конфиг Procfile, в котором прописываем все процессы для запуска.


```
spork: spork
thin: bundle exec rails s thin -p 3003
faye: bundle exec rackup faye.ru -s thin -E development
resque_sheduler: bundle exec rake resque:scheduler

```

h3. Использование

Запуск всех разом

```
foreman start

```

Или только необходимые

```
foreman start thin, faye

```

h3. Автозапуск

Foreman умеет генерировать конфиги inittat и upstart. Очень полезным будет на production сервере.

```
foreman export inittab

```

```
foreman export upstart

```


h3. Ссылки

Документация — "http://ddollar.github.com/foreman/":http://ddollar.github.com/foreman

Репозиторий — "https://github.com/ddollar/foreman":https://github.com/ddollar/foreman
<br />


h3. Итог

Foreman\'у не не хватает запуска в фоновом режиме. Чтобы каждый процесс можно было перезапустить не задев остальные. В остальном же со своей задачей прекрасно справляется.','body_html' => '<p>Во время разработки приходится запускать множество процессов: thin, faye, spork, sphinx, node.js. Пр. У каждого проекта своё окружение и переключение между ними занимает не мало времени.  Упростить задачу может Foreman.<br />
#cut#</p>
<h3>Установка</h3>

```
gem install foreman

```
<p>Создаем конфиг Procfile, в котором прописываем все процессы для запуска.</p>

```
spork: spork
thin: bundle exec rails s thin -p 3003
faye: bundle exec rackup faye.ru -s thin -E development
resque_sheduler: bundle exec rake resque:scheduler

```
<h3>Использование</h3>
<p>Запуск всех разом<br />

```
foreman start

```
<p>Или только необходимые<br />

```
foreman start thin, faye

```
<h3>Автозапуск</h3>
<p>Foreman умеет генерировать конфиги inittat и upstart. Очень полезным будет на production сервере.</p>

```
foreman export inittab

```
```
foreman export upstart

```
<h3>Ссылки</h3>
<p>Документация — <a href="http://ddollar.github.com/foreman">http://ddollar.github.com/foreman/</a></p>
<p>Репозиторий — <a href="https://github.com/ddollar/foreman">https://github.com/ddollar/foreman</a><br />
<br /></p>
<h3>Итог</h3>
<p>Foreman&#8217;у не не хватает запуска в фоновом режиме. Чтобы каждый процесс можно было перезапустить не задев остальные. В остальном же со своей задачей прекрасно справляется.</p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'ruby','published_at' => '2011-08-29 11:04:01','created_at' => '2011-08-29 11:04:01','updated_at' => '2012-04-05 05:12:49','edited_at' => '2011-08-29 11:04:01'),
  array('id' => '12','title' => 'Переход на RubyOnRails 3.1','slug' => 'rails3-rails31-migration','body' => 'Сегодня состоялся официальный релиз версии 3.1. А значит можно со спокойной душой переносить свои старые проекты на новые рельсы. Для упрощения этой задачи собрал небольшую заметку об отличиях с версией 3.0.

#cut#


h3. HTTP авторизация

Если раньше авторизация настраивалась через блок в authenticate_or_request_with_http_basic.

```ruby
class PostsController < ApplicationController
    USER_NAME, PASSWORD = "dhh", "secret" 
    before_filter :authenticate, :except => [ :index ]
 
    def index
        render :text => "Everyone can see me!"
    end
 
    def edit
        render :text => "I\'m only accessible if you know the password"
    end
 
    private
        def authenticate
            authenticate_or_request_with_http_basic do |user_name, password|
            user_name == USER_NAME && password == PASSWORD
        end
    end
end

```

То теперь можно передать нужны параметры http_basic_authenticate_with.

```ruby
class PostsController < ApplicationController
    http_basic_authenticate_with :name => "dhh", :password => "secret", :except => :index
 
    def index
        render :text => "Everyone can see me!"
    end

    def edit
        render :text => "I\'m only accessible if you know the password"
    end
 end

```

h3. Создание связанных объектов

Раньше работал недокументированный способ создания объектов через ассоциацию has_one.

```ruby
bob.mother.create(options)
```

Сейчас же только только через create_object.

```ruby
bob.create_mother(options)
```

h3. Метод conditions

Раньше можно было задать условие для выборки ассоциаций строкой.

```ruby
has_many :things, :conditions => \'foo = #{bar}\' 
```

Теперь нужно создавать виртуальную функцию proc.

```ruby
has_many :things, :conditions => proc { "foo = #{bar}" }
```


h3. Active Resource и json

Формат подгружаемых объектов по-умолчанию сменился с XML на JSON. 
Чтобы переключить обратно, пропишите вручную.

```ruby
class User < ActiveResource::Base
  self.format = :xml
end

```

h3. Атрибут mutipart

```erb
<%= form_tag \'/upload\', :multipart => true do %>
  <label for="file">File to Upload</label> <%= file_field_tag "file" %>
  <%= submit_tag %>
<% end %>

```

При наличии file_field уже нет необходимости его указывать.

```ruby
<%= form_tag \'/upload\' do %>
  <label for="file">File to Upload</label> <%= file_field_tag "file" %>
  <%= submit_tag %>
<% end %>

```

h3. Атрибуты data-* в помощнике tag

Если раньше все атрибуты  склеивались в id.

```ruby
tag("div", :data => {:name => \'Stephen\', :city_state => %w(Chicago IL)})
# => <div data="city_stateChicagoILnameStephen" />

```

Сейчас формируются data из спецификации HTML5.

```ruby
tag("div", :data => {:name => \'Stephen\', :city_state => %w(Chicago IL)})
# => <div data-name="Stephen" data-city-state="[&quot;Chicago&quot;,&quot;IL&quot;]" />

```

Да и все нестроковые значения конвертируются в json.

h3. :html в form_tag и form_for

Чтобы задать атрибут к тэгу form, нужно было использовать формировать хэш :html.

```ruby
form_for(@post, remote: true, html: { method: :delete }).
```

Сейчас же просто перечислением в атрибутах помощника.

```ruby
form_for(@post, remote: true, method: :delete)
```


h3. Миграции

Раньше использовались методы класса.

```
class FooMigration < ActiveRecord::Migration
    def self.up
        ...
    end
end

```
Теперь же нам рекомендуют использовать методы объекта.

```
class FooMigration < ActiveRecord::Migration   
    def up # Not self.up
        ...
    end
end

```


h3. Asset Pipeline

Встроенный sprockets позволяет иначе взглянуть на проблему загрязнения вашей public директории. Умеет склеивать, минимизировать js и css файлы, компилировать SASS и CoffeeScript.
Подробнее об этом можно почитать на сайте rails — "http://guides.rubyonrails.org/asset_pipeline.html":http://guides.rubyonrails.org/asset_pipeline.html

Необходимые gems:

```ruby
gem "sass-rails"
gem "coffee-script"
gem "sprockets"
gem "uglifier"
gem "execjs"

```

Если вы не используете весь пакет rails/all, например у вас Mongoid. Добавьте в application.rb:

```
require "sprockets/railtie"

```

В своё время эта мелочь здорово потрепала мне нервы.

h3. Depricated

CSV fixtures для тестов. Окончательно будут убраны в Rails 3.2


h3. Полностью убрано

— Prototype.js. Используйте gem "http://rubygems.org/gems/prototype-rails":http://rubygems.org/gems/prototype-rails
— "config.action_view.debug_rjs":http://rorguide.blogspot.com/2011/07/getting-error-undefined-method-debugrjs.html.
— auto_link. Вынесен в отдельный gem "https://github.com/tenderlove/rails_autolink":https://github.com/tenderlove/rails_autolink
— Шаблоны rhtml и rxml.
— ActiveSupport::SecureRandom.
— Поддержка PostgreSQL версии ниже 8.2.


h3. Ссылки

"Полный список всех изменений в Rails 3.1":http://guides.rubyonrails.org/3_1_release_notes.html
"Обратные миграции в Rails 3.1":http://edgerails.info/articles/what-s-new-in-edge-rails/2011/05/06/reversible-migrations/index.html
"CoffeeScript":http://jashkenas.github.com/coffee-script/
"Sass и Scss":http://sass-lang.com/
"Sprockets":https://github.com/sstephenson/sprockets','body_html' => '<p>Сегодня состоялся официальный релиз версии 3.1. А значит можно со спокойной душой переносить свои старые проекты на новые рельсы. Для упрощения этой задачи собрал небольшую заметку об отличиях с версией 3.0.</p>
<p>#cut#</p>
<h3><span class="caps">HTTP</span> авторизация</h3>
<p>Если раньше авторизация настраивалась через блок в authenticate_or_request_with_http_basic.</p>

```ruby
class PostsController &lt; ApplicationController
    USER_NAME, PASSWORD = "dhh", "secret" 
    before_filter :authenticate, :except =&gt; [ :index ]
 
    def index
        render :text =&gt; "Everyone can see me!"
    end
 
    def edit
        render :text =&gt; "I\'m only accessible if you know the password"
    end
 
    private
        def authenticate
            authenticate_or_request_with_http_basic do |user_name, password|
            user_name == USER_NAME &amp;&amp; password == PASSWORD
        end
    end
end

```
<p>То теперь можно передать нужны параметры http_basic_authenticate_with.</p>

```ruby
class PostsController &lt; ApplicationController
    http_basic_authenticate_with :name =&gt; "dhh", :password =&gt; "secret", :except =&gt; :index
 
    def index
        render :text =&gt; "Everyone can see me!"
    end

    def edit
        render :text =&gt; "I\'m only accessible if you know the password"
    end
 end

```
<h3>Создание связанных объектов</h3>
<p>Раньше работал недокументированный способ создания объектов через ассоциацию has_one.<br />

```ruby
bob.mother.create(options)
```</p>
<p>Сейчас же только только через create_object.<br />

```ruby
bob.create_mother(options)
```</p>
<h3>Метод conditions</h3>
<p>Раньше можно было задать условие для выборки ассоциаций строкой.<br />

```ruby
has_many :things, :conditions =&gt; \'foo = #{bar}\' 
```</p>
<p>Теперь нужно создавать виртуальную функцию proc.<br />

```ruby
has_many :things, :conditions =&gt; proc { "foo = #{bar}" }
```</p>
<h3>Active Resource и json</h3>
<p>Формат подгружаемых объектов по-умолчанию сменился с <span class="caps">XML</span> на <span class="caps">JSON</span>. <br />
Чтобы переключить обратно, пропишите вручную.</p>

```ruby
class User &lt; ActiveResource::Base
  self.format = :xml
end

```
<h3>Атрибут mutipart</h3>

```ruby
&lt;%= form_tag \'/upload\', :multipart =&gt; true do %&gt;
  &lt;label for="file"&gt;File to Upload&lt;/label&gt; &lt;%= file_field_tag "file" %&gt;
  &lt;%= submit_tag %&gt;
&lt;% end %&gt;

```
<p>При наличии file_field уже нет необходимости его указывать.</p>

```ruby
&lt;%= form_tag \'/upload\' do %&gt;
  &lt;label for="file"&gt;File to Upload&lt;/label&gt; &lt;%= file_field_tag "file" %&gt;
  &lt;%= submit_tag %&gt;
&lt;% end %&gt;

```
<h3>Атрибуты data-* в помощнике tag</h3>
<p>Если раньше все атрибуты  склеивались в id.</p>

```ruby
tag("div", :data =&gt; {:name =&gt; \'Stephen\', :city_state =&gt; %w(Chicago IL)})
# =&gt; &lt;div data="city_stateChicagoILnameStephen" /&gt;

```
<p>Сейчас формируются data из спецификации HTML5.</p>

```ruby
tag("div", :data =&gt; {:name =&gt; \'Stephen\', :city_state =&gt; %w(Chicago IL)})
# =&gt; &lt;div data-name="Stephen" data-city-state="[&amp;quot;Chicago&amp;quot;,&amp;quot;IL&amp;quot;]" /&gt;

```
<p>Да и все нестроковые значения конвертируются в json.</p>
<h3>:html в form_tag и form_for</h3>
<p>Чтобы задать атрибут к тэгу form, нужно было использовать формировать хэш :html.</p>

```ruby
form_for(@post, remote: true, html: { method: :delete }).
```
<p>Сейчас же просто перечислением в атрибутах помощника.</p>

```ruby
form_for(@post, remote: true, method: :delete)
```
<h3>Миграции</h3>
<p>Раньше использовались статические методы.<br />

```ruby
class FooMigration &lt; ActiveRecord::Migration
    def self.up
        ...
    end
end

```

Теперь же нам рекомендуют использовать методы объекта.</p>

```
class FooMigration &lt; ActiveRecord::Migration   
    def up # Not self.up
        ...
    end
end

```
<h3>Asset Pipeline</h3>
<p>Встроенный sprockets позволяет иначе взглянуть на проблему загрязнения вашей public директории. Умеет склеивать, минимизировать js и css файлы, компилировать <span class="caps">SASS</span> и CoffeeScript.<br />
Подробнее об этом можно почитать на сайте rails — <a href="http://guides.rubyonrails.org/asset_pipeline.html">http://guides.rubyonrails.org/asset_pipeline.html</a></p>
<p>Необходимые gems:</p>

```ruby
gem \'sass-rails\'
gem \'coffee-script\'
gem \'sprockets\'
gem \'uglifier\'
gem "execjs"

```
<p>Если вы не используете весь пакет rails/all, например у вас Mongoid. Добавьте в application.rb:</p>

```
require "sprockets/railtie"

```
<p>В своё время эта мелочь здорово потрепала мне нервы.</p>
<h3>Depricated</h3>
<p><span class="caps">CSV</span> fixtures для тестов. Окончательно будут убраны в Rails 3.2</p>
<h3>Полностью убрано</h3>
<p>— Prototype.js. Используйте gem <a href="http://rubygems.org/gems/prototype-rails">http://rubygems.org/gems/prototype-rails</a><br />
— <a href="http://rorguide.blogspot.com/2011/07/getting-error-undefined-method-debugrjs.html">config.action_view.debug_rjs</a>.<br />
— auto_link. Вынесен в отдельный gem <a href="https://github.com/tenderlove/rails_autolink">https://github.com/tenderlove/rails_autolink</a><br />
— Шаблоны rhtml и rxml.<br />
— ActiveSupport::SecureRandom.<br />
— Поддержка PostgreSQL версии ниже 8.2.</p>
<h3>Ссылки</h3>
<p><a href="http://guides.rubyonrails.org/3_1_release_notes.html">Полный список всех изменений в Rails 3.1</a><br />
<a href="http://edgerails.info/articles/what-s-new-in-edge-rails/2011/05/06/reversible-migrations/index.html">Обратные миграции в Rails 3.1</a><br />
<a href="http://jashkenas.github.com/coffee-script/">CoffeeScript</a><br />
<a href="http://sass-lang.com/">Sass и Scss</a><br />
<a href="https://github.com/sstephenson/sprockets">Sprockets</a></p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'rails','published_at' => '2011-08-31 09:28:45','created_at' => '2011-08-31 09:28:45','updated_at' => '2011-09-23 07:07:00','edited_at' => '2011-08-31 09:28:45'),
  array('id' => '13','title' => 'Pro JavaScript Design Patterns, Роса Хармеса и Дастина Диаса','slug' => 'pro-javascript-design-patterns','body' => 'В последнее время по теме паттернов вышло немало книг. Первой попалась эта.
#cut#

В ней рассматриваются популярные паттерны: Factory, Bridge, Composite, Facade, Adapter, Decorator, Flyweight, Proxy. Очень подробно описаны условия для применения, реализация и их недостатки.  Что может оказатся скучным, если вы использовали их на других языках.

<a href="http://www.goodreads.com/book/show/1960593.Pro_JavaScript_Design_Patterns"><img src="/system/pro_design_js.jpg" height="200" /></a>','body_html' => '<p>В последнее время по теме паттернов вышло немало книг. Первой попалась эта.<br />
#cut#</p>
<p>В ней рассматриваются популярные паттерны: Factory, Bridge, Composite, Facade, Adapter, Decorator, Flyweight, Proxy. Очень подробно описаны условия для применения, реализация и их недостатки.  Что может оказатся скучным, если вы использовали их на других языках.</p>
<p><a href="http://www.goodreads.com/book/show/1960593.Pro_JavaScript_Design_Patterns"><img src="/system/pro_design_js.jpg" height="200" /></a></p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'книги','published_at' => '2011-09-01 20:53:11','created_at' => '2011-09-01 20:53:11','updated_at' => '2011-09-23 07:06:39','edited_at' => '2011-09-01 20:53:11'),
  array('id' => '15','title' => 'Gem sdoc','slug' => 'sdoc','body' => 'Sdoc — генератор статической документации с возможностью поиска. 

<blockquote>
«SDoc is a RDoc format created by Володя Колесников...» — <i>"из блога RubyOnRails":http://weblog.rubyonrails.org/2011/8/29/the-rails-api-switches-to-sdoc</i>
</blockquote>
#cut#

h3. Установка и запуск

По сути является оберткой над стандартным rdoc. Что гарантирует полную поддержку "стандартного синтаксиса":http://rdoc.sourceforge.net/doc/.

```
gem "rake", "0.8.7" 

```

Добавляем задачу для rake в Rails:

lib/tasks/sdoc.rake

```ruby
# Rakefile
require \'sdoc\'
Rake::RDocTask.new do |rdoc|
  rdoc.rdoc_dir = \'doc/rdoc\'
  rdoc.options << \'--fmt\' << \'shtml\' # explictly set shtml generator
  rdoc.template = \'direct\' # lighter template used on railsapi.com
end

```

```
bundle exec rake sdoc

```

Либо вручную:

```
bundle exec sdoc -o doc -T direct ./

```


h3. Утилита sdoc-merge

Предназначена для склеивания нескольких комплектов документации в одну.

Для примера склейка Ruby и Rails:

```
sdoc-merge --title "Ruby v1.9, Rails v2.3.2.1" --op merged --names "Ruby,Rails" ruby-v1.9 rails-v2.3.2.1

```


h3. Ссылки

Документация Rails 3.1 в качестве примера — http://edgeapi.rubyonrails.org/

Githup repo — "https://github.com/voloko/sdoc/":https://github.com/voloko/sdoc/

Твиттер разработчика — "@voloko":https://twitter.com/#!/voloko
','body_html' => '<p>Sdoc — генератор статической документации с возможностью поиска.</p>
<blockquote>
<p>«SDoc is a RDoc format created by Володя Колесников&#8230;» — <i><a href="http://weblog.rubyonrails.org/2011/8/29/the-rails-api-switches-to-sdoc">из блога RubyOnRails</a></i></p>
</blockquote>
<p>#cut#</p>
<h3>Установка и запуск</h3>
<p>По сути является оберткой над стандартным rdoc. Что гарантирует полную поддержку <a href="http://rdoc.sourceforge.net/doc/">стандартного синтаксиса</a>.</p>

```ruby
gem "rake", "0.8.7"  # ветка 0.9.* пока плохо совместима с рельсами
```
<p>Добавляем задачу для rake в Rails (lib/tasks/sdoc.rake):</p>

```ruby
# Rakefile
require \'sdoc\'
Rake::RDocTask.new do |rdoc|
  rdoc.rdoc_dir = \'doc/rdoc\'
  rdoc.options &lt;&lt; \'--fmt\' &lt;&lt; \'shtml\' # explictly set shtml generator
  rdoc.template = \'direct\' # lighter template used on railsapi.com
end

```

```
bundle exec rake sdoc

```
<p>Либо вручную:</p>

```
bundle exec sdoc -o doc -T direct ./

```
<h3>Утилита sdoc-merge</h3>
<p>Предназначена для склеивания нескольких комплектов документации в одну.</p>
<p>Для примера склейка Ruby и Rails:</p>

```
sdoc-merge --title "Ruby v1.9, Rails v2.3.2.1" --op merged --names "Ruby,Rails" ruby-v1.9 rails-v2.3.2.1

```
<h3>Ссылки</h3>
<p>Документация Rails 3.1 в качестве примера — http://edgeapi.rubyonrails.org/</p>
<p>Githup repo — <a href="https://github.com/voloko/sdoc/">https://github.com/voloko/sdoc/</a></p>
<p>Твиттер разработчика — <a href="https://twitter.com/#!/voloko">@voloko</a></p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'ruby','published_at' => '2011-09-06 13:11:41','created_at' => '2011-09-06 13:11:41','updated_at' => '2012-01-30 06:27:00','edited_at' => '2011-09-06 13:11:41'),
  array('id' => '17','title' => 'Горячий перезапуск Node.JS или альтернатива supervisor на Windows.','slug' => 'npm-supervisor-for-windows','body' => 'Пропустим обсуждение ущербности npm портированного на windows . Одно из таких неприятный последствий, это несовместимость многих модулей, один из таких оказался "supervisor":https://github.com/isaacs/node-supervisor. Он сканирует модули (за require) на наличие изменений и сам перезапускает сервер.
#cut#

Тут вспомнил о существовании джема с аналогичным функционалом.  "watchr":https://github.com/mynyml/watchr зовется. И вполне, надо сказать, сгодился для наших нужд.

h3. Установка

```
gem install watchr

```

Создаем файл .watchr.

```ruby
RUN_COMMAND = "node server.js > server.log"
KILL_COMMAND = "taskkill /IM node.exe /f"

puts "starting server"
io = IO.popen(RUN_COMMAND)

watch("^.*\\.js$") do |match|  
    system KILL_COMMAND
    puts "restarting server"
    io = IO.popen(RUN_COMMAND)
end

```

В нем настраивается действие на случай изменения любого js-файла. Лог выполнения сохраняется в server.log.


h3. Запуск

В консоли:

```
watchr .watchr

```

Автоматически запустится и сервер node.js.

h3. Итоги

Такой венегрет, конечно, имеет недостатки. 
* Нужен ruby с джемами. 
* Рубит все все запущенные процессы node. 
* И не дает вывести логи в консоль. 

Лучше, чем ничего.









','body_html' => '<p>Пропустим обсуждение ущербности npm портированного на windows . Одно из таких неприятный последствий, это несовместимость многих модулей, один из таких оказался <a href="https://github.com/isaacs/node-supervisor">supervisor</a>. Он сканирует модули (за require) на наличие изменений и сам перезапускает сервер.<br />
#cut#</p>
<p>Тут вспомнил о существовании джема с аналогичным функционалом.  <a href="https://github.com/mynyml/watchr">watchr</a> зовется. И вполне, надо сказать, сгодился для наших нужд.</p>
<h3>Установка</h3>

```
gem install watchr

```

<p>Создаем файл .watchr.</p>

```ruby
RUN_COMMAND = "node server.js &gt; server.log"
KILL_COMMAND = "taskkill /IM node.exe /f"

puts "starting server"
io = IO.popen(RUN_COMMAND)

watch("^.*\\.js$") do |match|  
    system KILL_COMMAND
    puts "restarting server"
    io = IO.popen(RUN_COMMAND)
end

```
<p>В нем настраивается действие на случай изменения любого js-файла. Лог выполнения сохраняется в server.log.</p>
<h3>Запуск</h3>
<p>В консоли:</p>

```
watchr .watchr

```
<p>Автоматически запустится и сервер node.js.</p>
<h3>Итоги</h3>
<p>Такой венегрет, конечно, имеет недостатки.</p>
<ul>
	<li>Нужен ruby с джемами.</li>
	<li>Рубит все все запущенные процессы node.</li>
	<li>И не дает вывести логи в консоль.</li>
</ul>
<p>Лучше, чем ничего.</p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'node.js, ruby','published_at' => '2011-09-09 20:44:19','created_at' => '2011-09-09 20:44:19','updated_at' => '2012-04-05 05:13:47','edited_at' => '2011-09-09 20:44:19'),
  array('id' => '18','title' => 'О создании сервиса видеоконференций','slug' => 'project-xcon','body' => 'Расскажу об одном из последних проектов. 

Поставлена задача: разработать сервис видео-конференций (вебинары). Ничего подобного раньше не приходилось создавать. Вот и отлично. С технической стороны всё понятно: комнаты, "rtmp":http://en.wikipedia.org/wiki/Real_Time_Messaging_Protocol, "мультикаст":http://ru.wikipedia.org/wiki/Multicast.
#cut#

Выбора практически не было: java, либо Adobe Flash. 

Первоначально сервером был выбран бесплатный Cirrus (Stratus), для сайта Rails и для клиента Flex. Языки соответственно ActionScript 3 и Ruby. 

Это был первый опыт работы с ActionScript 3. С флешем уже приходилось работать года 4 назад. Разрабатывал казуальные мини-игры для промо-акций на AS2. Переход на третью версию занял буквально несколько дней. 

Теперь о трудностях, с которыми пришлось столкнуться.

h3. Flex

Документация ужасная. Хоть какое-то представление об архитектуре удалось получить из шедших с Flex примеров и "Flex De Tour":http://www.adobe.com/devnet/flex/tourdeflex.html. Что касается комьюнити. У меня сложилось ощущение, что всех разработчиков Flex в конце 2010 массово отправили на переквалификацию. Комьюнити почти не подает признаков жизни. 

Один flash-программист высказал мнение, что фреймворк предназначался для корпоративного сектора. Программистов обучают сертифицированные Adobe\'ом тренеры. Отсюда и информационный вакуум. Похоже на правду. Ведь Enterprise еще тот отстой.

Ладно, это всё пустяки. После прочтения книжки "Flex 4 Cookbook: Real-world recipes for developing RIA":http://www.goodreads.com/book/show/7473613-flex-4-cookbook. Из статей, конечно, "Flex Best Practices":http://www.adobe.com/devnet/flex/articles/best_practices_pt1.html, "AS3 Coding Convetions":http://opensource.adobe.com/wiki/display/flexsdk/Coding+Conventions.

Несколько советов по Flex\'у:
* Как бы это глупо не звучало — используйте фреймворк для фреймворка. Обратить внимание стоит на "Robotlegs":http://www.robotlegs.org и "PureMVC":http://puremvc.org. 
* Если вам нужно к компоненту добавить активный элемент, например кнопку — наследуйте (extens). Если просто декоративный, тогда скины (Skins).
* Не пишите код в mxml. Это отвратительно. Для вызова классов в mxml есть тэг Declarations.
* Все цветовые настройки держите во внешнем css. Кастомные скины по возможности делать с учетом глобального chromeColor.


h3. Cirrus, Red5 и Flash Media Server

После создания первого прототипа оказалось, что Cirrus не пробивает NAT\'ы.  Окей, перенес всё на Red5. Но у него проблемы мультикастом, точнее сказать его там вообще нет. И так мы пришли к "Flash Media Server":http://www.adobe.com/products/flashmediaserver/amazonwebservices. 

Ситуация с FMS немного лучше, чем с Flex. С низкой вероятность, но всё же ответы можно получить на "официальном форуме":http://forums.adobe.com/community/flash/flash_media_server.

По FMS пока дам 1 совет. Используйте client.send() для передачи данных клиентам, вместо SharedObject. Доступ к SO лучше вообще запретить в через дерективу client.readAccess.


h3. Презентации

На текущий момент для конвертации используются SWFTools, OpenOffice и jodconverter. И пока не нашел способа аккуратной открытия pptx и docx.

h3. Запуск

FMS поднят через Apache. Сайт на Passanger с Nginx. OpenOffice на уровне демона. FmsConsole для мониторинга нагрузки. Всё работает.


h3. Выводы

Во-первых, использовать абсолютно неизученный стэк технологий опасно для сроков. Их я умудрился сорвать аж троекратно! Сервис немного не вписался в текущие потребности рынка. Придется наверстывать упущенное и обгонять конкурентов. 

Во-вторых, полное погружение в технологии выливается в изъяны интерфейса. Нужно помнить, что всем этим будут пользоваться люди. Технические аспекты их абсолютно не волнуют. Придется над этим поработать.

Надеюсь HTML5 в скором времени полностью вытеснит неуклюжий Flash. Тогда программисты станут немного счастливее. 

Проект "ega.ru":http://ega.ru.','body_html' => '<p>Расскажу об одном из последних проектов.</p>
<p>Поставлена задача: разработать сервис видео-конференций (вебинары). Ничего подобного раньше не приходилось создавать. Вот и отлично. С технической стороны всё понятно: комнаты, <a href="http://en.wikipedia.org/wiki/Real_Time_Messaging_Protocol">rtmp</a>, <a href="http://ru.wikipedia.org/wiki/Multicast">мультикаст</a>.<br />
#cut#</p>
<p>Выбора практически не было: java, либо Adobe Flash.</p>
<p>Первоначально сервером был выбран бесплатный Cirrus (Stratus), для сайта Rails и для клиента Flex. Языки соответственно ActionScript 3 и Ruby.</p>
<p>Это был первый опыт работы с ActionScript 3. С флешем уже приходилось работать года 4 назад. Разрабатывал казуальные мини-игры для промо-акций на AS2. Переход на третью версию занял буквально несколько дней.</p>
<p>Теперь о трудностях, с которыми пришлось столкнуться.</p>
<h3>Flex</h3>
<p>Документация ужасная. Хоть какое-то представление об архитектуре удалось получить из шедших с Flex примеров и <a href="http://www.adobe.com/devnet/flex/tourdeflex.html">Flex De Tour</a>. Что касается комьюнити. У меня сложилось ощущение, что всех разработчиков Flex в конце 2010 массово отправили на переквалификацию. Комьюнити почти не подает признаков жизни.</p>
<p>Один flash-программист высказал мнение, что фреймворк предназначался для корпоративного сектора. Программистов обучают сертифицированные Adobe&#8217;ом тренеры. Отсюда и информационный вакуум. Похоже на правду. Ведь Enterprise еще тот отстой.</p>
<p>Ладно, это всё пустяки. После прочтения книжки <a href="http://www.goodreads.com/book/show/7473613-flex-4-cookbook">Flex 4 Cookbook: Real-world recipes for developing <span class="caps">RIA</span></a>. Из статей, конечно, <a href="http://www.adobe.com/devnet/flex/articles/best_practices_pt1.html">Flex Best Practices</a>, <a href="http://opensource.adobe.com/wiki/display/flexsdk/Coding+Conventions">AS3 Coding Convetions</a>.</p>
<p>Несколько советов по Flex&#8217;у:</p>
<ul>
	<li>Как бы это глупо не звучало — используйте фреймворк для фреймворка. Обратить внимание стоит на <a href="http://www.robotlegs.org">Robotlegs</a> и <a href="http://puremvc.org">PureMVC</a>.</li>
	<li>Если вам нужно к компоненту добавить активный элемент, например кнопку — наследуйте (extens). Если просто декоративный, тогда скины (Skins).</li>
	<li>Не пишите код в mxml. Это отвратительно. Для вызова классов в mxml есть тэг Declarations.</li>
	<li>Все цветовые настройки держите во внешнем css. Кастомные скины по возможности делать с учетом глобального chromeColor.</li>
</ul>
<h3>Cirrus, Red5 и Flash Media Server</h3>
<p>После создания первого прототипа оказалось, что Cirrus не пробивает NAT&#8217;ы.  Окей, перенес всё на Red5. Но у него проблемы мультикастом, точнее сказать его там вообще нет. И так мы пришли к <a href="http://www.adobe.com/products/flashmediaserver/amazonwebservices">Flash Media Server</a>.</p>
<p>Ситуация с <span class="caps">FMS</span> немного лучше, чем с Flex. С низкой вероятность, но всё же ответы можно получить на <a href="http://forums.adobe.com/community/flash/flash_media_server">официальном форуме</a>.</p>
<p>По <span class="caps">FMS</span> пока дам 1 совет. Используйте client.send() для передачи данных клиентам, вместо SharedObject. Доступ к SO лучше вообще запретить в через дерективу client.readAccess.</p>
<h3>Презентации</h3>
<p>На текущий момент для конвертации используются SWFTools, OpenOffice и jodconverter. И пока не нашел способа аккуратной открытия pptx и docx.</p>
<h3>Запуск</h3>
<p><span class="caps">FMS</span> поднят через Apache. Сайт на Passanger с Nginx. OpenOffice на уровне демона. FmsConsole для мониторинга нагрузки. Всё работает.</p>
<h3>Выводы</h3>
<p>Во-первых, использовать абсолютно неизученный стэк технологий опасно для сроков. Их я умудрился сорвать аж троекратно! Сервис немного не вписался в текущие потребности рынка. Придется наверстывать упущенное и обгонять конкурентов.</p>
<p>Во-вторых, полное погружение в технологии выливается в изъяны интерфейса. Нужно помнить, что всем этим будут пользоваться люди. Технические аспекты их абсолютно не волнуют. Придется над этим поработать.</p>
<p>Надеюсь HTML5 в скором времени полностью вытеснит неуклюжий Flash. Тогда программисты станут немного счастливее.</p>
<p>Проект <a href="http://ega.ru">ega.ru</a>.</p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'flash, flex','published_at' => '2011-09-13 09:50:54','created_at' => '2011-09-13 09:50:54','updated_at' => '2012-04-05 05:10:36','edited_at' => '2011-09-13 09:50:54'),
  array('id' => '19','title' => 'Проверка сайта на различных экранах','slug' => 'responsive-design-testing','body' => 'Гениально простой и невероятно полезный инструмент от Matt Kersley. Она просто показывает нужный сайт во фреймах с фиксированной шириной.

Пример — "http://mattkersley.com/responsive/?artursabirov.ru":http://mattkersley.com/responsive/?artursabirov.ru

Исходники — "https://github.com/mattkersley/Responsive-Design-Testing":https://github.com/mattkersley/Responsive-Design-Testing','body_html' => '<p>Гениально простой и невероятно полезный инструмент от Matt Kersley. Она просто показывает нужный сайт во фреймах с фиксированной шириной.</p>
<p>Пример — <a href="http://mattkersley.com/responsive/?artursabirov.ru">http://mattkersley.com/responsive/?artursabirov.ru</a></p>
<p>Исходники — <a href="https://github.com/mattkersley/Responsive-Design-Testing">https://github.com/mattkersley/Responsive-Design-Testing</a></p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'тестирование','published_at' => '2011-09-15 11:08:10','created_at' => '2011-09-15 11:08:10','updated_at' => '2011-09-15 11:10:53','edited_at' => '2011-09-15 11:08:10'),
  array('id' => '21','title' => 'Документация с использованием Docco','slug' => 'docco','body' => 'Docco стал очень популярен среди opensource разработчиков. Уже каждый четвертый проект на github сопровождается документацией на его основе. Его можно посмотреть на примере "backbone.js":http://documentcloud.github.com/backbone/docs/backbone.html. 
#cut#

Умеет парсить js, rb, coffee, py файлы. Комментарии оформляются через markdown, а синтаксис кода подсвечивается с помощью "pygments":http://pygments.org/. 

Docco NPM — "http://jashkenas.github.com/docco/":http://jashkenas.github.com/docco/

Порты:

* Rocco (Ruby) — "http://rtomayko.github.com/rocco/":http://rtomayko.github.com/rocco/
* Shocco (Shell) — "http://rtomayko.github.com/shocco/":http://rtomayko.github.com/shocco/
* Pycco (Python) — "http://fitzgen.github.com/pycco/":http://fitzgen.github.com/pycco/
* Marginalia (Clojure) — "http://fogus.me/fun/marginalia/":http://fogus.me/fun/marginalia/
* Locco (Lue) — "http://rgieseke.github.com/locco/":http://rgieseke.github.com/locco/
* Nocco (.NET) — "http://dontangg.github.com/nocco/":http://dontangg.github.com/nocco/','body_html' => '<p>Docco стал очень популярен среди opensource разработчиков. Уже каждый четвертый проект на github сопровождается документацией на его основе. Его можно посмотреть на примере <a href="http://documentcloud.github.com/backbone/docs/backbone.html">backbone.js</a>. <br />
#cut#</p>
<p>Умеет парсить js, rb, coffee, py файлы. Комментарии оформляются через markdown, а синтаксис кода подсвечивается с помощью <a href="http://pygments.org/">pygments</a>.</p>
<p>Docco <span class="caps">NPM</span> — <a href="http://jashkenas.github.com/docco/">http://jashkenas.github.com/docco/</a></p>
<p>Порты:</p>
<ul>
	<li>Rocco (Ruby) — <a href="http://rtomayko.github.com/rocco/">http://rtomayko.github.com/rocco/</a></li>
	<li>Shocco (Shell) — <a href="http://rtomayko.github.com/shocco/">http://rtomayko.github.com/shocco/</a></li>
	<li>Pycco (Python) — <a href="http://fitzgen.github.com/pycco/">http://fitzgen.github.com/pycco/</a></li>
	<li>Marginalia (Clojure) — <a href="http://fogus.me/fun/marginalia/">http://fogus.me/fun/marginalia/</a></li>
	<li>Locco (Lue) — <a href="http://rgieseke.github.com/locco/">http://rgieseke.github.com/locco/</a></li>
	<li>Nocco (.<span class="caps">NET</span>) — <a href="http://dontangg.github.com/nocco/">http://dontangg.github.com/nocco/</a></li>
</ul>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'ruby, coffeescript, javascript, node.js','published_at' => '2011-09-23 08:15:07','created_at' => '2011-09-23 08:15:07','updated_at' => '2011-09-23 08:15:46','edited_at' => '2011-09-23 08:15:07'),
  array('id' => '22','title' => 'Обзор книг, сентябрь','slug' => 'books-september-2011','body' => 'Краткий обзор книг: Responsive Web Design, Как стать бизнесменом, Всем спасибо и Ozon.ru.
#cut#

h3. «Responsive Web Design», Ethan Marcotte

Подходы к дизайну и верстке меняются. Недавно думали, как сделать совместимую с IE6, то теперь нужна совместимость со всеми дисплеями. Об это собственно и книжка: гибкая сетка, media queries, возвращение резиновой верстки. Всё в перемешку с тонким англосаксонским юмором.

Оценка 10/10. Рекомендую веб-технологам и дизайнерам.


h3. «Как стать бизнесменом», Олег Тиньков и Олег Анисимов

Тинькова могут не любить, могут ненавидеть. Но то, что человек заряжает своей энергией, отрицать невозможно. Это один из немногих российских бизнесменов с чистой историей успеха. В книге ничего сверх нового нет, но от этого она становится менее интеренсна. Читается за один вечер. Рекомендую, в качестве развлекательной литературы с уклоном в предпринимательство.

Оценка: 8/10. Рекомендую всем. Электронный вариант стоит всего "149 рублей":http://tinkov.com/payment/.


h3. «Всем спасибо», Алекс Гой

Адепт, как зовет себя автор, основал крупнейший в питере порно-бизнес. Вот уж не знаю, как такое чудо оказалось в моей библиотеке с пометкой «Бизнес». Если же на время абстрагироваться от моральных устоев нашего общества, история вполне веселая. В каком-то роде даже познавательна. 

Оценка: 9/10. Не рекомендую ксеновобам и слабонервным.


h3. «Ozon.ru: история успешного интернет-бизнеса в России», Алекс Экслер

В книге нет абсолютно ничего полезного, больше напоминает заказную рекламную брошуру. Прочел менее половины.

Оценка: 1/10. Никому не рекомендую. Вообще.
','body_html' => '<p>Краткий обзор книг: Responsive Web Design, Как стать бизнесменом, Всем спасибо и Ozon.ru.<br />
#cut#</p>
<h3>«Responsive Web Design», Ethan Marcotte</h3>
<p>Подходы к дизайну и верстке меняются. Недавно думали, как сделать совместимую с IE6, то теперь нужна совместимость со всеми дисплеями. Об это собственно и книжка: гибкая сетка, media queries, возвращение резиновой верстки. Всё в перемешку с тонким англосаксонским юмором.</p>
<p>Оценка 10/10. Рекомендую веб-технологам и дизайнерам.</p>
<h3>«Как стать бизнесменом», Олег Тиньков и Олег Анисимов</h3>
<p>Тинькова могут не любить, могут ненавидеть. Но то, что человек заряжает своей энергией, отрицать невозможно. Это один из немногих российских бизнесменов с чистой историей успеха. В книге ничего сверх нового нет, но от этого она становится менее интеренсна. Читается за один вечер. Рекомендую, в качестве развлекательной литературы с уклоном в предпринимательство.</p>
<p>Оценка: 8/10. Рекомендую всем. Электронный вариант стоит всего <a href="http://tinkov.com/payment/">149 рублей</a>.</p>
<h3>«Всем спасибо», Алекс Гой</h3>
<p>Адепт, как зовет себя автор, основал крупнейший в питере порно-бизнес. Вот уж не знаю, как такое чудо оказалось в моей библиотеке с пометкой «Бизнес». Если же на время абстрагироваться от моральных устоев нашего общества, история вполне веселая. В каком-то роде даже познавательна.</p>
<p>Оценка: 9/10. Не рекомендую ксеновобам и слабонервным.</p>
<h3>«Ozon.ru: история успешного интернет-бизнеса в России», Алекс Экслер</h3>
<p>В книге нет абсолютно ничего полезного, больше напоминает заказную рекламную брошуру. Прочел менее половины.</p>
<p>Оценка: 1/10. Никому не рекомендую. Вообще.</p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'книги','published_at' => '2011-09-23 12:56:41','created_at' => '2011-09-23 12:56:41','updated_at' => '2012-04-05 05:11:41','edited_at' => '2011-09-23 12:56:41'),
  array('id' => '24','title' => 'Отпуск','slug' => 'vacation','body' => 'Никогда не придавал большого значения отпуску. Работал по вечерам и выходным. Выжимал из своего бедного мозга максимум. Разгрузиться получалось на иногородних конференциях. И вот решился, взял полноценный отпуск, купил путевки для себя и подруги на недельку. Специально ничего не планировал на этот период , исключил все поездки и карьерные вопросы. Пришлось даже забить на 404fest, эх. 
#cut#

В итоге даже из отпуска удалось выжать результат. Подбил итоги своих проектов и планы на ближайший квартал. Если в наших условиях можно что-либо планировать.
Не менее полезным можно считать время, проведенное за чтением книг. Очень уж приятно было валяться на шезлонге, на берегу моря под аккомпанемент прибрежных волн. В итоге прочел две с половиной книжки: «И ботаники делают бизнес» Максима Котина, «Теряя невинность» Брэнсона и половину «Programming Erlang» Джо Армстронга. Усвоенный эрланг осталось закрепить на практике и можно применять в работе. Не так страшен чёрт, как его малюют.

Ну, а о планах рассказывать бессмысленно. Скажу лишь, что всё только начинается.
','body_html' => '<p>Никогда не придавал большого значения отпуску. Работал по вечерам и выходным. Выжимал из своего бедного мозга максимум. Разгрузиться получалось на иногородних конференциях. И вот решился, взял полноценный отпуск, купил путевки для себя и подруги на недельку. Специально ничего не планировал на этот период , исключил все поездки и карьерные вопросы. Пришлось даже забить на 404fest, эх. <br />
#cut#</p>
<p>В итоге даже из отпуска удалось выжать результат. Подбил итоги своих проектов и планы на ближайший квартал. Если в наших условиях можно что-либо планировать.<br />
Не менее полезным можно считать время, проведенное за чтением книг. Очень уж приятно было валяться на шезлонге, на берегу моря под аккомпанемент прибрежных волн. В итоге прочел две с половиной книжки: «И ботаники делают бизнес» Максима Котина, «Теряя невинность» Брэнсона и половину «Programming Erlang» Джо Армстронга. Усвоенный эрланг осталось закрепить на практике и можно применять в работе. Не так страшен чёрт, как его малюют.</p>
<p>Ну, а о планах рассказывать бессмысленно. Скажу лишь, что всё только начинается.</p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'размышления','published_at' => '2011-10-03 19:52:05','created_at' => '2011-10-03 19:52:05','updated_at' => '2012-04-05 05:09:49','edited_at' => '2011-10-03 19:52:05'),
  array('id' => '27','title' => 'Comet и RubyOnRails','slug' => 'assync-servers','body' => 'Расскажу немного о том, как совместить медленный сайт на RubyOnRails c быстрыми Cramp и Node.JS для создания realtime функционала. 

#cut#

h3. Замечание

Если вам нужна асинхронность, то лучше сразу задуматься, нужны ли тут рельсы. На Cramp или Node.js можно без проблем совместить comet-транспорт с обычными http-request\'ами. Cramp хорошо сочитается с Sinatra, который недавно обзавелся своей версией "Assets Pipeline":https://github.com/stevehodgkiss/sinatra-asset-pipeline.


h3. Cramp

"Cramp":http://cramp.in/. Легкий фреймворк, использует EventMachine и файберсы. Умеет  работать с http, веб-сокетами, flash-сокетами и long-polling-запросами для старых браузеров.

Пример приложения на Cramp взят отсюда — http://www.html5rocks.com/en/tutorials/casestudies/sunlight_streamcongress.html.

app.ru

```
require "rubygems"
require "bundler"
Bundler.require
require \'cramp\'
require \'http_router\'
require \'active_support/json\'
require \'thin\'

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
  add(\'/live\').to(LiveSocket)
end
run routes

```

Запуск приложения

```
bundle exec thin --timeout 0 -R app.ru start

```

h3. Goliath

Сам я лично с ним не работал, но и упомянуть о нем не мог. Довольно известное решение в узких кругах. Посмотрите обязательно — "https://github.com/postrank-labs/goliath":https://github.com/postrank-labs/goliath.


h3. Node.js

Это конечно не ruby-way, зато выбор ноды дает нам некоторое "преимущество в производительности":http://posterous.mclov.in/unscientific-nodejs-vs-cramp-benchmarks. Что будет немаловажным при нагрузках.

Дополнительные npm модули для транспорта и маршрутизации:

* "Faye":http://faye.jcoglan.com. 
* "Jaggernaut":https://github.com/maccman/juggernaut
* "Socket.io":https://github.com/learnboost/socket.io

Подойдет любой из них. Возможности у них примерно равны.

Пример приложения с использованием Faye (app.js):


```javascript
var Faye   = require(\'faye\'),
    server = new Faye.NodeAdapter({mount: \'/live\'});

server.listen(9292); // создаем сервер

var client = server.getClient()

// прослушка канала messages
client.subscribe(\'/messages\', function(message) {
  alert(message.text);
});

// публикация в канал messages
client.publish(\'/messages\', {
  text: \'Hello world\'
});

```

Запуск:

```forever app.js```


h3. Erlang

Сложность языка накладывают свои ограничения по скорости разработки и квалификации, но это лучший выбор если вы ограничены в серверных ресурсах.

Пример работы с веб-сокетами на фреймворке MochiWeb — "https://github.com/RJ/mochiweb-websockets/tree/master/examples/websockets":https://github.com/RJ/mochiweb-websockets/tree/master/examples/websockets


h3. Склейка 

Ситуация теперь следующая. Сайт на 80м порту (пусть будет Nginx), real-time сервер на 9292. Чтобы избежать нарушения "same-origin-policy":http://en.wikipedia.org/wiki/Same_origin_policy нам потребуется объединить обе части сервера. 

Этой проблемы можно было избежать, написав всё на Node.JS или Cramp. О чем говорил в начале статьи.


h3. HAPRoxy

Сам Nginx не умеет маршрутизировать websocket\'ы и http на одном хосте. В этом поможет HAProxy — очень простой и производительный proxy-сервер.

```
wget http://haproxy.1wt.eu/download/1.4/src/haproxy-1.4.18.tar.gz
tar zxvf http://haproxy.1wt.eu/download/1.4/src/haproxy-1.4.18.tar.gz
mv haproxy-1.4.18 /usr/local/haproxy
ln -s /usr/local/haproxy/haproxy /usr/sbin/haproxy

```

Скрипт автозапуска для CentOS:

```bash
# description: HA-Proxy is a TCP/HTTP reverse proxy which is particularly suited \\
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
    echo "Errors found in configuration file, check it with \'haproxy check\'."
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

```

```
chkconfig haproxy on

```

Настроим конфигурацию для адреса 85.17.162.170. Nginx будет 8081 порту, Node.JS на 9292. Вместо Node.JS может быть любой бэкэнд, конфиг от этого не сильно изменится.

/etc/haproxy.conf

```
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

```

Необходимо убедиться, что Nginx больше не прослушивает 80й порт и в конфигах стоит "listen 85.17.162.92:8081".

Запуск.

```
service haproxy start

```


h3. Frontend

Рассмотрим на примере с Faye. 

Подключаем faye.js. 

```html
<script type="text/javascript" src="http://domain.com/faye.js"></script>
```

Этот файл генерируется самим faye.

Подключаемся к каналу /messages:

```html
var client = new Faye.Client(\'http://domain.com/live\');
var subscription = client.subscribe(\'/messages\', function(message) {
    console.log(message)
});

```


h3. Frontend

Рассмотрим на примере с Faye. 

Подключаем faye.js. 

```html
<script type="text/javascript" src="http://domain.com/faye.js"></script>
```

Этот файл генерируется самим faye.

Подключаемся к каналу /messages:

```html
var client = new Faye.Client(\'http://domain.com/live\');
var subscription = client.subscribe(\'/messages\', function(message) {
    console.log(message)
});

```


h3. Итог

Real-time приложения требуют особого подхода и далеко не все классические инструменты подходят для этих целей. Ruby хоть умеет создавать треды, обладает реализацией eventmachine и даже облегчает код файберсами, но сильно проигрывает в производительности асинхронным технологиям. В Node.JS и Erlang изначально были продуманы проблемы многозадачности и эффективного использования ресурсов. В real-time приложениях это может быть критически важным фактором.','body_html' => '<p>Расскажу немного о том, как совместить медленный сайт на RubyOnRails c быстрыми Cramp и Node.JS для создания realtime функционала.</p>
<p>#cut#</p>
<h3>Замечание</h3>
<p>Если вам нужна асинхронность, то лучше сразу задуматься, нужны ли тут рельсы. На Cramp или Node.js можно без проблем совместить comet-транспорт с обычными http-request&#8217;ами. Cramp хорошо сочитается с Sinatra, который недавно обзавелся своей версией <a href="https://github.com/stevehodgkiss/sinatra-asset-pipeline">Assets Pipeline</a>.</p>
<h3>Cramp</h3>
<p><a href="http://cramp.in/">Cramp</a>. Легкий фреймворк, использует EventMachine и файберсы. Умеет  работать с http, веб-сокетами, flash-сокетами и long-polling-запросами для старых браузеров.</p>
<p>Пример приложения на Cramp взят отсюда — http://www.html5rocks.com/en/tutorials/casestudies/sunlight_streamcongress.html. (app.ru)</p>

```ruby
require "rubygems"
require "bundler"
Bundler.require
require \'cramp\'
require \'http_router\'
require \'active_support/json\'
require \'thin\'

Cramp::Websocket.backend = :thin # используем асинхронный сервер thin

class LiveSocket &lt; Cramp::Websocket
   periodic_timer :check_activities, :every =&gt; 15

   def check_activities
     @latest_activity ||= nil
     new_activities = find_activities_since(@latest_activity)
     @latest_activity = new_activities.first unless new_activities.empty?
     render new_activities.to_json
   end
 end

routes = HttpRouter.new do
  add(\'/live\').to(LiveSocket)
end
run routes

```
<p>Запуск приложения</p>

```
bundle exec thin --timeout 0 -R app.ru start

```
<h3>Goliath</h3>
<p>Сам я лично с ним не работал, но и упомянуть о нем не мог. Довольно известное решение в узких кругах. Посмотрите обязательно — <a href="https://github.com/postrank-labs/goliath">https://github.com/postrank-labs/goliath</a>.</p>
<h3>Node.js</h3>
<p>Это конечно не ruby-way, зато выбор ноды дает нам некоторое <a href="http://posterous.mclov.in/unscientific-nodejs-vs-cramp-benchmarks">преимущество в производительности</a>. Что будет немаловажным при нагрузках.</p>
<p>Дополнительные npm модули для транспорта и маршрутизации:</p>
<ul>
	<li><a href="http://faye.jcoglan.com">Faye</a>.</li>
	<li><a href="https://github.com/maccman/juggernaut">Jaggernaut</a></li>
	<li><a href="https://github.com/learnboost/socket.io">Socket.io</a></li>
</ul>
<p>Подойдет любой из них. Возможности у них примерно равны.</p>
<p>Пример приложения с использованием Faye (app.js):</p>

```javascript
var Faye   = require(\'faye\'),
    server = new Faye.NodeAdapter({mount: \'/live\'});

server.listen(9292); // создаем сервер

var client = server.getClient()

// прослушка канала messages
client.subscribe(\'/messages\', function(message) {
  alert(message.text);
});

// публикация в канал messages
client.publish(\'/messages\', {
  text: \'Hello world\'
});

```
<p>Запуск:</p>

```
forever app.js

```

<h3>Erlang</h3>
<p>Сложность языка накладывают свои ограничения по скорости разработки и квалификации, но это лучший выбор если вы ограничены в серверных ресурсах.</p>
<p>Пример работы с веб-сокетами на фреймворке MochiWeb — <a href="https://github.com/RJ/mochiweb-websockets/tree/master/examples/websockets">https://github.com/RJ/mochiweb-websockets/tree/master/examples/websockets</a></p>
<h3>Склейка</h3>
<p>Ситуация теперь следующая. Сайт на 80м порту (пусть будет Nginx), real-time сервер на 9292. Чтобы избежать нарушения <a href="http://en.wikipedia.org/wiki/Same_origin_policy">same-origin-policy</a> нам потребуется объединить обе части сервера.</p>
<p>Этой проблемы можно было избежать, написав всё на Node.JS или Cramp. О чем говорил в начале статьи.</p>
<h3>HAPRoxy</h3>
<p>Сам Nginx не умеет маршрутизировать websocket&#8217;ы и http на одном хосте. В этом поможет HAProxy — очень простой и производительный proxy-сервер.</p>

```
wget http://haproxy.1wt.eu/download/1.4/src/haproxy-1.4.18.tar.gz
tar zxvf http://haproxy.1wt.eu/download/1.4/src/haproxy-1.4.18.tar.gz
mv haproxy-1.4.18 /usr/local/haproxy
ln -s /usr/local/haproxy/haproxy /usr/sbin/haproxy

```
<p>Скрипт автозапуска для CentOS:</p>

```bash
# description: HA-Proxy is a TCP/HTTP reverse proxy which is particularly suited \\
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
[ ${NETWORKING} = "no" ] &amp;&amp; exit 0

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
  [ $RETVAL -eq 0 ] &amp;&amp; touch /var/lock/subsys/haproxy
  return $RETVAL
}

stop() {
  echo -n "Shutting down HAproxy: "
  killproc haproxy -USR1
  RETVAL=$?
  echo
  [ $RETVAL -eq 0 ] &amp;&amp; rm -f /var/lock/subsys/haproxy
  [ $RETVAL -eq 0 ] &amp;&amp; rm -f /var/run/haproxy.pid
  return $RETVAL
}

restart() {
  /usr/sbin/haproxy -c -q -f /etc/haproxy.cfg
  if [ $? -ne 0 ]; then
    echo "Errors found in configuration file, check it with \'haproxy check\'."
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
  [ -e /var/lock/subsys/haproxy ] &amp;&amp; restart || :
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

```

```
chkconfig haproxy on

```
<p>Настроим конфигурацию для адреса 85.17.162.170. Nginx будет 8081 порту, Node.JS на 9292. Вместо Node.JS может быть любой бэкэнд, конфиг от этого не сильно изменится.</p>

/etc/haproxy.conf

```
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

```
<p>Необходимо убедиться, что Nginx больше не прослушивает 80й порт и в конфигах стоит &#8220;listen 85.17.162.92:8081&#8221;.</p>
<p>Запуск.</p>

```
service haproxy start

```
<h3>Frontend</h3>
<p>Рассмотрим на примере с Faye.</p>
<p>Подключаем faye.js.</p>

```html
&lt;script type="text/javascript" src="http://domain.com/faye.js"&gt;&lt;/script&gt;
```
<p>Этот файл генерируется самим faye.</p>
<p>Подключаемся к каналу /messages:</p>

```html
var client = new Faye.Client(\'http://domain.com/live\');
var subscription = client.subscribe(\'/messages\', function(message) {
    console.log(message)
});

```
<h3>Frontend</h3>
<p>Рассмотрим на примере с Faye.</p>
<p>Подключаем faye.js.</p>

```html
&lt;script type="text/javascript" src="http://domain.com/faye.js"&gt;&lt;/script&gt;
```
<p>Этот файл генерируется самим faye.</p>
<p>Подключаемся к каналу /messages:</p>

```html
var client = new Faye.Client(\'http://domain.com/live\');
var subscription = client.subscribe(\'/messages\', function(message) {
    console.log(message)
});

```
<h3>Итог</h3>
<p>Real-time приложения требуют особого подхода и далеко не все классические инструменты подходят для этих целей. Ruby хоть умеет создавать треды, обладает реализацией eventmachine и даже облегчает код файберсами, но сильно проигрывает в производительности асинхронным технологиям. В Node.JS и Erlang изначально были продуманы проблемы многозадачности и эффективного использования ресурсов. В real-time приложениях это может быть критически важным фактором.</p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'rails, ruby, node.js, erlang','published_at' => '2011-10-19 15:55:57','created_at' => '2011-10-19 15:55:57','updated_at' => '2011-12-13 13:45:56','edited_at' => '2011-10-19 15:55:57'),
  array('id' => '28','title' => 'Обзор книг, октябрь','slug' => 'books-october-2011','body' => 'На этот раз подвернулись: Теряя невинность, И ботаники делают бизнес, Сначала скажите «нет» и Ruby Best Practice.
#cut#


h3. Теряя невинность, Ричард Брэнсон

Эту книгу, наверно, уже все прочли. Веселая и насыщенная история, было интересно почитать.

Оценка 5/5


h3. И ботаники делают бизнес, Максим Котин

Евгений Чичваркин помнится назвал её самой честной книгой о предпринимательстве в современной России. Очень хорошо читается после Брэнсона.

Оценка 5/5


h3. Сначала скажите «нет», Джим Кэмп

Раньше не попадалось книг по переговорам, сравнивать не с чем. Скажу лишь, прочитав эту книгу раньше, возможно, мог бы избежать некоторых ошибок в прошлом. Например, на собеседованиях, при согласовании цен на фрилансе или при покупке машины.

Оценка 4/5


h3. Ruby Best Practices, Gregory Brown

Я бы назвал это недостающим звеном между классической Ruby Way, Хала Фултона и мемуарами о RubyOnRails. В книге описано немало полезных техник, которые сразу взял к себе в инструментарий. Однозначно, must-read для рубистов.

Оценка 5/5


h3. Облачная демократия

Умело прошлись по больным местам вертикального правления, только вот предложенное решение чрезмерно упираются на сети. Кто же будет следить за всем этим «Скайнетом»? Вопрос риторический. 

Оценка 4/5','body_html' => '<p>На этот раз подвернулись: Теряя невинность, И ботаники делают бизнес, Сначала скажите «нет» и Ruby Best Practice.<br />
#cut#</p>
<h3>Теряя невинность, Ричард Брэнсон</h3>
<p>Эту книгу, наверно, уже все прочли. Веселая и насыщенная история, было интересно почитать.</p>
<p>Оценка 5/5</p>
<h3>И ботаники делают бизнес, Максим Котин</h3>
<p>Евгений Чичваркин помнится назвал её самой честной книгой о предпринимательстве в современной России. Очень хорошо читается после Брэнсона.</p>
<p>Оценка 5/5</p>
<h3>Сначала скажите «нет», Джим Кэмп</h3>
<p>Раньше не попадалось книг по переговорам, сравнивать не с чем. Скажу лишь, прочитав эту книгу раньше, возможно, мог бы избежать некоторых ошибок в прошлом. Например, на собеседованиях, при согласовании цен на фрилансе или при покупке машины.</p>
<p>Оценка 4/5</p>
<h3>Ruby Best Practices, Gregory Brown</h3>
<p>Я бы назвал это недостающим звеном между классической Ruby Way, Хала Фултона и мемуарами о RubyOnRails. В книге описано немало полезных техник, которые сразу взял к себе в инструментарий. Однозначно, must-read для рубистов.</p>
<p>Оценка 5/5</p>
<h3>Облачная демократия</h3>
<p>Умело прошлись по больным местам вертикального правления, только вот предложенное решение чрезмерно упираются на сети. Кто же будет следить за всем этим «Скайнетом»? Вопрос риторический.</p>
<p>Оценка 4/5</p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'книги','published_at' => '2011-10-28 18:17:34','created_at' => '2011-10-28 18:17:34','updated_at' => '2012-04-05 05:12:05','edited_at' => '2011-10-28 18:17:34'),
  array('id' => '29','title' => 'Разработка в распределенных коммандах','slug' => 'distributed-development','body' => 'В нашей компании несколько команд из разных городов, в сумме несколько десятков разработчиков. При этом получается стабильно разрабатывать и запускать новые проекты. Расскажу немного о том, как всё устроено.
#cut#

h3. Инструменты

* Git;
* Система управления проектами. У нас используется "Unfuddle":http://unfuddle.com, но я бы не называл его удачным выбором. Можете подобрать себе по вкусу, необходимы будут тикеты, wiki и подсчет времени (estimates). И не менее полезным будет хостинг репозиториев, привязки коммитов к тикету и тикетами друг с другом (assigns);
* Skype.

h3. Роли

Каждый проект курирует один человек — руководитель проекта. Он занимается проектированием архитектуры, составлением и разделением задач по командам.
В каждой команде присутствует один ведущий разработчик (DevLead). В идеале руководитель не должен давать прямых указаний разработчикам. Его задача раздавать и принимать задачи в команде.
Разработчики, дизайнеры, тестеры и т.д.

h3. Разработка

Продемонстрирую на примере.

* Руководитель создает тикет (задачу), назовем её «Разработать систему приема платежей ВКонтакте» и направляет девлиду.
* Лид детально дополняет детали реализации, выставляет сроки (initial estimates) и отправляет задачу члену команды. 
* Разработчик принимает тикет, в рабочем репозитории создает отдельную ветку (git checkout -b branchname), в качестве имени используется номер тикета. 
* Во время работы разработчик отчитывается по каждому этапу в тайм-трекере. Например, «изучил API ВКонтакте — 1 час», «написал класс VKPayment — 2 час» и «написал спеки и протестировал — 3 часа».
* Бранч отправляется в общий репозиторий (git push origin branchname), выставляет в тикете id-коммита и отправляет тикет девлиду. Если коммитов было несколько в бранче, то их склеивают (squash) в один (git rebase -i).
* Лид проверяет реализации, качество кода, тесты и общую работоспособность. В случае замечаний отправляется на доработку, либо сливает в ветку проекта (git merge). Дальше может сам закрыть тикет, либо и отправить руководителю. 

По аналогичной схеме формируются и другие задачи. Будь-то баг-фиксы или тестирование.

h3. Внедрение нового разработчика в команду

Разворачивается своё локальное рабочее окружение, примерно по такой инструкции:
* клонирование репозитория;
* настройка конфигов проекта;
* установка rvm, ruby, gems и других зависимостей;
* установка СУБД, создание баз и запуск миграций.

При этом время затраченное на установку также фиксируется в estimates-разработчика.

h3. Выкатывание релизов

Деплоем занимается руководитель проекта. Прогоняются тесты и с помощью capistrano выкладывается обновление на всех серверах. 

h3. Рекомендации

* Разработчикам в начале рабочего дня рекомендуется забирать последнюю версию проекта (git pull) и обновлять свою ветку (git rebase master).
* В комментарии коммита можно указывать номер тикета. Это будет полезно при изучении истории коммитов (git log).
* Крупные задачи можно разбить на несколько тикетов и раздать нескольким разработчикам.

h3. От КО

* Весь код желательно покрывать блочными и интеграционным тестами. Они помогут держать проект в рабочем состоянии.
* Делайте рефакторинг и code-review для поддержания качества кода.


h3. Заключение

Получается вполне отработанная методология, подойдет для работы в обычной компании, либо при работе с фрилансерами. А наличие личного общения только придаст эффективности.','body_html' => '<p>В нашей компании несколько команд из разных городов, в сумме несколько десятков разработчиков. При этом получается стабильно разрабатывать и запускать новые проекты. Расскажу немного о том, как всё устроено.<br />
#cut#</p>
<h3>Инструменты</h3>
<ul>
	<li>Git;</li>
	<li>Система управления проектами. У нас используется <a href="http://unfuddle.com">Unfuddle</a>, но я бы не называл его удачным выбором. Можете подобрать себе по вкусу, необходимы будут тикеты, wiki и подсчет времени (estimates). И не менее полезным будет хостинг репозиториев, привязки коммитов к тикету и тикетами друг с другом (assigns);</li>
	<li>Skype.</li>
</ul>
<h3>Роли</h3>
<p>Каждый проект курирует один человек — руководитель проекта. Он занимается проектированием архитектуры, составлением и разделением задач по командам.<br />
В каждой команде присутствует один ведущий разработчик (DevLead). В идеале руководитель не должен давать прямых указаний разработчикам. Его задача раздавать и принимать задачи в команде.<br />
Разработчики, дизайнеры, тестеры и т.д.</p>
<h3>Разработка</h3>
<p>Продемонстрирую на примере.</p>
<ul>
	<li>Руководитель создает тикет (задачу), назовем её «Разработать систему приема платежей ВКонтакте» и направляет девлиду.</li>
	<li>Лид детально дополняет детали реализации, выставляет сроки (initial estimates) и отправляет задачу члену команды.</li>
	<li>Разработчик принимает тикет, в рабочем репозитории создает отдельную ветку (git checkout -b branchname), в качестве имени используется номер тикета.</li>
	<li>Во время работы разработчик отчитывается по каждому этапу в тайм-трекере. Например, «изучил <span class="caps">API</span> ВКонтакте — 1 час», «написал класс VKPayment — 2 час» и «написал спеки и протестировал — 3 часа».</li>
	<li>Бранч отправляется в общий репозиторий (git push origin branchname), выставляет в тикете id-коммита и отправляет тикет девлиду. Если коммитов было несколько в бранче, то их склеивают (squash) в один (git rebase -i).</li>
	<li>Лид проверяет реализации, качество кода, тесты и общую работоспособность. В случае замечаний отправляется на доработку, либо сливает в ветку проекта (git merge). Дальше может сам закрыть тикет, либо и отправить руководителю.</li>
</ul>
<p>По аналогичной схеме формируются и другие задачи. Будь-то баг-фиксы или тестирование.</p>
<h3>Внедрение нового разработчика в команду</h3>
<p>Разворачивается своё локальное рабочее окружение, примерно по такой инструкции:</p>
<ul>
	<li>клонирование репозитория;</li>
	<li>настройка конфигов проекта;</li>
	<li>установка rvm, ruby, gems и других зависимостей;</li>
	<li>установка СУБД, создание баз и запуск миграций.</li>
</ul>
<p>При этом время затраченное на установку также фиксируется в estimates-разработчика.</p>
<h3>Выкатывание релизов</h3>
<p>Деплоем занимается руководитель проекта. Прогоняются тесты и с помощью capistrano выкладывается обновление на всех серверах.</p>
<h3>Рекомендации</h3>
<ul>
	<li>Разработчикам в начале рабочего дня рекомендуется забирать последнюю версию проекта (git pull) и обновлять свою ветку (git rebase master).</li>
	<li>В комментарии коммита можно указывать номер тикета. Это будет полезно при изучении истории коммитов (git log).</li>
	<li>Крупные задачи можно разбить на несколько тикетов и раздать нескольким разработчикам.</li>
</ul>
<h3>От КО</h3>
<ul>
	<li>Весь код желательно покрывать блочными и интеграционным тестами. Они помогут держать проект в рабочем состоянии.</li>
	<li>Делайте рефакторинг и code-review для поддержания качества кода.</li>
</ul>
<h3>Заключение</h3>
<p>Получается вполне отработанная методология, подойдет для работы в обычной компании, либо при работе с фрилансерами. А наличие личного общения только придаст эффективности.</p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'git','published_at' => '2011-12-12 19:28:07','created_at' => '2011-12-12 19:28:07','updated_at' => '2012-01-30 06:18:56','edited_at' => '2011-12-12 19:28:07'),
  array('id' => '30','title' => 'Советы Павла Дурова	 ','slug' => 'advices-by-durov','body' => '
<noindex>
<p>1. Пойми, что тебе по-настоящему нравится. Золотое правило гласит – делай то, что доставляет истинное удовольствие, и тогда ты станешь намного счастливее.</p>
<p>2. Откажись от мусора, который ты ешь, пьешь и куришь каждый день. Никаких секретов и хитрых диет – натуральная пища, фрукты, овощи, вода. Не надо становиться вегетарианцем и полностью завязывать с выпивкой, – достаточно лишь максимально ограничить сахар, муку, кофе, алкоголь и всю пластмассовую еду.</p>
<p>3. Учи иностранные языки. Это расширит глубину восприятия мира и откроет невиданные перспективы для обучения, развития и карьерного роста. Русскоязычных пользователей интернета 60 миллионов. Англоязычных – миллиард. Центр прогресса сейчас находится по другую сторону границы, в том числе языковой. Знание английского – это уже не просто прихоть интеллигентов, а жизненная необходимость.</p>
<p>4. Читай книги. Примерный круг – твоя профессиональная область, история, естествознание, личностный рост, социология, психология, биографии, качественная художественная литература. Нет времени читать потому, что ездишь за рулем – слушай аудиокниги. Золотое правило – читай/слушай как минимум одну книгу в неделю. Это 50 книг в год, которые перевернут твою жизнь.</p>
<p>5. Проводи с толком каждые выходные. Сходи в музей, займись спортом, съезди за город, прыгни с парашютом, навести родственников, сходи на хороший фильм. Расширяй зону контакта с миром. Чем больше впечатлений ты пропустишь через себя, тем интереснее будет жизнь, и тем лучше ты будешь разбираться в вещах и явлениях.</p>
<p>6. Начни вести блог или обычный дневник. Все равно о чем. Не беда, что ты не обладаешь красноречием и у тебя будет не больше 10 читателей. Главное, что на его страницах ты сможешь думать и рассуждать. А если ты просто регулярно пишешь о том, что ты любишь, читатели обязательно придут.</p>
<p>7. Ставь цели, фиксируй их на бумаге, в Word’е или блоге. Главное, чтобы они были четкими, понятными и измеримыми. Если поставишь цель, то можешь ее или достигнуть, или нет. Если не поставишь, то вариантов достижения нет вообще.</p>
<p>8. Оседлай время. Научись управлять своими делами так, чтобы они работали почти без твоего участия. Для начала почитай Аллена (Getting Things Done) или Глеба Архангельского. Принимай решения быстро, действуй незамедлительно, не откладывай на потом. Все дела либо делай, либо делегируй кому-то.</p>
<p>9. Откажись от компьютерных игр, бесцельного сидения в социальных сетях и тупого серфинга в интернете. Минимизируй общение в соцсетях, оставь один аккаунт. Уничтожь в квартире телевизионную антенну.</p>
<p>10. Перестань читать новости. Все равно о ключевых событиях будут говорить все вокруг, а дополнительная шумовая информация не приводит к улучшению качества принятия решений.</p>
<p>11. Научись рано вставать. Парадокс в том, что в ранние часы ты всегда успеваешь больше, чем в вечерние. Если летом на выходных ты выедешь из Москвы в 7 утра, то к 10 ты уже будешь в Ярославле. Если выедешь в 10, то будешь там в лучшем случае к обеду. Человеку достаточно 7 часов сна, при условии качественной физической нагрузки и нормальном питании.</p>
<p>12. Старайся окружать себя порядочными, честными, открытыми, умными и успешными людьми. Мы – это наше окружение, у которого мы учимся всему, что знаем. Проводи больше времени с людьми, которых ты уважаешь и у которых можно чему-нибудь научиться (особенно важно, чтобы в категорию таких людей попадало твое начальство).</p>
<p>13. Используй каждый момент времени и каждого человека для того, чтобы узнать что-то новое. Если жизнь сводит тебя с профессионалом в любой области, попытайся понять, что составляет суть его работы, каковы его мотивации и цели. Учись задавать правильные вопросы – даже таксист может стать бесценным источником информации.</p>
</blockquote>','body_html' => '<noindex>
<p>1. Пойми, что тебе по-настоящему нравится. Золотое правило гласит – делай то, что доставляет истинное удовольствие, и тогда ты станешь намного счастливее.</p>
<p>2. Откажись от мусора, который ты ешь, пьешь и куришь каждый день. Никаких секретов и хитрых диет – натуральная пища, фрукты, овощи, вода. Не надо становиться вегетарианцем и полностью завязывать с выпивкой, – достаточно лишь максимально ограничить сахар, муку, кофе, алкоголь и всю пластмассовую еду.</p>
<p>3. Учи иностранные языки. Это расширит глубину восприятия мира и откроет невиданные перспективы для обучения, развития и карьерного роста. Русскоязычных пользователей интернета 60 миллионов. Англоязычных – миллиард. Центр прогресса сейчас находится по другую сторону границы, в том числе языковой. Знание английского – это уже не просто прихоть интеллигентов, а жизненная необходимость.</p>
<p>4. Читай книги. Примерный круг – твоя профессиональная область, история, естествознание, личностный рост, социология, психология, биографии, качественная художественная литература. Нет времени читать потому, что ездишь за рулем – слушай аудиокниги. Золотое правило – читай/слушай как минимум одну книгу в неделю. Это 50 книг в год, которые перевернут твою жизнь.</p>
<p>5. Проводи с толком каждые выходные. Сходи в музей, займись спортом, съезди за город, прыгни с парашютом, навести родственников, сходи на хороший фильм. Расширяй зону контакта с миром. Чем больше впечатлений ты пропустишь через себя, тем интереснее будет жизнь, и тем лучше ты будешь разбираться в вещах и явлениях.</p>
<p>6. Начни вести блог или обычный дневник. Все равно о чем. Не беда, что ты не обладаешь красноречием и у тебя будет не больше 10 читателей. Главное, что на его страницах ты сможешь думать и рассуждать. А если ты просто регулярно пишешь о том, что ты любишь, читатели обязательно придут.</p>
<p>7. Ставь цели, фиксируй их на бумаге, в Word’е или блоге. Главное, чтобы они были четкими, понятными и измеримыми. Если поставишь цель, то можешь ее или достигнуть, или нет. Если не поставишь, то вариантов достижения нет вообще.</p>
<p>8. Оседлай время. Научись управлять своими делами так, чтобы они работали почти без твоего участия. Для начала почитай Аллена (Getting Things Done) или Глеба Архангельского. Принимай решения быстро, действуй незамедлительно, не откладывай на потом. Все дела либо делай, либо делегируй кому-то.</p>
<p>9. Откажись от компьютерных игр, бесцельного сидения в социальных сетях и тупого серфинга в интернете. Минимизируй общение в соцсетях, оставь один аккаунт. Уничтожь в квартире телевизионную антенну.</p>
<p>10. Перестань читать новости. Все равно о ключевых событиях будут говорить все вокруг, а дополнительная шумовая информация не приводит к улучшению качества принятия решений.</p>
<p>11. Научись рано вставать. Парадокс в том, что в ранние часы ты всегда успеваешь больше, чем в вечерние. Если летом на выходных ты выедешь из Москвы в 7 утра, то к 10 ты уже будешь в Ярославле. Если выедешь в 10, то будешь там в лучшем случае к обеду. Человеку достаточно 7 часов сна, при условии качественной физической нагрузки и нормальном питании.</p>
<p>12. Старайся окружать себя порядочными, честными, открытыми, умными и успешными людьми. Мы – это наше окружение, у которого мы учимся всему, что знаем. Проводи больше времени с людьми, которых ты уважаешь и у которых можно чему-нибудь научиться (особенно важно, чтобы в категорию таких людей попадало твое начальство).</p>
<p>13. Используй каждый момент времени и каждого человека для того, чтобы узнать что-то новое. Если жизнь сводит тебя с профессионалом в любой области, попытайся понять, что составляет суть его работы, каковы его мотивации и цели. Учись задавать правильные вопросы – даже таксист может стать бесценным источником информации.</p>
</blockquote>','active' => '1','approved_comments_count' => '0','cached_tag_list' => '','published_at' => '2012-01-19 06:43:16','created_at' => '2012-01-19 06:43:16','updated_at' => '2012-04-06 09:12:45','edited_at' => '2012-04-06 09:12:45'),
  array('id' => '31','title' => 'JSLint в Sublime Text','slug' => 'sublime-text-jslint-integration','body' => 'Расскажу, как совместить два полезных наиполезнейших инструмента, крутой редактор Sublime Text 2 и анализатор javascript-кода, JSLint. 

#cut#

Консольный JSLint берем отсюда — "http://www.javascriptlint.com/download.htm":http://www.javascriptlint.com/download.htm

Создаем новый build-сценарий: Tools → Build Systems → New Build System

<img src="/system/sublime_jslint.png" />

Вставляем и настраиваем путь до jslint:

```javascript
{
   "cmd": ["d:/lib/jsl/jsl.exe", "-process", "$file"],
   "selector": "source.js"
}

```

Сохраняем файл. Нажимаем CTRL+B и наслаждаемся результатом.

<img src="/system/sublime_jslint2.png" />

Это всё. Пишите качественный код и не болейте.

','body_html' => '<p>Расскажу, как совместить два полезных наиполезнейших инструмента, крутой редактор Sublime Text 2 и анализатор javascript-кода, JSLint.</p>
<p>#cut#</p>
<p>Консольный JSLint берем отсюда — <a href="http://www.javascriptlint.com/download.htm">http://www.javascriptlint.com/download.htm</a></p>
<p>Создаем новый build-сценарий: Tools → Build Systems → New Build System</p>
<p><img src="/system/sublime_jslint.png" /></p>
<p>Вставляем и настраиваем путь до jslint:</p>

```json{
   "cmd": ["d:/lib/jsl/jsl.exe", "-process", "$file"],
   "selector": "source.js"
}

```
<p>Сохраняем файл. Нажимаем CTRL+B и наслаждаемся результатом.</p>
<p><img src="/system/sublime_jslint2.png" /></p>
<p>Это всё. Пишите качественный код и не болейте.</p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'javascript','published_at' => '2012-01-23 18:06:07','created_at' => '2012-01-23 18:06:07','updated_at' => '2012-04-05 05:11:14','edited_at' => '2012-01-23 18:06:07'),
  array('id' => '32','title' => 'Обзор книг, январь','slug' => 'books-jun-2012','body' => 'Понемногу начал восстанавливать прежнюю скорость освоения литературы, а то совсем уже обленился.
 
#cut#


h3. Не мешайте мне работать! Стас Давыдов.

Веселая книжка о личной мотивации, рабочей атмосфере и общению в коллективе.

Рекомендую послушать подкаст с участием Стаса «<a href="http://shami13.podfm.ru/it-career/16">Откровенно про IT-карьеризм</a>», где он рассказывает о себе и об этой книге.

Моя оценка: 5/5, Goodreads 4.35/5.

h3. Бизнес в стиле фанк. Капитал пляшет под дудку таланта. (Funky business)

На трехстах страницах изложена суть десятка книг по ведению бизнеса в эпоху информационных технологий. 

Оценка 5/5, Goodreads: 4.25/5.


h3. Metaprogramming Ruby, Paolo Perrotta.

Подробно описаны динамические возможности языка Ruby, которые могут помочь значительно упростить и повысить эффективность кода. Половина книги посвящена gem\'у ActiveRecord, как пример удачного применения метапрограммирования. Must read для рубистов.

Оценка 5/5, Goodreads: 4.33/5.



h3. Черная книга менеджера, Слава Панкратов.

Всю книгу можно пересказать в нескольких словах — начальство всегда право, во всем виноват менеджер. 

Слабость содержания еще можно компенсировать краткостью изложения, читается за пару часов от силы. Но постоянные вставки с оскорблениями в адрес менеджера (читателя) всякий раз отбивало желание читать. 

P.S. Белый текст на черном фоне — не комильфо, совсем.

Оценка: 1/5,  Goodreads: 3.09/5.
','body_html' => '<p>Понемногу начал восстанавливать прежнюю скорость освоения литературы, а то совсем уже обленился.</p>
<p>#cut#</p>
<h3>Не мешайте мне работать! Стас Давыдов.</h3>
<p>Веселая книжка о личной мотивации, рабочей атмосфере и общению в коллективе.</p>
<p>Рекомендую послушать подкаст с участием Стаса «<a href="http://shami13.podfm.ru/it-career/16">Откровенно про IT-карьеризм</a>», где он рассказывает о себе и об этой книге.</p>
<p>Моя оценка: 5/5, Goodreads 4.35/5.</p>
<h3>Бизнес в стиле фанк. Капитал пляшет под дудку таланта. (Funky business)</h3>
<p>На трехстах страницах изложена суть десятка книг по ведению бизнеса в эпоху информационных технологий.</p>
<p>Оценка 5/5, Goodreads: 4.25/5.</p>
<h3>Metaprogramming Ruby, Paolo Perrotta.</h3>
<p>Подробно описаны динамические возможности языка Ruby, которые могут помочь значительно упростить и повысить эффективность кода. Половина книги посвящена gem&#8217;у ActiveRecord, как пример удачного применения метапрограммирования. Must read для рубистов.</p>
<p>Оценка 5/5, Goodreads: 4.33/5.</p>
<h3>Черная книга менеджера, Слава Панкратов.</h3>
<p>Всю книгу можно пересказать в нескольких словах — начальство всегда право, во всем виноват менеджер.</p>
<p>Слабость содержания еще можно компенсировать краткостью изложения, читается за пару часов от силы. Но постоянные вставки с оскорблениями в адрес менеджера (читателя) всякий раз отбивало желание читать.</p>
<p>P.S. Белый текст на черном фоне — не комильфо, совсем.</p>
<p>Оценка: 1/5,  Goodreads: 3.09/5.</p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'книги','published_at' => '2012-01-31 05:44:19','created_at' => '2012-01-31 05:44:19','updated_at' => '2012-04-05 05:12:22','edited_at' => '2012-01-31 05:44:19'),
  array('id' => '34','title' => 'Обзор книг за февраль и март','slug' => 'books-feb-mar-2012','body' => 'h3. Rails AntiPatterns: Best Practice Ruby on Rails Refactoring
Хорошая книга для уже знающих Rails, чтобы немного улучшить качество своего кода. 

Оценка 4/5 

h3. Eloquent Ruby

Подходит в качестве дополнения к Metaprogramming Ruby. Интересные главы по интерпретаторам Ruby и DSL.

Оценка 4/5

h3. The Well-Grounded Rubyist

Неоднозначное впечатление оставила эта книга. В ней детально описаны многие методы стандартных классов ruby, что наверняка вызовет дислексию у новичков. А более опытным разработчикам будет просто скучно читать.

Оценка 3/5


h3. Цельная жизнь (The Power of Focus)  

Считаю, что подобные книги — это скорее раздаточный материал к авторам — коучерам, нежели самостоятельное чтиво. 

Оценка 3/5

h3. Refactoring in Ruby

Рецепты "рефакторинга Фаулера":http://www.goodreads.com/book/show/44936.Refactoring в исполнении Ruby. Будет полезна, если ранее не были знакомы с его творчеством.

Оценка 3/5

h3. Steve Jobs

Книга заслуженный бестселлер. Уже немало было сказано.

Оценка 5/5

h3. The Zen Teaching of ”Homeless” Kodo

Около двух лет не читал ничего о буддизме и Дзену. Взялся за нее из-за упоминания в "Джобсе":http://www.goodreads.com/book/show/11084145-steve-jobs . 

Теперь собственно о книге. Повествование идет в виде коротких, но поучительных историй из жизни учителя Кодо (Kodo Sawaki Roshi) с комментариями ученика (автора). Читается легко и за короткий срок. Будет полезно время от времени перечитывать.

Оценка 5/5

h3. Руководство по чтению великих произведений. Адлер М. 

Достаточно одной цитаты из книги, чтобы понять всю суть:

«Человек, который много, но плохо читал, заслуживает скорее жалости, чем похвалы, за то, что так бездарно потратил время и усилия.» 

Павел Калугин разрядился аж целой статей после прочтения — "http://pavelkalugin.ru/2011/04/25/pravila-chteniya/":http://pavelkalugin.ru/2011/04/25/pravila-chteniya/


После прочтения этой книги наблюдаю у себя один побочный эффект — появилось невероятное желание прочесть Достоевского, Чехова, Маяковского и переосмыслить Булгакова.

Оценка 5/5


h3. The RSpec Book: Behaviour Driven Development with Rspec, Cucumber, and Friends.


Начальные главы посвящены Cucumber и BDD. Их в принципе можно безболезненно пропустить, если он вам интересен только RSpec и инструменты тестирования. На текущий момент лучше книги по RSpec вы не найдете.

Оценка 5/5
','body_html' => '<h3>Rails AntiPatterns: Best Practice Ruby on Rails Refactoring<br />
Хорошая книга для уже знающих Rails, чтобы немного улучшить качество своего кода.</h3>
<p>Оценка 4/5</p>
<h3>Eloquent Ruby</h3>
<p>Подходит в качестве дополнения к Metaprogramming Ruby. Интересные главы по интерпретаторам Ruby и <span class="caps">DSL</span>.</p>
<p>Оценка 4/5</p>
<h3>The Well-Grounded Rubyist</h3>
<p>Неоднозначное впечатление оставила эта книга. В ней детально описаны многие методы стандартных классов ruby, что наверняка вызовет дислексию у новичков. А более опытным разработчикам будет просто скучно читать.</p>
<p>Оценка 3/5</p>
<h3>Цельная жизнь (The Power of Focus)</h3>
<p>Считаю, что подобные книги — это скорее раздаточный материал к авторам — коучерам, нежели самостоятельное чтиво.</p>
<p>Оценка 3/5</p>
<h3>Refactoring in Ruby</h3>
<p>Рецепты <a href="http://www.goodreads.com/book/show/44936.Refactoring">рефакторинга Фаулера</a> в исполнении Ruby. Будет полезна, если ранее не были знакомы с его творчеством.</p>
<p>Оценка 3/5</p>
<h3>Steve Jobs</h3>
<p>Книга заслуженный бестселлер. Уже немало было сказано.</p>
<p>Оценка 5/5</p>
<h3>The Zen Teaching of ”Homeless” Kodo</h3>
<p>Около двух лет не читал ничего о буддизме и Дзену. Взялся за нее из-за упоминания в <a href="http://www.goodreads.com/book/show/11084145-steve-jobs">Джобсе</a> .</p>
<p>Теперь собственно о книге. Повествование идет в виде коротких, но поучительных историй из жизни учителя Кодо (Kodo Sawaki Roshi) с комментариями ученика (автора). Читается легко и за короткий срок. Будет полезно время от времени перечитывать.</p>
<p>Оценка 5/5</p>
<h3>Руководство по чтению великих произведений. Адлер М.</h3>
<p>Достаточно одной цитаты из книги, чтобы понять всю суть:</p>
<p>«Человек, который много, но плохо читал, заслуживает скорее жалости, чем похвалы, за то, что так бездарно потратил время и усилия.»</p>
<p>Павел Калугин разрядился аж целой статей после прочтения — <a href="http://pavelkalugin.ru/2011/04/25/pravila-chteniya/">http://pavelkalugin.ru/2011/04/25/pravila-chteniya/</a></p>
<p>После прочтения этой книги наблюдаю у себя один побочный эффект — появилось невероятное желание прочесть Достоевского, Чехова, Маяковского и переосмыслить Булгакова.</p>
<p>Оценка 5/5</p>
<h3>The RSpec Book: Behaviour Driven Development with Rspec, Cucumber, and Friends.</h3>
<p>Начальные главы посвящены Cucumber и <span class="caps">BDD</span>. Их в принципе можно безболезненно пропустить, если он вам интересен только RSpec и инструменты тестирования. На текущий момент лучше книги по RSpec вы не найдете.</p>
<p>Оценка 5/5</p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'книги','published_at' => '2012-04-01 10:47:48','created_at' => '2012-04-01 10:47:48','updated_at' => '2012-04-01 10:48:32','edited_at' => '2012-04-01 10:47:48'),
  array('id' => '35','title' => 'PostgreSQL. Заметки по оптимизации.','slug' => 'postgres-high-perfomance','body' => 'Читая книгу "PostgreSQL 9.0 High Performance":http://www.goodreads.com/book/show/10033368-postgresql-9-0-high-performance, выписал некоторые интересные моменты, которые могут оказаться полезными простым разработчикам.



h3. Полезные команды.

EXPLAIN ANALYZE [sql] — анализ выполненного запроса (используемые ноды, время выполнения, использование индексов).

VACUUM — дефрагментация базы. Можно запускать, если отключен autovacuum. Рекомендуется выполнять после большого удаления данных.

REINDEX INDEX [index_name] — перестройка индекса.

REINDEX TABLE [table_name] — перестройка индексов всей таблицы.


h3. Анализаторы логов

"pgFouine":http://pgfouine.projects.postgresql.org/, "pgsi":http://bucardo.org/wiki/Pgsi, 
"mk-query-digest":http://www.maatkit.org/doc/mk-query-digest.html

pgFouine — наиболее удобный, хоть и требует веб-сервер для запуска.

h3. Рекомендации по использованию индексов

Ставьте индексы на поля, по которым происходит поиск или сортировка.

Исключите использование ненужных индексов (найти их поможет EXPLAIN ANALYZE)



h3. Индексы

B-Tree – индекс по-умолчанию. Подходит для всех типов.

Hash — эффективен при поиске по равенству: column_name = \'value\'.

GIN — дает быстрый поиск, но долгое обновление при INSERT. Применим для полнотекстового поиска.

GiST — для полнотекстового поиска. Быстрый поиск, но долгое обновление индекса. Так же применим для полнотекстового поиска.


При поиске с использованием LIKE или POSIX задать специальный параметр: 

```sql
CREATE INDEX index_name ON table_name(column_name varchar_pattern_ops);
```

Для других типов: text_pattern_ops, bpchar_pattern_ops, name_pattern_ops.


h3. Составной индекс

При поиске по по двум и более колонкам можно использовать составной индекс:

```sql
CREATE INDEX index_name ON table_name(col_1, col_2);
```

h3. Частичный индекс

В случае, если поиск совершается только по какому-то одному значению:

```sql
CREATE INDEX index_name ON table name WHERE column_name IS value;
```

h3. Сортировка индексов

При сортировке по индексу в одну сторону, например DESC, можно настроить и сам индекс:

```sql
CREATE INDEX index_name ON  table_name(column_name DESC);
 ```

Если имеются значения NULL, можно подвинуть их в начало:

```sql
CREATE INDEX index_name ON  table_name(column_name NULLS FIRST);
```

По умолчанию значения NULL хранятся в конце.


h3. Обработка значений в индексе

Если в запросах используются функции:

```sql
SELECT * FROM table_name WHERE lower(column_name) = \'x\';
```

Можно подготовить значения и в самом индексе:

```sql
CREATE INDEX index_name ON table_name(lower(column_name)); 
```

h3. OFFSET 0

Использование «OFFSET 0» ускорит выполнение вложенных запросов:

```sql
SELECT l.prod_id FROM orderlines l
WHERE EXISTS (SELECT * FROM customers JOIN orders USING (customerid) WHERE orders.orderid = l.orderid OFFSET 0)
AND l.orderdate=\'2004-12-01\';

```

h3. Ускорение SELECT count(*) 

В PostgreSQL, в отличии от других БД, медленный подсчет строк.

```sql
SELECT count(*)  FROM t;
```

Его можно ускорить, добавив какое-нибудь условие WHERE:

```sql
SELECT count(*) FROM t WHERE k>10 and k<20;
```

h3. FOREIGN KEYS

Добавление и изменение большого количества данных может оказаться медленным из-за использования внешних ключей (FOREIGN KEYS). Поэтому их можно  приглушить до окончания операции:

```sql
BEGIN;
SET CONSTRAINTS ALL DEFERRED;
[update or insert statements]
COMMIT;

```
','body_html' => '<p>Читая книгу <a href="http://www.goodreads.com/book/show/10033368-postgresql-9-0-high-performance">PostgreSQL 9.0 High Performance</a>, выписал некоторые интересные моменты, которые могут оказаться полезными простым разработчикам.</p>
<h3>Полезные команды.</h3>
<p><span class="caps">EXPLAIN</span> <span class="caps">ANALYZE</span> [sql] — анализ выполненного запроса (используемые ноды, время выполнения, использование индексов).</p>
<p><span class="caps">VACUUM</span> — дефрагментация базы. Можно запускать, если отключен autovacuum. Рекомендуется выполнять после большого удаления данных.</p>
<p><span class="caps">REINDEX</span> <span class="caps">INDEX</span> [index_name] — перестройка индекса.</p>
<p><span class="caps">REINDEX</span> <span class="caps">TABLE</span> [table_name] — перестройка индексов всей таблицы.</p>
<h3>Анализаторы логов</h3>
<p><a href="http://pgfouine.projects.postgresql.org/">pgFouine</a>, <a href="http://bucardo.org/wiki/Pgsi">pgsi</a>, <br />
<a href="http://www.maatkit.org/doc/mk-query-digest.html">mk-query-digest</a></p>
<p>pgFouine — наиболее удобный, хоть и требует веб-сервер для запуска.</p>
<h3>Рекомендации по использованию индексов</h3>
<p>Ставьте индексы на поля, по которым происходит поиск или сортировка.</p>
<p>Исключите использование ненужных индексов (найти их поможет <span class="caps">EXPLAIN</span> <span class="caps">ANALYZE</span>)</p>
<h3>Индексы</h3>
<p>B-Tree – индекс по-умолчанию. Подходит для всех типов.</p>
<p>Hash — эффективен при поиске по равенству: column_name = &#8216;value&#8217;.</p>
<p><span class="caps">GIN</span> — дает быстрый поиск, но долгое обновление при <span class="caps">INSERT</span>. Применим для полнотекстового поиска.</p>
<p>GiST — для полнотекстового поиска. Быстрый поиск, но долгое обновление индекса. Так же применим для полнотекстового поиска.</p>
<p>При поиске с использованием <span class="caps">LIKE</span> или <span class="caps">POSIX</span> задать специальный параметр: <br />

```sql
CREATE INDEX index_name ON table_name(column_name varchar_pattern_ops);
```</p>
<p>Для других типов: text_pattern_ops, bpchar_pattern_ops, name_pattern_ops.</p>
<h3>Составной индекс</h3>
<p>При поиске по по двум и более колонкам можно использовать составной индекс:<br />

```sql
CREATE INDEX index_name ON table_name(col_1, col_2);
```</p>
<h3>Частичный индекс</h3>
<p>В случае, если поиск совершается только по какому-то одному значению:<br />

```sql
CREATE INDEX index_name ON table name WHERE column_name IS value;
```</p>
<h3>Сортировка индексов</h3>
<p>При сортировке по индексу в одну сторону, например <span class="caps">DESC</span>, можно настроить и сам индекс:<br />

```sql
CREATE INDEX index_name ON  table_name(column_name DESC);
 ```</p>
<p>Если имеются значения <span class="caps">NULL</span>, можно подвинуть их в начало:<br />

```sql
CREATE INDEX index_name ON  table_name(column_name NULLS FIRST);
```</p>
<p>По умолчанию значения <span class="caps">NULL</span> хранятся в конце.</p>
<h3>Обработка значений в индексе</h3>
<p>Если в запросах используются функции:<br />

```sql
SELECT * FROM table_name WHERE lower(column_name) = \'x\';
```</p>
<p>Можно подготовить значения и в самом индексе:<br />

```sql
CREATE INDEX index_name ON table_name(lower(column_name)); 
```</p>
<h3><span class="caps">OFFSET</span> 0</h3>
<p>Использование «OFFSET 0» ускорит выполнение вложенных запросов:<br />

```sql
SELECT l.prod_id FROM orderlines l
WHERE EXISTS (SELECT * FROM customers JOIN orders USING (customerid) WHERE orders.orderid = l.orderid OFFSET 0)
AND l.orderdate=\'2004-12-01\';

```</p>
<h3>Ускорение <span class="caps">SELECT</span> count(*)</h3>
<p>В PostgreSQL, в отличии от других БД, медленный подсчет строк.</p>

```sql
SELECT count(*)  FROM t;
```
<p>Его можно ускорить, добавив какое-нибудь условие <span class="caps">WHERE</span>:<br />

```sql
SELECT count(*) FROM t WHERE k&gt;10 and k&lt;20;
```</p>
<h3><span class="caps">FOREIGN</span> <span class="caps">KEYS</span></h3>
<p>Добавление и изменение большого количества данных может оказаться медленным из-за использования внешних ключей (<span class="caps">FOREIGN</span> <span class="caps">KEYS</span>). Поэтому их можно  приглушить до окончания операции:<br />

```sql
BEGIN;
SET CONSTRAINTS ALL DEFERRED;
[update or insert statements]
COMMIT;

```</p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'postgresql','published_at' => '2012-04-08 17:39:17','created_at' => '2012-04-08 18:39:17','updated_at' => '2012-04-08 18:46:41','edited_at' => '2012-04-08 18:39:17'),
  array('id' => '36','title' => 'Связываем xdebug-backtrace с PhpStorm и rails-footnotes с RubyMine','slug' => 'connect-xdebug-backtrace-with-phpstorm-and-foornotes-with-rubymine','body' => 'h3. PhpStorm  и Xdebug

В backtrace\'е у XDebug предусмотрен простой переход к нужному файлу и на нужную строку. Только использует он протокол txmt (TextMate), что не пригодно с PhpStorm.

<img src="/system/backtrace/xdebug.png" />

Решение нашел тут: "http://youtrack.jetbrains.com/issue/IDEA-65879":http://youtrack.jetbrains.com/issue/IDEA-65879

Ставим плагин Remote Call: "http://plugins.jetbrains.net/plugin?pr=webide&pluginId=6027":http://plugins.jetbrains.net/plugin?pr=webide&pluginId=6027

И прописываем в конфиге xdebug:

```
xdebug.file_link_format = "javascript: var r = new XMLHttpRequest; r.open(\\"get\\", \\"http://localhost:8091?message=%f:%l\\");r.send()"

```


h3. RubyMine и Rails Footnotes

В Gemfile.rb:

```ruby
gem \'rails-footnotes\', \'>= 3.7.9\', :group => :development
```

$ rails generate rails_footnotes:install

Добавляем фильтр в config/initializers/rails_footnotes.rb:

```ruby
if defined?(Footnotes) && Rails.env.development?
  Footnotes.run! 

  Footnotes::Filter.prefix = "javascript: var r = new XMLHttpRequest; r.open(\'get\', \'http://localhost:8091?message=%s:%d:%d\');r.send()"
end

```

<img src="/system/backtrace/footnotes.png" />


Порт в Remote Call намертво прибит в коде, поэтому насладиться им при одновременном запуске RubyMine и PhpStorm не выйдет. 

h3. Ссылки

"https://github.com/digidigo/ruby_footprints":https://github.com/digidigo/ruby_footprints

"https://github.com/Zolotov/RemoteCall":https://github.com/Zolotov/RemoteCall

','body_html' => '<h3>PhpStorm  и Xdebug</h3>
<p>В backtrace&#8217;е у XDebug предусмотрен простой переход к нужному файлу и на нужную строку. Только использует он протокол txmt (TextMate), что не пригодно с PhpStorm.</p>
<p><img src="/system/backtrace/xdebug.png" /></p>
<p>Решение нашел тут: <a href="http://youtrack.jetbrains.com/issue/IDEA-65879">http://youtrack.jetbrains.com/issue/<span class="caps">IDEA</span>-65879</a></p>
<p>Ставим плагин Remote Call: <a href="http://plugins.jetbrains.net/plugin?pr=webide&amp;pluginId=6027">http://plugins.jetbrains.net/plugin?pr=webide&amp;pluginId=6027</a></p>
<p>И прописываем в конфиге xdebug:</p>

```ruby
xdebug.file_link_format = "javascript: var r = new XMLHttpRequest; r.open(\\"get\\", \\"http://localhost:8091?message=%f:%l\\");r.send()"
```

<h3>RubyMine и Rails Footnotes</h3>
<p>В Gemfile.rb:</p>

```ruby
gem \'rails-footnotes\', \'&gt;= 3.7.9\', :group =&gt; :development
```
<p>$ rails generate rails_footnotes:install</p>
<p>Добавляем фильтр в config/initializers/rails_footnotes.rb:</p>

```ruby
if defined?(Footnotes) &amp;&amp; Rails.env.development?
  Footnotes.run! 

  Footnotes::Filter.prefix = "javascript: var r = new XMLHttpRequest; r.open(\'get\', \'http://localhost:8091?message=%s:%d:%d\');r.send()"
end

```
<p><img src="/system/backtrace/footnotes.png" /></p>
<p>Порт в Remote Call намертво прибит в коде, поэтому насладиться им при одновременном запуске RubyMine и PhpStorm не выйдет.</p>
<h3>Ссылки</h3>
<p><a href="https://github.com/digidigo/ruby_footprints">https://github.com/digidigo/ruby_footprints</a></p>
<p><a href="https://github.com/Zolotov/RemoteCall">https://github.com/Zolotov/RemoteCall</a></p>','active' => '1','approved_comments_count' => '0','cached_tag_list' => 'продуктивность','published_at' => '2013-01-22 11:03:30','created_at' => '2013-01-22 11:03:30','updated_at' => '2013-02-06 05:30:09','edited_at' => '2013-01-22 11:03:30')
);

foreach ($posts as $post) {
    $time = strtotime($post['created_at']);

    $filename = 'dev/' . date('Y-m-d', $time) . '-' . $post['slug'];

    $header = '---
title: ' . $post['title'] . '
alias: ' . $post['slug'] . '
tags: ' . $post['cached_tag_list'] . '
date: ' . date('Y-m-d', $time). '
---

';

    echo $filename."\n";

    $content = $header . $post['body'];

    $content = str_replace('h3.', '###', $content);
    $content = str_replace('h2.', '##', $content);

    $content = preg_replace('/"([^"]+?)"\:(.*?)\s/si', "[$1]($2)\n", $content);

    if (preg_match_all('/src="(.*?)"/si', $content, $matches)) {
        foreach ($matches[1] as $origFile) {
            $file = $origFile;
            if (strstr($file, '.jpg') || strstr($file, '.png') || strstr($file, '.git')) {
                if (!strstr($file, 'http')) {
                    $file = 'http://artursabirov.ru' . $file;
                }
                $name = basename($file);

                if (!file_exists($filename . '/' . $name)) {
                    @mkdir($filename);
                    echo $filename . '/' . $name . " saved\n";
                    file_put_contents($filename . '/' . $name, file_get_contents($file, FILE_BINARY));
                }
                $content = str_replace($origFile, '/' . $filename . '/' . $name, $content);
            }
        }
    }

    $content = preg_replace('/<img.*?src="(.*?)".*?>/si', "![]($1)\n", $content);


    file_put_contents($filename . '.html.markdown', $content);
}
