lock '3.1.0'

set :application, 'ArturSabirov.ru'
set :repo_url, 'git@github.com:asabirov/artursabirov-build.git'
set :log_level, :debug
set :keep_releases, 3

set :rvm_type, :user
set :rvm_ruby_version, 'ruby-1.9.3-p484'

task :build do
  system "middleman build"
end

task :git do
  system "git commit -a -m 'public updated'"
  system "git push origin master"
end


before 'deploy:starting', :build
before 'deploy:starting', :git
