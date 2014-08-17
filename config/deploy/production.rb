role :web, %w{artursabirov.ru:422}

server 'artursabirov.ru:422', user: 'delingcity', roles: %w{web}

set :deploy_to, '/var/www/delingcity/data/www/artursabirov.ru'
set :branch, 'master'
