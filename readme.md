# Spad

Spad is a [Kirby](http://getkirby.com) plugin to expose your site data as json for use in a single page app.

## Usage

Echos site data as json:
```php
<?= $site->spad() ?>
```

Typically you'd use this to inline into a variable for use in your app:
```php
<script>var data = <?= $site->spad() ?></script>
```

## Response

Spad recursively includes visible page data and files. [**Click here**](#starterkit-response) to view the default response from the Kirby starterkit.

## Filters

Two filters are provided to filter the json response:

```php
c::set('spad.filterAll', function ($data) {
  return $data;
});

c::set('spad.filterEach', function ($page) {
  return $page;
});
```

These are useful if you need to perform some transformations on the data or to remove unecessary fields. `filterAll` is run at the very end for filtering the entire tree, whereas `filterEach` is run on each page. Here is an example that removes some of the fields from each page:

```php
c::set('spad.filterEach', function ($page) {
  $dontNeed = [
    'parent',
    'dirname',
    'diruri',
    'contentUrl',
    'tinyUrl',
    'depth',
    'root',
    'uid',
    'num',
    'hash',
    'modified'
  ];

  foreach ($dontNeed as $field) {
    unset($page[$field]);
  }

  return $page;
});
```

You can use page templates to *conditionally* filter pages:

```php
c::set('spad.filterEach', function ($page) {
  if ($page['intendedTemplate'] == 'project') {
    // only do a transformation on pages with `project` template
  }
  return $page;
});
```

**Note:** Careful not remove the `child` field when using `filterEach`, otherwise you will break recursion!


## Route

For handiness, Spad also adds a route which returns the site as json:

```bash
http://yourkirbysite.com/spad
```

## Options

Options are provided to customize the method and route names, and to filter the data:
```php
<?php

c::set('spad.method', 'spad');
c::set('spad.route', 'spad');
c::set('spad.filterAll', function ($data) { return $data; });
c::set('spad.filterEach', function ($page) { return $page; });
```

## Todo

- [ ] Page method
- [ ] Optional Recursion

## starterkit Response

Default Spad response for the Kirby starterkit:

```json
{
  "files":[

  ],
  "children":[
    {
      "id":"about",
      "title":"About",
      "parent":"",
      "dirname":"1-about",
      "diruri":"1-about",
      "url":"http://localhost:8080/about",
      "contentUrl":"http://localhost:8080/content/1-about",
      "tinyUrl":"http://localhost:8080/x/1ehhfqb",
      "depth":1,
      "uri":"about",
      "root":"/Users/jongacnik/Sites/kirby/content/1-about",
      "uid":"about",
      "slug":"about",
      "num":"1",
      "hash":"1ehhfqb",
      "modified":1475951682,
      "template":"default",
      "intendedTemplate":"about",
      "content":{
        "title":"About",
        "text":"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.\r\n\r\n## Lorem Ipsum\r\nIn enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a.\r\n\r\n(image: about.jpg)\r\n\r\n### Lorem Ipsum\r\nIn enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.\r\n\r\n#### Lorem Ipsum\r\nIn enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus."
      },
      "files":[
        {
          "root":"/Users/jongacnik/Sites/kirby/content/1-about/about.jpg",
          "url":"http://localhost:8080/content/1-about/about.jpg",
          "hash":"616ed5d915ad7b02d055c981983983b9",
          "dir":"/Users/jongacnik/Sites/kirby/content/1-about",
          "filename":"about.jpg",
          "name":"about",
          "safeName":"about.jpg",
          "extension":"jpg",
          "size":232182,
          "niceSize":"226.74 kB",
          "modified":1475951682,
          "mime":"image/jpeg",
          "type":"image",
          "dimensions":{
            "width":1280,
            "height":853,
            "ratio":1.5005861664713,
            "orientation":"landscape"
          },
          "meta":[

          ]
        }
      ],
      "children":[

      ]
    },
    {
      "id":"projects",
      "title":"Projects",
      "parent":"",
      "dirname":"2-projects",
      "diruri":"2-projects",
      "url":"http://localhost:8080/projects",
      "contentUrl":"http://localhost:8080/content/2-projects",
      "tinyUrl":"http://localhost:8080/x/poq46c",
      "depth":1,
      "uri":"projects",
      "root":"/Users/jongacnik/Sites/kirby/content/2-projects",
      "uid":"projects",
      "slug":"projects",
      "num":"2",
      "hash":"poq46c",
      "modified":1475951682,
      "template":"projects",
      "intendedTemplate":"projects",
      "content":{
        "title":"Projects",
        "text":"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.\r\n\r\nNullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim."
      },
      "files":[

      ],
      "children":[
        {
          "id":"projects/project-a",
          "title":"Project A",
          "parent":"projects",
          "dirname":"1-project-a",
          "diruri":"2-projects/1-project-a",
          "url":"http://localhost:8080/projects/project-a",
          "contentUrl":"http://localhost:8080/content/2-projects/1-project-a",
          "tinyUrl":"http://localhost:8080/x/e1kw3g",
          "depth":2,
          "uri":"projects/project-a",
          "root":"/Users/jongacnik/Sites/kirby/content/2-projects/1-project-a",
          "uid":"project-a",
          "slug":"project-a",
          "num":"1",
          "hash":"e1kw3g",
          "modified":1475951682,
          "template":"project",
          "intendedTemplate":"project",
          "content":{
            "title":"Project A",
            "year":"2014",
            "tags":"outdoor",
            "text":"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo."
          },
          "files":[
            {
              "root":"/Users/jongacnik/Sites/kirby/content/2-projects/1-project-a/forrest.jpg",
              "url":"http://localhost:8080/content/2-projects/1-project-a/forrest.jpg",
              "hash":"385a87a789ed2d14af29b456bfd80752",
              "dir":"/Users/jongacnik/Sites/kirby/content/2-projects/1-project-a",
              "filename":"forrest.jpg",
              "name":"forrest",
              "safeName":"forrest.jpg",
              "extension":"jpg",
              "size":280900,
              "niceSize":"274.32 kB",
              "modified":1475951682,
              "mime":"image/jpeg",
              "type":"image",
              "dimensions":{
                "width":1280,
                "height":853,
                "ratio":1.5005861664713,
                "orientation":"landscape"
              },
              "meta":[

              ]
            },
            {
              "root":"/Users/jongacnik/Sites/kirby/content/2-projects/1-project-a/green.jpg",
              "url":"http://localhost:8080/content/2-projects/1-project-a/green.jpg",
              "hash":"46391b3717002abcd548479f77e2e48f",
              "dir":"/Users/jongacnik/Sites/kirby/content/2-projects/1-project-a",
              "filename":"green.jpg",
              "name":"green",
              "safeName":"green.jpg",
              "extension":"jpg",
              "size":306670,
              "niceSize":"299.48 kB",
              "modified":1475951682,
              "mime":"image/jpeg",
              "type":"image",
              "dimensions":{
                "width":1280,
                "height":853,
                "ratio":1.5005861664713,
                "orientation":"landscape"
              },
              "meta":[

              ]
            },
            {
              "root":"/Users/jongacnik/Sites/kirby/content/2-projects/1-project-a/the-sea.jpg",
              "url":"http://localhost:8080/content/2-projects/1-project-a/the-sea.jpg",
              "hash":"e4332622c6ff44c4ef7d6e397f0d2ab2",
              "dir":"/Users/jongacnik/Sites/kirby/content/2-projects/1-project-a",
              "filename":"the-sea.jpg",
              "name":"the-sea",
              "safeName":"the-sea.jpg",
              "extension":"jpg",
              "size":263038,
              "niceSize":"256.87 kB",
              "modified":1475951682,
              "mime":"image/jpeg",
              "type":"image",
              "dimensions":{
                "width":1280,
                "height":854,
                "ratio":1.4988290398126,
                "orientation":"landscape"
              },
              "meta":[

              ]
            }
          ],
          "children":[

          ]
        },
        {
          "id":"projects/project-b",
          "title":"Project B",
          "parent":"projects",
          "dirname":"2-project-b",
          "diruri":"2-projects/2-project-b",
          "url":"http://localhost:8080/projects/project-b",
          "contentUrl":"http://localhost:8080/content/2-projects/2-project-b",
          "tinyUrl":"http://localhost:8080/x/1bluoqu",
          "depth":2,
          "uri":"projects/project-b",
          "root":"/Users/jongacnik/Sites/kirby/content/2-projects/2-project-b",
          "uid":"project-b",
          "slug":"project-b",
          "num":"2",
          "hash":"1bluoqu",
          "modified":1475951682,
          "template":"project",
          "intendedTemplate":"project",
          "content":{
            "title":"Project B",
            "year":"2013",
            "tags":"city",
            "text":"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo."
          },
          "files":[
            {
              "root":"/Users/jongacnik/Sites/kirby/content/2-projects/2-project-b/mountains.jpg",
              "url":"http://localhost:8080/content/2-projects/2-project-b/mountains.jpg",
              "hash":"4a243fce010d8a1266ddd091a9d96f78",
              "dir":"/Users/jongacnik/Sites/kirby/content/2-projects/2-project-b",
              "filename":"mountains.jpg",
              "name":"mountains",
              "safeName":"mountains.jpg",
              "extension":"jpg",
              "size":169253,
              "niceSize":"165.29 kB",
              "modified":1475951682,
              "mime":"image/jpeg",
              "type":"image",
              "dimensions":{
                "width":1280,
                "height":853,
                "ratio":1.5005861664713,
                "orientation":"landscape"
              },
              "meta":[

              ]
            },
            {
              "root":"/Users/jongacnik/Sites/kirby/content/2-projects/2-project-b/road.jpg",
              "url":"http://localhost:8080/content/2-projects/2-project-b/road.jpg",
              "hash":"f8d91c83779319383a2ee3b6f5294c6d",
              "dir":"/Users/jongacnik/Sites/kirby/content/2-projects/2-project-b",
              "filename":"road.jpg",
              "name":"road",
              "safeName":"road.jpg",
              "extension":"jpg",
              "size":268073,
              "niceSize":"261.79 kB",
              "modified":1475951682,
              "mime":"image/jpeg",
              "type":"image",
              "dimensions":{
                "width":1280,
                "height":850,
                "ratio":1.5058823529412,
                "orientation":"landscape"
              },
              "meta":[

              ]
            }
          ],
          "children":[

          ]
        },
        {
          "id":"projects/project-c",
          "title":"Project C",
          "parent":"projects",
          "dirname":"3-project-c",
          "diruri":"2-projects/3-project-c",
          "url":"http://localhost:8080/projects/project-c",
          "contentUrl":"http://localhost:8080/content/2-projects/3-project-c",
          "tinyUrl":"http://localhost:8080/x/1p79aog",
          "depth":2,
          "uri":"projects/project-c",
          "root":"/Users/jongacnik/Sites/kirby/content/2-projects/3-project-c",
          "uid":"project-c",
          "slug":"project-c",
          "num":"3",
          "hash":"1p79aog",
          "modified":1475951682,
          "template":"project",
          "intendedTemplate":"project",
          "content":{
            "title":"Project C",
            "year":"2012",
            "tags":"stuff",
            "text":"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo."
          },
          "files":[
            {
              "root":"/Users/jongacnik/Sites/kirby/content/2-projects/3-project-c/hightide.jpg",
              "url":"http://localhost:8080/content/2-projects/3-project-c/hightide.jpg",
              "hash":"78a0dde966c390550063dd773bad9074",
              "dir":"/Users/jongacnik/Sites/kirby/content/2-projects/3-project-c",
              "filename":"hightide.jpg",
              "name":"hightide",
              "safeName":"hightide.jpg",
              "extension":"jpg",
              "size":208192,
              "niceSize":"203.31 kB",
              "modified":1475951682,
              "mime":"image/jpeg",
              "type":"image",
              "dimensions":{
                "width":1280,
                "height":853,
                "ratio":1.5005861664713,
                "orientation":"landscape"
              },
              "meta":[

              ]
            },
            {
              "root":"/Users/jongacnik/Sites/kirby/content/2-projects/3-project-c/kermit-the-fog.jpg",
              "url":"http://localhost:8080/content/2-projects/3-project-c/kermit-the-fog.jpg",
              "hash":"667141bffb9f5fcc8ec3a13f55a3e093",
              "dir":"/Users/jongacnik/Sites/kirby/content/2-projects/3-project-c",
              "filename":"kermit-the-fog.jpg",
              "name":"kermit-the-fog",
              "safeName":"kermit-the-fog.jpg",
              "extension":"jpg",
              "size":268191,
              "niceSize":"261.91 kB",
              "modified":1475951682,
              "mime":"image/jpeg",
              "type":"image",
              "dimensions":{
                "width":1280,
                "height":853,
                "ratio":1.5005861664713,
                "orientation":"landscape"
              },
              "meta":[

              ]
            }
          ],
          "children":[

          ]
        }
      ]
    },
    {
      "id":"contact",
      "title":"Contact",
      "parent":"",
      "dirname":"3-contact",
      "diruri":"3-contact",
      "url":"http://localhost:8080/contact",
      "contentUrl":"http://localhost:8080/content/3-contact",
      "tinyUrl":"http://localhost:8080/x/l7027s",
      "depth":1,
      "uri":"contact",
      "root":"/Users/jongacnik/Sites/kirby/content/3-contact",
      "uid":"contact",
      "slug":"contact",
      "num":"3",
      "hash":"l7027s",
      "modified":1475951682,
      "template":"default",
      "intendedTemplate":"contact",
      "content":{
        "title":"Contact",
        "text":"## Get in touch\r\n\r\n- (link: http://getkirby.com/support text: Kirby's support page)\r\n- (link: http://forum.getkirby.com text: Kirby's forum)\r\n- (link: http://github.com/getkirby text: Kirby on Github)\r\n- <support@getkirby.com>\r\n\r\n## Follow us on Twitter\r\n\r\n- Follow Kirby on Twitter (twitter: @getkirby)\r\n- Follow Bastian on Twitter (twitter: @bastianallgeier)\r\n- Follow Nico on Twitter (twitter: @distantnative)\r\n- Follow Sascha on Twitter (twitter: @sashtown)"
      },
      "files":[

      ],
      "children":[

      ]
    }
  ]
}
```
