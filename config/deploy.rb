lock '3.4.0'

set :application, 'ArturSabirov.ru'
set :repo_url, 'git@github.com:asabirov/artursabirov-build.git'
set :log_level, :debug
set :keep_releases, 3

set :rvm_type, :user
set :rvm_ruby_version, 'ruby-1.9.3'

task :middleman_build do
  system "middleman build"
end

task :update_build_repo do
  system "cd build && git add -A && git commit -m build_auto_update && git push origin master"
end


before 'deploy:starting', :middleman_build
before 'deploy:starting', :update_build_repo
