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
    } else {
      $tree['content'] = $parent->content()->toArray();
    }
    $tree['files'] = $parent->files()->sortBy('sort', 'asc')->toArray();
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
