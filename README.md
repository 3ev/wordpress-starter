# 3ev WordPress Starter

Our base WordPress build, that borrows heavily from many of the ideas in the
excellent [Bedrock project](https://github.com/roots/bedrock).

## Getting started

To start a new site, use the Composer `create-project` command:

```sh
$ composer create-project 3ev/wordpress-starter -s dev
```

## Installing & running

To install WordPress, run:

```sh
$ bin/phing build
$ bin/phing wordpress:install
```

This will prompt you for the basic requirements needed to setup your site. Once
that's done, to start the site on Apache, run:

```sh
$ bin/phing build:server
```

(`sudo` is required for this command). After that you should be able to see
your site running in the browser at the domain you specified during the build
process.

## Building from an existing site

Once you've setup your WordPress site, you can easily create new builds for
development or production. First, dump out your database with:

```sh
$ bin/phing db:structure:dump
$ bin/phing db:data:dump
```

The data files will be dumped to `storage/database/`. Share these files with
your organisation (or use [Phingy's Amazon S3 support](https://github.com/3ev/phingy#database-tasks--s3))
so they can be accessed, then all developers have to do is:

```sh
$ git clone git@github.com:you/your-wordpress.git my-wordpress-site/
$ cd my-wordpress-site/
$ composer install
$ bin/phing build
$ cp path/to/shared/create.sql storage/database/create.sql
$ cp path/to/shared/data.sql storage/database/data.sql
$ bin/phing db:structure:load
$ bin/phing db:data:load
$ bin/phing build:server
```

to get a working copy of your site.

## Deploying with Capistrano

Capistrano comes setup and ready to go with this project (via [Bundler](http://bundler.io/)),
to make deployment as straightforward as possible.

After running `bundle install`, follow the guides to setting up a deployment
user and the initial directory on http://capistranorb.com/. Then, modify the
`:application` and `:repo_url` settings in `config/deploy.rb` and create a stage
file in `config/deploy/` (the `staging.rb` file is there as an example for you
to start with).

After that you can deploy your site with a single command:

```sh
$ bundle exec cap [stage] deploy
```

**Note:** You'll need to setup your database separately after your first
deployment.

### Deploying a different branch

By default, your `master` branch will be deployed, but you can deploy a feature
branch for testing by setting the `BRANCH` environment variable, like:

```sh
$ BRANCH=cool-new-feature bundle exec cap [stage] deploy
```
