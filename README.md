# Samurai

[![Latest Stable Version](https://poser.pugx.org/raphhh/samurai/v/stable.svg)](https://packagist.org/packages/raphhh/samurai)
[![Build Status](https://travis-ci.org/Raphhh/samurai.png)](https://travis-ci.org/Raphhh/samurai)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/Raphhh/samurai/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Raphhh/samurai/)
[![Code Coverage](https://scrutinizer-ci.com/g/Raphhh/samurai/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Raphhh/samurai/)
[![Total Downloads](https://poser.pugx.org/raphhh/samurai/downloads.svg)](https://packagist.org/packages/raphhh/samurai)
[![License](https://poser.pugx.org/raphhh/samurai/license.svg)](https://packagist.org/packages/raphhh/samurai)

Samurai is a PHP scaffolding tool. 
It helps you to **start a new project in PHP**, generating all the base files in a simple command line.

Samurai generates all the files you need for a library, a web application, a frameworked project, and so on. 
You can even **load your own bootstrap**.

Samurai will run several modules. 
You can **choose which module** to install according to your own needs. 
You can also create your won module.

![Samurai during project installation](https://raw.githubusercontent.com/Raphhh/samurai/master/doc/samurai-new.png)


## What does Samurai scaffold?

Samurai installs and params your project:

 1. Download the bootstrap and its dependency with Composer
 2. Param the Composer config (composer.json)
 3. Dump the autoloader of Composer with your new Package name
 4. Execute the installed modules.
 
Examples of bootstrap:
 - A simple PHP librairy
 - Symfony
 - Laravel
 - Zend
 - CakePHP
 - CodeIgniter
 - Yii
 - Drupal
 - Joomla
 - WordPress
 - Silex
 - Slim
 - .. what you want!
 

Examples of modules:
 - Init git for the project. See [raphhh/samurai-module-git](https://github.com/Raphhh/samurai-module-git).
 - Create a new repo on GitHub and link it to your project (github module) (todo)
 - Clean some files (changelog, ...). See [raphhh/samurai-module-cleaner](https://github.com/Raphhh/samurai-module-cleaner).
 - Init PHPUnit (todo)
 - Init Behat (todo)
 - Link your project to Travis-ci (todo)
 - ... what you want!


## Installation of Samurai

Samurai uses Composer and Git. So, you have to install them first.

### Install Composer

#### Set the executable

See the Composer documentation for [installation process](https://getcomposer.org/doc/00-intro.md).

For Unix system be sure that you have installed [Composer globally](https://getcomposer.org/doc/00-intro.md#globally):

```console
# mv composer.phar /usr/local/bin/composer
```

So, you can execute directly the composer command:
```console
$ composer --version
```

#### Set the PATH

Second, **make sure to place the [COMPOSER_BIN_DIR](https://getcomposer.org/doc/03-cli.md#composer-bin-dir) directory in your PATH**.

##### Unix system

By default, the COMPOSER_BIN_DIR is the directory `~/.composer/vendor/bin`.

For all users (restart):

```console
# echo "export PATH=$PATH:~/.composer/vendor/bin" >> /etc/profile
```

For current user (relogin):

```console
$ echo "export PATH=$PATH:~/.composer/vendor/bin" >> ~/.profile
```

##### Windows

By default, the COMPOSER_BIN_DIR is the directory `C:\Users\<user>\AppData\Roaming\Composer\vendor\bin`. 

```console
setx PATH "%PATH%;C:\%HOMEPATH%\AppData\Roaming\Composer\vendor\bin"
```

### Install Git

For a better experience, you should also install [Git](http://git-scm.com/).

Do not forget to add a [global .gitignore](https://help.github.com/articles/ignoring-files/#explicit-repository-excludes), to exclude files or folders of your [IDE or OS](https://github.com/github/gitignore/tree/master/Global).


### Install Samurai

First, download Samurai with [Composer](https://getcomposer.org) **in the global env**.

```console
$ composer global require raphhh/samurai
```

Note that, by default, no module is installed. To install the recommended modules, execute the following command:
```console
$ samurai module install
```
See module doc for modre information.

### Test Samurai

So, the samurai executable is found when you run the command in your terminal.

```console
$ samurai help --version
```

## List commands and help

To list all the available commands, enter the 'list' command:

```console
$ samurai list
```

To get help on a specific command, use the 'help' command:

```console
$ samurai help <command>
```


## Scaffold your project

The samurai `new` command will create a **fresh installation of a new project**. 

### Choose between projects

If you do not specify a bootstrap to install, Samurai will list all the project's bootstraps.

```console
$ samurai new
```
You just have to select a bootstrap to install.

### Specify a pre-defined project

If you know the project, you can directly specify it in the command. Samurai will create your project from this bootstrap. 

```console
$ samurai new <alias>
```

In fact, you specify an alias of a project. An alias is just a defined bootstrap and version. See alias section for more information.

For example, with alias 'lib', Samurai will install a basic PHP library bootstrap.

```console
$ samurai new lib
```

### Specify another bootstrap and its version

You can specify any project loadable with Composer, event if you do not have alias. 

```console
$ samurai new <vendor/package> [<version>]
```

For example, you can create a new Puppy app by specifying its package.

```console
$ samurai new raphhh/puppy
```

Or if you want a specific version of a package, add the version you want just after the bootstrap. If you do not specify a version, Samurai will take the last stable version of the bootstrap.

```console
$ samurai new raphhh/puppy 1.1.0
```

If you install a project from a non-aliased bootstrap, do not hesitate to add it in the alias list. It is very simple. See alias section for more information.

```console
$ samurai alias save puppy raphhh/puppy
$ samurai new puppy
```

### Specify a project dir

By default, Samurai will put your project into the same directory as your project name.

For example, if you run Samurai from `~/projects` and you name your project `my/lib`, it will put your project in `~/projects/my/lib`.

But you can specify another directory with the option `--dir` or `-d`. This must be a relative path from cwd.

```console
$ samurai new lib -d specific/path/to/my/project
```

## Alias

Alias are simple words linked to a specific bootstrap at a specific version. 
For example, the alias 'lib' points to the package 'raphhh/php-lib-bootstrap' at last stable version.
**You can add any module you want, event yours.**

The main command to manage the modules is `alias`. Just after this command you can specify some actions.

### List the existing alias

To list all the alias, execute the action `list`.
```console
$ samurai alias list
```
To list a specific alias, execute the same action but with the name of the alias:
```console
$ samurai module list <alias_name>
```

### Add or redefine an alias

You can easily add any bootstrap you want, event yours! To add or redefine an alias, execute the action `save`.
```console
$ samurai alias save <alias_name> <bootstrap> [<version>] [<description>] [<source>]
```

### Remove an alias

To remove an alias, execute the the action `rm`.
```console
$ samurai alias rm <alias_name>
```


## Modules

A module is a plugin added to Samurai. This plugin will execute some specific commands. For example, git module will init Git in your project.

**You can easily develop your own module and add it to Samurai.** See the [module creation doc](https://github.com/Raphhh/samurai/wiki/Module-creation).

The main command to manage the modules is `module`. Just after this command you can specify some actions.

### Execute the modules

#### During the scaffoling

By default, all the enable modules you have installed will be called during the `new` command.

```console
$ samurai new
```

If you want to avoid to execute the modules during this command, you can specify the option `--no-module`.
```console
$ samurai new --no-module
```

#### Separately

Separately of the `new` command, you can (re)execute all the enable modules with the action `run` of the command `module`.

```console
$ samurai module run
```

You can also specify a module to execute only this one.

```console
$ samurai module run <module_name>
```

### List the installed modules

To list all the modules, execute the action `list`.

```console
$ samurai module list
```

To list a specific module, execute the same action but with the name of the module.

```console
$ samurai module list <module_name>
```

### Add or redefine a module

#### Install recommended modules

You can install all the recommended packages with the `install` action.

```console
$ samurai module install
```

Note that you can only install pre-selected modules.

#### Install a specific module

To install any module you want, you must specify its package.
 
```console
$ samurai module install <module_name> <vendor/package> [<version>] [<description>] [<source>]
```

Tne `module_name` is just a shortcut you will use in the module actions. Choose any name you want.

For example, if you want to load the git module:

```console
$ samurai module install git raphhh/samurai-module-git
```

Note that if the module was already present, it will be overridden after confirmation.


### Enable/disable a module

If you disable a module, it will be not called during the `new` command, neither with the `module run` command.

```console
$ samurai module disable <module_name>
```

If you want to enable a module, execute the action `enable`.

```console
$ samurai module enable <module_name>
```

### Update a module

Updating means that your module will be update to a more recent build version, according to its version constraints. 
Note that the update command will respect the version restriction as specified by Composer. 
See the [Composer update documentation](https://getcomposer.org/doc/03-cli.md#update) for more information.
                                                                                                                      

To update all the modules, just execute the action `update`. 

```console
$ samurai module update
```

If you want to update a specific module to a more recent version, execute the action with the module name.

```console
$ samurai module update <module_name>
```


### Remove a module

If you want to remove a module, execute the action `rm` with the name of the module.

```console
$ samurai module rm <module_name>
```
