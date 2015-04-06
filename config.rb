###
# Blog settings
###

Time.zone = "Europe/Moscow"

activate :blog do |blog|
  blog.name = "dev"
  blog.prefix = "dev"
  blog.permalink = "{year}/{month}/{day}/{alias}.html"
  blog.layout = "article"
  blog.tag_template = "tag.html"

  blog.paginate = true

  # blog.sources = "{year}-{month}-{day}-{title}.html"
  # blog.taglink = "tags/{tag}.html"
  # blog.layout = "layout"
  # blog.summary_separator = /(READMORE)/
  # blog.summary_length = 250
  # blog.year_link = "{year}.html"
  # blog.month_link = "{year}/{month}.html"
  # blog.day_link = "{year}/{month}/{day}.html"
  # blog.default_extension = ".markdown"
  #blog.calendar_template = "calendar.html"
end

activate :blog do |blog|
  blog.name = "books"
  blog.prefix = "books"
  blog.layout = "book_review"

  blog.permalink = "{alias}.html"

  blog.tag_template = "tag.html"
end

activate :blog do |blog|
  blog.name = "life"
  blog.prefix = "life"
  blog.layout = "article"

  blog.permalink = "{year}/{month}/{day}/{alias}.html"

  blog.tag_template = "tag.html"
  blog.calendar_template = "calendar.html"
end

activate :blog do |blog|
  blog.name = "world"
  blog.prefix = "world"
  blog.layout = "article"

  blog.permalink = "{alias}.html"

  blog.tag_template = "tag.html"
  #blog.calendar_template = "calendar.html"
end


page "/feed.xml", layout: false


##
# Page options, layouts, aliases and proxies
##

with_layout false do
  page "/*/feed.xml"
end


# Proxy pages (http://middlemanapp.com/dynamic-pages/)
# proxy "/this-page-has-no-template.html", "/template-file.html", locals: {
#  which_fake_page: "Rendering a fake page with a local variable" }

##
# Helpers
##

activate :syntax

helpers do
  def blog_title
    "Артур Сабиров"
  end

  def root_url
    if development?
      'http://localhost:4567'
    else
      'http://artursabirov.ru'
    end
  end

  def author
    'Артур Сабиров'
  end

  def twitter
    'artsabirov'
  end

  def old_article?(article)
    article.url =~ /201[1-2]/
  end

  def feed_limit
    5
  end

  def current_title
    blog_name = "Блог Артура Сабирова"
    if current_article
      return "#{current_article.title} — #{blog_name}"
    end

    if current_resource && current_resource.metadata && current_resource.metadata[:page]['title']
      return "#{current_resource.metadata[:page]['title']} — #{blog_name}"
    end

    blog_name
  end

  def current_feed_path
    "http://feeds.feedburner.com/artursabirov/#{blog.options.prefix.to_s}"
  rescue RuntimeError
    "http://feeds.feedburner.com/artursabirov"
  end

  def relative_paths_to_absolute(body)
    body.gsub(/<(img|a)(.*?)(href|src)="(.*?)"/, "<\\1\\2\\3=\"#{root_url}\\4\"")
  end

  def only_published(articles)
    articles.select{|a| a.metadata[:page]['published'].nil? || a.metadata[:page]['published']}
  end

  def articles_for(scope, limit = 5)
    blog_instances[scope].data.articles.sort_by{|a| a.date}.reverse.take(limit)
  end

  def book_covers_dir
    '/images/books'
  end

  def with_image(article)
    if article.metadata[:page]['image']
      "<p><img src=\"#{book_covers_dir}/#{article.metadata[:page]['image']}\" height=\"300\" /></p> #{article.body}"
    else
      article.body
    end
  end
end

set :css_dir, 'stylesheets'

set :js_dir, 'javascripts'

set :images_dir, 'images'

###
# Extensions
###

set :markdown_engine, :kramdown

activate :autoprefixer
activate :directory_indexes
activate :livereload

configure :build do
  activate :minify_css
  activate :minify_javascript

  # activate :asset_hash
  # activate :relative_assets
  # set :http_prefix, "/Content/images/"

  set :build_dir, "build"

  ignore "article.html.haml"
  ignore "page.html.haml"
  ignore "layout.html.haml"
  ignore "book_review.html.haml"

  #redirect "/essays/index.html", :to => "/journal/tags/essays"
end

