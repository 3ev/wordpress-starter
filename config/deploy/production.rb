#
# Example staging server deployment config
#

# Set this to your deployment user and IP address

role :app, %w{deploy@my.ip}

# Set this to the top level directory of your deployment on the remote server

set :deploy_to, '/path/to/my-wordpress-site'

# Set this to the remote domain you'd like to use for your site

set :build_url, 'www.my-wordpress-site.com'

# Set your database details here

set :db_host, 'localhost'
set :db_user, ''
set :db_pass, ''
set :db_name, ''
set :db_root_user, 'root'
set :db_root_pass, ''

# Turn off debug mode

set :app_debug, false
