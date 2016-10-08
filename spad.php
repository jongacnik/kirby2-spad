<?php

$spad = function () {
  $filterAll = kirby()->option('spad.filterAll', function ($data) {
    return $data;
  });

  function buildTree ($parent) {
    $filterEach = kirby()->option('spad.filterEach', function ($page) {
      return $page;
    });

    $tree = [];
    if ($parent->id()) {
      $tree = array_merge($tree, $parent->toArray());
      // parse yaml fields
      $tree['content'] = array_map(function ($n) use ($tree) {
        $parsed = yaml($n);
        if (isset($parsed[0]) && is_array($parsed[0])) {
          return $parsed;
        } else {
          return $n;
        }
      }, $tree['content']);
    }
    $tree['files'] = $parent->files()->toArray();
    $tree['children'] = array_map(function ($n) {
      return buildTree(site()->find($n['id']));
    }, $parent->children()->visible()->toArray());
    return $filterEach($tree);
  }

  return $filterAll(buildTree(site()));
};

$kirby->set('site::method', kirby()->option('spad.method', 'spad'), function () use ($spad) {
  return json_encode($spad());
});

kirby()->routes([
  [
    'pattern' => kirby()->option('spad.route', 'spad'),
    'action' => function () use ($spad) {
      return response::json($spad());
    }
  ]
]);
