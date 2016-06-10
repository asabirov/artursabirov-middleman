###
# Blog settings
###

Time.zone = "Europe/Moscow"


# Proxy pages (http://middlemanapp.com/dynamic-pages/)
# proxy "/this-page-has-no-template.html", "/template-file.html", locals: {
#  which_fake_page: "Rendering a fake page with a local variable" }

##
# Helpers
##

helpers do

end

set :css_dir, 'stylesheets'
set :images_dir, 'images'

###
# Extensions
###

set :markdown_engine, :kramdown

activate :autoprefixer
activate :directory_indexes
activate :livereload

configure :build do

  set :build_dir, "build"

  ignore "layout.html.haml"
end

