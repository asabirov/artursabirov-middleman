###
# Blog settings
###

Time.zone = "Europe/Moscow"

activate :blog do |blog|
  blog.name = "dev"
  blog.prefix = "dev"
  blog.permalink = "{year}/{month}/{day}/{alias}.html"
  blog.layout = "article"
  # Matcher for blog source files
  # blog.sources = "{year}-{month}-{day}-{title}.html"
  #blog.taglink = "tags/{tag}.html"
  # blog.layout = "layout"
  # blog.summary_separator = /(READMORE)/
  # blog.summary_length = 250
  # blog.year_link = "{year}.html"
  # blog.month_link = "{year}/{month}.html"
  # blog.day_link = "{year}/{month}/{day}.html"
  # blog.default_extension = ".markdown"

  blog.tag_template = "tag.html"
  #blog.calendar_template = "calendar.html"

  # Enable pagination
  blog.paginate = true
  #blog.per_page = 5
  #blog.page_link = "/dev/page/{num}"
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


###
# Compass
###

# Change Compass configuration
# compass_config do |config|
#   config.output_style = :compact
# end

###
# Page options, layouts, aliases and proxies
###

# Per-page layout changes:
#
# With no layout
# page "/path/to/file.html", layout: false
#
# With alternative layout
# page "/path/to/file.html", layout: :otherlayout
#
# A path which all have the same layout

#with_layout :article do
#   page "/dev/*"
#end

with_layout :tag do
  page "/dev/tags/*"
end

with_layout false do
  page "/*/feed.xml"
end


# Proxy pages (http://middlemanapp.com/dynamic-pages/)
# proxy "/this-page-has-no-template.html", "/template-file.html", locals: {
#  which_fake_page: "Rendering a fake page with a local variable" }

###
# Helpers
###

activate :syntax

set :markdown_engine, :redcarpet
set :markdown, :fenced_code_blocks => true, :smartypants => true

activate :autoprefixer

# Automatic image dimensions on image_tag helper
# activate :automatic_image_sizes

# Reload the browser automatically whenever files change
# activate :livereload

# Methods defined in the helpers block are available in templates
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

activate :directory_indexes

# Build-specific configuration
configure :build do
  # For example, change the Compass output style for deployment
  activate :minify_css

  # Minify Javascript on build
  activate :minify_javascript

  # Enable cache buster
  # activate :asset_hash

  # Use relative URLs
  # activate :relative_assets

  # Or use a different image path
  # set :http_prefix, "/Content/images/"

  set :build_dir, "public"

  ignore "article.html.haml"
  ignore "page.html.haml"
  ignore "layout.html.haml"
  ignore "book_review.html.haml"
end

