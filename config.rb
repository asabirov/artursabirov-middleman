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
  blog.calendar_template = "calendar.html"
end


page "/feed.xml", layout: false

##
# Page options, layouts, aliases and proxies
##

with_layout :tag do
  page "/dev/tags/*"
end

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
    'http://artursabirov.ru'
  end

  def author
    'Артур Сабиров'
  end

  def twitter
    'artsabirov'
  end

  def disqus_url(article)
    if article.url =~ /201[1-2]/
      "#{root_url}/#{article.url.gsub('/dev', '').gsub('.html', '').gsub(/\/$/, '')}"
    else
      "#{root_url}#{article.url}"
    end
  end

  def feed_limit
    5
  end

  def current_title
    if current_article
      return current_article.title
    end

    if current_resource && current_resource.metadata && current_resource.metadata[:page]['title']
      return current_resource.metadata[:page]['title']
    end

    "ArturSabirov.ru"
  end

  def current_feed_path
    "#{blog.options.prefix.to_s}/feed.xml"
  rescue RuntimeError
    "http://feeds.feedburner.com/artursabirov"
  end
end

set :css_dir, 'stylesheets'

set :js_dir, 'javascripts'

set :images_dir, 'images'

###
# Extensions
###

set :markdown_engine, :redcarpet
set :markdown, :fenced_code_blocks => true, :smartypants => true

activate :autoprefixer
activate :directory_indexes
# activate :automatic_image_sizes
# activate :livereload

# compass_config do |config|
#   config.output_style = :compact
# end


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

