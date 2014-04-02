role :web, %w{artursabirov.ru}

server 'artursabirov.ru', user: 'rails', roles: %w{web}

set :deploy_to, '/var/www/rails/data/artursabirov.ru'
set :branch, 'master'
