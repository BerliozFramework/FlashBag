# Berlioz FlashBag

[![Latest Version](https://img.shields.io/packagist/v/berlioz/flash-bag.svg?style=flat-square)](https://github.com/BerliozFramework/FlashBag/releases)
[![Software license](https://img.shields.io/github/license/BerliozFramework/FlashBag.svg?style=flat-square)](https://github.com/BerliozFramework/FlashBag/blob/develop/LICENSE)
[![Build Status](https://img.shields.io/github/workflow/status/BerliozFramework/FlashBag/Tests/main.svg?style=flat-square)](https://github.com/BerliozFramework/FlashBag/actions/workflows/tests.yml?query=branch%3Amain)
[![Quality Grade](https://img.shields.io/codacy/grade/9f0ac8ab057549ce95d0dda7d29fa909/main.svg?style=flat-square)](https://www.codacy.com/manual/BerliozFramework/FlashBag)
[![Total Downloads](https://img.shields.io/packagist/dt/berlioz/flash-bag.svg?style=flat-square)](https://packagist.org/packages/berlioz/flash-bag)

**Berlioz FlashBag** is a PHP library to manage flash messages to showed to the user.


## Installation

### Composer

You can install **Berlioz FlashBag** with [Composer](https://getcomposer.org/), it's the recommended installation.

```bash
$ composer require berlioz/flash-bag
```

### Dependencies

* **PHP** ^7.1 || ^8.0


## Usage

All messages are stored in session of user. So you be able to get the messages after a reload of page or redirect.
When you got the messages, they are deleted on the stack and no longer available.

### Add message

It's very simple to add messages:

```php
$flashBag = new FlashBag;
$flashBag
    ->add(FlashBag::TYPE_SUCCESS, 'Message success')
    ->add(FlashBag::TYPE_INFO, 'Second message')
    ->add(FlashBag::TYPE_INFO, 'Third message for %d %s', 3, 'persons');
```

Some default types are available in constants:

```php
FlashBag::TYPE_INFO = 'info';
FlashBag::TYPE_SUCCESS = 'success';
FlashBag::TYPE_WARNING = 'warning';
FlashBag::TYPE_ERROR = 'error';
```

### Get message

To get message, it's also simple then add:

```php
$flashBag = new FlashBag;
$successMessages = $flashBag->get('success');

foreach ($successMessages as $msg) {
    print $msg;
}
```

### Get all messages

You can also get all messages in one time:

```php
$flashBag = new FlashBag;
$allMessages = $flashBag->all();

foreach ($allMessages as $type => $messages) {
    foreach ($messages as $msg) {
        print sprintf('%s: %s', $type, $msg);
    }
}
```