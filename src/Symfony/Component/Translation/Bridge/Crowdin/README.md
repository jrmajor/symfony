Crowdin Translation Provider
============================

Provides Crowdin integration for Symfony Translation.

DSN example
-----------

```
// .env file
CROWDIN_DSN=crowdin://PROJECT_ID:API_TOKEN@default?domain=ORGANIZATION_DOMAIN
```

where:
 - `PROJECT_ID` is your Crowdin Project ID
 - `API_KEY` is your Personal Access API Token
 - `ORGANIZATION_DOMAIN` is your Crowdin Enterprise Organization domain (required only for Crowdin Enterprise usage)

[Generate Personal Access Token on Crowdin](https://support.crowdin.com/account-settings/#api)

[Generate Personal Access Token on Crowdin Enterprise](https://support.crowdin.com/enterprise/personal-access-tokens/)

Resources
---------

 * [Contributing](https://symfony.com/doc/current/contributing/index.html)
 * [Report issues](https://github.com/symfony/symfony/issues) and
   [send Pull Requests](https://github.com/symfony/symfony/pulls)
    n the [main Symfony repository](https://github.com/symfony/symfony)
