require 'capistrano/setup'
require 'capistrano/deploy'
require 'capistrano/rvm'
require 'capistrano-nc/nc'

Dir.glob('lib/capistrano/tasks/*.cap').each { |r| import r }


Rake::Task[:production].invoke