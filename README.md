# Docblock Generator
[![Scrutinizer](https://img.shields.io/scrutinizer/g/axyr/silverstripe-ideannotator.svg)](https://scrutinizer-ci.com/g/CasaLaguna/silverstripe-docgenerator/badges/quality-score.png?b=master)
![CodeClimate](https://codeclimate.com/github/Firesphere/silverstripe-docgenerator/badges/gpa.svg)
![Travis](https://travis-ci.org/Firesphere/silverstripe-docgenerator.svg)

This tiny wrapper on APIGen will generate documentation from your PHP Docblocks annotations. There's really nothing more to it.

# Usage

Add the wished module, and it's target directory in your config.yml like this:
```YML
DocGenerator:
  enabled: false
  document_modules:
    modulename: "Target/Directory/Relative/to/DocRoot"
```

Adviced is to only enable it in dev, like this:
```YML
Only:
  environment: 'dev'
---
DocGenerator:
  enabled: true
  document_modules:
    docgenerator: "docgenerator/docs/en/apidocs"
```
Documentation build by APIGen will be build in the target directory specific for each module.

Also, you can generate single API docs for multiple directories/modules at once:
```YML
---
Only:
  environment: 'dev'
---
DocGenerator:
  enabled: true # doc generator control switch
  multi_module_enabled: true # multi module doc generator control switch
  multi_module_destination: "apidocs" # documentation generator target directory
  multi_modules:
    - mysite
    - framework
    - mymodule
    - myothermodule
    - ...
```
Documentation build by APIGen `multi_module_enabled: true` will be stored in single directory.

## Did you read this entire readme? You rock!

Pictured below is a cow, just for you.
```

               /( ,,,,, )\
              _\,;;;;;;;,/_
           .-"; ;;;;;;;;; ;"-.
           '.__/`_ / \ _`\__.'
              | (')| |(') |
              | .--' '--. |
              |/ o     o \|
              |           |
             / \ _..=.._ / \
            /:. '._____.'   \
           ;::'    / \      .;
           |     _|_ _|_   ::|
         .-|     '==o=='    '|-.
        /  |  . /       \    |  \
        |  | ::|         |   | .|
        |  (  ')         (.  )::|
        |: |   |;  U U  ;|:: | `|
        |' |   | \ U U / |'  |  |
        ##V|   |_/`"""`\_|   |V##
           ##V##         ##V##
```
