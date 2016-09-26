<?php

$spad = function () {
  function buildTree ($parent) {
    $tree = [];
    if ($parent->id()) {
      $tree = array_merge($tree, $parent->toArray());
    }
    $tree['files'] = $parent->files()->toArray();
    $tree['children'] = array_map(function ($n) {
      return buildTree(site()->find($n['id']));
    }, $parent->children()->visible()->toArray());
    return $tree;
  }
  return buildTree(site());
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
