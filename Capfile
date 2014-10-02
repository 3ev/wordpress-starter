# Load DSL and Setup Up Stages

require 'capistrano/setup'

# Includes default deployment tasks

require 'capistrano/deploy'

# Load custom tasks from 'capistrano/tasks'

Dir.glob('lib/capistrano/tasks/*.cap').each { |r| import r }
