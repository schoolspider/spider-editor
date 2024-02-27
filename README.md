# a package that parses json from the spider drag and drop builder

[![Latest Version on Packagist](https://img.shields.io/packagist/v/schoolspider/spider-editor.svg?style=flat-square)](https://packagist.org/packages/schoolspider/spider-editor)
[![Tests](https://img.shields.io/github/actions/workflow/status/schoolspider/spider-editor/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/schoolspider/spider-editor/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/schoolspider/spider-editor.svg?style=flat-square)](https://packagist.org/packages/schoolspider/spider-editor)

This is where your description should go. Try and limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/spider-editor.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/spider-editor)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require schoolspider/spider-editor
```

## Usage

```php
$editor = new SchoolSpider\SpiderEditor\Editor();
$editor->setContent([
    [
        'type' => 'heading',
        'level' => 1,
        'content' => 'This is my heading',
    ],
    [
        'type' => 'content',
        'content' => '<p>This is my content</p>',
    ],
]);

$html = $editor->toHTML();
// <h1>This is my heading</h1><p>This is my content</p>
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Simon Morris](https://github.com/schoolspider)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
