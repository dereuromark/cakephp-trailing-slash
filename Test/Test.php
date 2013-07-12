<?php

// just copy those over to your test file, in this case AppHelper:

$res = $this->App->url(array('controller' => 'foo', 'action' => 'add'));
$this->assertEquals('/foo/add/', $res);

$res = $this->App->url(array('controller'=>'foo', 'action' => 'add'), true);
$this->assertEquals(FULL_BASE_URL . '/foo/add/', $res);

$res = $this->App->urlWithoutTrailingSlash(array('controller'=>'foo', 'action' => 'add'), false);
$this->assertEquals('/foo/add', $res);

$res = $this->App->urlWithoutTrailingSlash(array('controller'=>'foo', 'action' => 'add', '?' => array('x'=> 'y')), false);
$this->assertEquals('/foo/add?x=y', $res);

$res = $this->App->url(array('controller'=>'foo', 'action' => 'add', 'ext' => 'js'));
$this->assertEquals('/foo/add.js', $res);

$res = $this->App->url(array('controller'=>'foo', 'action' => 'add', 'ext' => 'jsa'));
$this->assertEquals('/foo/add.jsa', $res);

$res = $this->App->url(array('controller'=>'foo', 'action' => 'add', 'ext' => 'jsa', '?' => array('foo'=>'bar')));
$this->assertEquals('/foo/add.jsa?foo=bar', $res);

$res = $this->App->url(array('controller' => 'users', 'action' => 'index', 'foo', '?' => array('x' => 'o&u'), '#' => 'u&a'));
// escaped content: /users/index/foo/?x=o%26u#u&a
$this->assertEquals('/users/index/foo/?x=o%26u#u&amp;a', $res);

$res = $this->App->url('/img/static/some.jpg');
$this->assertEquals('/img/static/some.jpg', $res);

$res = $this->App->url(array('controller'=>'foo', 'action' => 'add', 'ext' => 'jsa', '?' => array('x' => 'y'), '#' => 'abc'));
$this->assertEquals('/foo/add.jsa?x=y#abc', $res);