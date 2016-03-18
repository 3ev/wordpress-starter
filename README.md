#3ev WordPress Starter

> A modern Wordpress environment

This is the base WordPress environment that we use at 3ev. It borrows heavily from many of the ideas in the excellent
[Bedrock project](https://github.com/roots/bedrock).

##What's included?

####Tools and Setup

* Dependency management with [Composer](https://getcomposer.org/)
* Configuration management with [Phpdotenv](https://github.com/vlucas/phpdotenv)
* A modern folder structure
* [WP CLI](http://wp-cli.org/) command line tools
* Modern plugin and theme development with [Wordpress Core](https://github.com/3ev/wordpress-core)
* A frontend workflow using [Gulp](http://gulpjs.com/), [Sass](http://sass-lang.com/libsass) and [Browserify](http://browserify.org/)
* [Phingy](https://github.com/3ev/phingy) for build scripts and database management

####Wordpress Plugins

* [Comet Cache](https://en-gb.wordpress.org/plugins/comet-cache/)
* [Yoast SEO](https://en-gb.wordpress.org/plugins/wordpress-seo/)

##Requirements

* PHP `>=5.5.9`
* Composer
* Node.js
* Ruby/Rubygems/Bundler if you want to use Capistrano deployments

##Installation

```
$ composer create-project 3ev/wordpress-starter -s dev
$ cd wordpress-starter/
$ bin/init
```

This will install dependencies, prompt you for any configuration, compile assets, install Wordpress and start your site
running on Apache.

##Building from an existing site

Once you've setup your WordPress site, you can easily create new builds for development or production. First, dump out
your database with:

```
$ bin/phing db:structure:dump
$ bin/phing db:data:dump
```

and [push to S3](https://github.com/3ev/phingy#database-tasks--s3) to distribute the files, then all developers have to
do is:

```
$ git clone git@github.com:you/your-wordpress.git my-wordpress-site/
$ cd my-wordpress-site/
$ bin/build
```

to get a working copy of your site.

##Frontend Workflow

Wordpress Starter comes with a single theme, "3ev Starter Wordpress Theme" (`public/app/themes/starter/`), which is ready
to use.

This theme includes the following:

* Bootstrap `v4-alpha-2` (via NPM)
* jQuery `v2.2.2` (via CDN)
* Modernzir `v3` with touch detection and `mq` API (included in this repo)

Where possible, you should always try to use NPM to install frontend packages. They're bundled with Browserify, and you
can use [Browserify Shim](https://github.com/thlorenz/browserify-shim) (configure at `public/app/themes/starter/assets/js/shim.js`) to bundle any incompatible libraries.

Wordpress Starter includes some Gulp tasks to make it easy to compile your assets. These are run automatically when
building locally or deploying with Capistrano.

```
# Compile JS from `public/app/themes/starter/assets/js/main.js`

$ node_modules/.bin/gulp build:js

# Compile Sass from `public/app/themes/starter/assets/css/main.sass`

$ node_modules/.bin/gulp build:css
```

You can also compile all assets or watch for changes during development - just use `gulp -T` to see all available tasks.

##Deploying with Capistrano

Capistrano comes setup and ready to go with this project to make deployment as straightforward as possible. Just run:

```
$ bundle install
```

first.

Next, follow the guides to setting up a deployment user and the initial directory on http://capistranorb.com/. Then,
modify the `:application` and `:repo_url` settings in `config/deploy.rb` and create a stage file in `config/deploy/` (the
`production.rb` file is there as an example for you to start with).

After that you can deploy your site with a single command:

```
$ bundle exec cap [stage] deploy
```

**Note:** You'll need to setup your database separately after your first deployment.

###Deploying a different branch

By default, your `master` branch will be deployed, but you can deploy a different branch for testing by setting the
`BRANCH` environment variable, like:

```sh
$ BRANCH=cool-new-feature bundle exec cap [stage] deploy
```

##License

MIT &copy; 3ev
