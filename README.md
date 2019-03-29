# Laravel Permissions Sync

Ability to Sync permissions effortlessly, across environments.

## Getting Started

### Installation
Install via composer
```
$ composer require 'mwi/laravel-permissions-sync'
```

### Usage
In terminal run
```
$ php artisan spatie:permissions:sync
```

Flags
| Flag        | Description           | Default  |
| ------------- |:-------------:| -----:|
| --clean      | deletes unused roles and permissions | false |
| --verbosity      | logs to console, defaults to 1 if on local environment      |   0 |


## Contributing

Please read [CONTRIBUTING.md](https://github.com/CarterBland/labile/blob/master/CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/CarterBland/labile/tags). 

## Authors

* **[Carter Bland](https://carterbland.com)** - *Lead Developer* -

See also the list of [contributors](https://github.com/CarterBland/labile/graphs/contributors) who participated in this project.

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT) - see the website for details
