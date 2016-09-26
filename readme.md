# Spad

Spad is a [Kirby](http://getkirby.com) plugin to expose your site data as json for consumption in a single page app or something.

## Usage

Echos site data as json:
```php
<?= $site->spad() ?>
```

Typically you'd use this to inline into a variable for use in your app:
```php
<script>var data = <?= $site->spad() ?></script>
```

## Route

For handiness, Spad also adds a route which returns the site as json:

```bash
http://yourkirbysite.com/spad
```

## Options

Options are provided to customize the method and route names:
```php
<?php

c::set('spad.method', 'spad');
c::set('spad.route', 'spad');
```

## Todo

The json response is pretty simple at the moment. Not sure if I'll make it more robust, but if I do...

- [ ] Add page method
- [ ] Make recursive optional
- [ ] Options in general?
