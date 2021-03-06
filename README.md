TravinizerBundle
================

Symfony 2 bundle - Travis CI &amp; Scrutinizer CI overview for your OS projects

[![Latest Stable Version](https://poser.pugx.org/snide/travinizer-bundle/v/stable.png)](https://packagist.org/packages/snide/travinizer-bundle)
[![Build Status](https://travis-ci.org/pdenis/SnideTravinizerBundle.png?branch=master)](https://travis-ci.org/pdenis/SnideTravinizerBundle)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/pdenis/SnideTravinizerBundle/badges/quality-score.png?s=6e2c048bdf5fe15a16fb9af8c36c71398c6772d0)](https://scrutinizer-ci.com/g/pdenis/SnideTravinizerBundle/)
[![Code Coverage](https://scrutinizer-ci.com/g/pdenis/SnideTravinizerBundle/badges/coverage.png?s=78e6ba4355429d14ae89ef388ac720322cba6230)](https://scrutinizer-ci.com/g/pdenis/SnideTravinizerBundle/)
[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/pdenis/travinizerbundle/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

## features
- Scrutinizer overview
- Travis overview
- Metrics
- Repositories dashboard

## Installation

### Installation by Composer

If you use composer, add SnideTravinizerBundle bundle as a dependency to the composer.json of your application

```php
    "require": {
        ...
        "snide/travinizer-bundle": "dev-master"
        ...
    },

```

Add SnideTravinizerBundle to your application kernel.

```php
// app/AppKernel.php
<?php
    // ...
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Snide\TravinizerBundle\SnideTravinizerBundle(),
        );
    }
```

The bundle needs to copy the resources necessary to the web folder. You can use the command below:

```bash
    php app/console assets:install
```

## Overview

### Dashboard
<img src="https://raw.github.com/pdenis/SnideTravinizerBundle/master/docs/screenshots/travinizer_dashboard.png" alt="Dashboard">

### Scrutinizer metrics
<img src="https://raw.github.com/pdenis/SnideTravinizerBundle/master/docs/screenshots/travinizer_metrics.png" alt="Scrutinizer metrics">

### Pdepend metrics
<img src="https://raw.github.com/pdenis/SnideTravinizerBundle/master/docs/screenshots/travinizer_pdepend_metrics.png" alt="Pdepend metrics">

### Travis builds
<img src="https://raw.github.com/pdenis/SnideTravinizerBundle/master/docs/screenshots/travinizer_builds.png" alt="Travis builds">

## Full configuration

```yaml
    snide_monitor:
        manager:
            class: Your\Specific\RepoManager
        repository:
            type: yaml # only Yaml type is defined
            repo:
                filename: /path/to/your/yaml/save/file.yml
                class: Your\Specific\Repo
        # optional
        filesystem_cache_path: %kernel_dir%/travinizer
```
