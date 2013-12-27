TravinizerBundle
================

Symfony 2 bundle - Travis CI &amp; Scrutinizer CI overview for your OS projects

[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/pdenis/TravinizerBundle/badges/quality-score.png?s=6e2c048bdf5fe15a16fb9af8c36c71398c6772d0)](https://scrutinizer-ci.com/g/pdenis/TravinizerBundle/)
[![Code Coverage](https://scrutinizer-ci.com/g/pdenis/TravinizerBundle/badges/coverage.png?s=78e6ba4355429d14ae89ef388ac720322cba6230)](https://scrutinizer-ci.com/g/pdenis/TravinizerBundle/)

## features
- Scrutinizer overview
- Travis overview
- Metrics
- Repositories dashboard

## Installation

### Installation by Composer

If you use composer, add MonitorBundle bundle as a dependency to the composer.json of your application

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
<img src="https://raw.github.com/pdenis/TravinizerBundle/master/docs/screenshots/travinizer_dashboard.png" alt="Dashboard">

### Scrutinizer metrics
<img src="https://raw.github.com/pdenis/TravinizerBundle/master/docs/screenshots/travinizer_metrics.png" alt="Scrutinizer metrics">

### Pdepend metrics
<img src="https://raw.github.com/pdenis/TravinizerBundle/master/docs/screenshots/travinizer_pdepend_metrics.png" alt="Pdepend metrics">

### Travis builds
<img src="https://raw.github.com/pdenis/TravinizerBundle/master/docs/screenshots/travinizer_builds.png" alt="Travis builds">

## Full configuration

```yaml
    snide_monitor:
        repository:
            type: yaml # only Yaml type is defined
            repo:
                filename: /path/to/your/yaml/save/file.yml
```