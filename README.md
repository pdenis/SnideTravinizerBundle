TravinizerBundle
================

Symfony 2 bundle - Travis CI &amp; Scrutinizer CI overview for your OS projects

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