### ListGroupBuilder

Methods:

* `build(array $list)` [usage](#build)

##### Build

Build list group from array that defines it.

Array must have `'items'` key with array of items that will be in list.

Optionally you can specify `'wrapper'` and `'child'` element type.

Every item could be string or array with `'content'` as first key and optionally `'href' => '/link'`.

```php

$list = array(
    'wrapper' => 'div', // this is default, you must specify just in case you want different wrapper type
    'child'   => 'a', // this is default, you must specify just in case you want different child type

    'items'   => array(
        'Empty anchor',
        array('Empty anchor too'),
        array('Home', 'href' => '/'),
    )
);

$listGroup->build($list);

```

_Return:_

```html

<div class="list-group">
	<a href="#" class="list-group-item">Empty anchor</a>
	<a href="#" class="list-group-item">Empty anchor too</a>
	<a href="/" class="list-group-item">Home</a>
</div>

<!-- If home is currently active link -->
<div class="list-group">
	<a href="#" class="list-group-item">Empty anchor</a>
	<a href="#" class="list-group-item">Empty anchor too</a>
	<a href="/" class="list-group-item active">Home</a>
</div>

```