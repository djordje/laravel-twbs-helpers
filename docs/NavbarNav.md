### NavBuilder

Methods:

* `build(array $menu)` [usage](#build)
* `buildDropdown(array $menu, $dropdownTitle)` [usage](#build-dropdown)


##### Build

Param `$menu` - Assoc array of `'title' => 'link'` values

If `link` is array that will be passed to `buildDropdown` method and rendered as dropdown.

If link is equal to `Request::url()` wrapper `<li>` will have `active` class.

```php

$menu = array(
	'Home' => route('home'),
	// This part will be rendered by ``buildDropdown`
	'Dropdown' => array(
		'First item' => '/dropdown/first-item'
	),
	'About' => route('about')
);

$nav->build($menu);

```

_Return:_

```html

<li><a href="/">Home</a></li>
<!-- DROPDOWN see bellow -->
<li><a href="/about">About</a></li>

```

##### Build dropdown

Param `$menu` - Assoc array of `'title' => 'link'` values

Param `$dropdownTitle` - String that will be shown as dropdown title

This method could be used directly or trough `build`.

```php

$menu = array(
	'First item' => '/dropdown/first-item',
	'-divider-',
	'Second item' => '/dropdown/second-item'
);

$nav->buildDropdown($menu, 'Dropdown Title');

```

_Return:_

```html

<li>
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Title <b class="caret"></b></a>
	<ul class="dropdown-menu">
		<li><a href="/dropdown/first-item">First item</a></li>
		<li class="divider"></li>
		<li><a href="/dropdown/second-item">Second item</a></li>
	</ul>
</li>

```