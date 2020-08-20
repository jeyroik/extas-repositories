![tests](https://github.com/jeyroik/extas-repositories/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-repositories/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a>
<a href="https://codeclimate.com/github/jeyroik/extas-repositories/maintainability"><img src="https://api.codeclimate.com/v1/badges/e6ca91a1616f3c4449dd/maintainability" /></a>
<a href="https://github.com/jeyroik/extas-installer/" title="Extas Installer v3"><img alt="Extas Installer v3" src="https://img.shields.io/badge/installer-v3-green"></a>
[![Latest Stable Version](https://poser.pugx.org/jeyroik/extas-repositories/v)](//packagist.org/packages/jeyroik/extas-q-crawlers)
[![Total Downloads](https://poser.pugx.org/jeyroik/extas-repositories/downloads)](//packagist.org/packages/jeyroik/extas-q-crawlers)
[![Dependents](https://poser.pugx.org/jeyroik/extas-repositories/dependents)](//packagist.org/packages/jeyroik/extas-q-crawlers)

# Description

Repositories for extas.

# Install

`# vendor/bin/extas init`

`# vendor/bin/extas install`

# Using

extas.json

```json
{
  "repositories": [
    {
      "name": "<repository.name>",
      "scope": "<repository.scope>",
      "pk": "<repository.primary_key>",
      "class": "<repository.item.class>",
      "aliases": ["<repository.alias>"]
    }
  ]
}
```

For example:

```json
{
  "repositories": [
    {
      "name": "plugins",
      "scope": "extas",
      "pk": "class",
      "class": "extas\\components\\plugins\\Plugin",
      "aliases": ["plugins", "pluginRepository"]
    }
  ]
}
```

Then somewhere in a code:

```php
use extas\components\Item;
class My extends Item
{
    // ...
}

$my = new My();
$my->plugins()->all([]); 
``` 