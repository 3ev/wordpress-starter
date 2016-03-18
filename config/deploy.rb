# Config valid only for Capistrano 3.1

lock '3.1.0'

# Basic Cap config

set :application, 'my-wordpress-site' # Set this to an identifier for your site
set :repo_url, 'git@github.com:you/my-wordpress-site.git' # Point this at your Git repo
set :branch, ENV['BRANCH'] || 'master'
set :scm, :git
set :format, :pretty
set :log_level, :info
set :keep_releases, 3

# Files to symlink

set :linked_files, []

# Directories to symlink

set :linked_dirs, [
  'storage/logs',
  'storage/database',
  'public/app/uploads',
  'public/app/cache'
]

# Setup command maps

SSHKit.config.command_map[:phing] = 'bin/phing'
SSHKit.config.command_map[:wp] = 'bin/wp'
SSHKit.config.command_map[:web_wp] = 'sudo -u www-data bin/wp'
SSHKit.config.command_map[:gulp] = 'node_modules/.bin/gulp'

# Setup deployment hooks

namespace :deploy do

  # After creating a new release, install all dependencies, configure and
  # build

  before :build, :install_deps
  before :build, :generate_properties
  after :updated, :build

  # After publishing a new release or rolling back, symlink the Apache config
  # and reload

  after :publishing, :start_server

  # After publishing a new release or rolling back, clear the Wordpress cache

  after :publishing, :clear_cache

end
