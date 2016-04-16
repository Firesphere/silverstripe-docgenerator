# Docblock Generator
[![Scrutinizer](https://img.shields.io/scrutinizer/g/axyr/silverstripe-ideannotator.svg)](https://scrutinizer-ci.com/g/CasaLaguna/silverstripe-docgenerator/badges/quality-score.png?b=master)
![Travis](https://travis-ci.org/Firesphere/silverstripe-docgenerator.svg)

This tiny wrapper on APIGen, wil generate documentation from your PHP Docblocks. There's really nothing more to it.

# Usage

Add the wished module, and it's target directory in your config.yml like this:
```YML
DocGenerator:
  enabled: false
  documentation_modules:
    modulename: "Target/Directory/Relative/to/DocRoot"
```
Adviced is to only enable it in dev, like this:
```YML
Only:
  environment: 'dev'
---
DocGenerator:
  enabled: true
  documentation_modules:
    docgenerator: "docgenerator/docs/en/apidocs"
```
Documentation build by APIGen will be build in the target directory.
