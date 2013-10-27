<?php namespace Djordje\LaravelTwbsHelpers\Html;

//$a = array(
//	'wrapper' => 'div',
//	'child' => 'a',
//	'items' => array(
//		array('content', 'href' => '')
//	)
//);

class ListGroupBuilder extends BaseTwbsBuilder {

	/**
	 * Wrapper element type
	 *
	 * @var string
	 */
	protected $wrapper = 'div';

	/**
	 * Child element type
	 *
	 * @var string
	 */
	protected $child   = 'a';

	/**
	 * Build list group from array that defines it.
	 *
	 * Array must have `'items'` key with array of items that will be in list.
	 * Optionally you can specify `'wrapper'` and `'child'` element type.
	 *
	 * Every item could be string or array with `'content'` as first key and optionally `'href' => '/link'`.
	 *
	 * @param array $list
	 * @return string
	 */
	public function build(array $list)
	{
		$this->setup($list);
		$output = '';

		foreach ($list['items'] as $item)
		{
			$output .= $this->createListItem($item);
		}

		return $this->wrap($output);
	}

	/**
	 * Prepare wrapper and child element types.
	 *
	 * @param array $list
	 */
	protected function setup(array $list)
	{
		if (isset($list['child']) && $list['child'] === 'li')
		{
			$this->wrapper = 'ul';
			$this->child   = 'li';
		}
		else
		{
			if (isset($list['child']))
			{
				$this->child = $list['child'];
			}
			if (isset($list['wrapper']))
			{
				$this->wrapper = $list['wrapper'];
			}
		}
	}

	/**
	 * Create list item.
	 * If `'a'` is child type add href and `'active'` class if link is currently active link.
	 *
	 * @param string|array $item
	 * @return string
	 */
	protected function createListItem($item)
	{
		$item = (array) $item;
		$output = '';

		if ($this->child === 'a' && ( ! isset($item['href'])))
		{
			$item['href'] = '#';
		}

		if ($this->child === 'a')
		{
			$output .= '<a href="'.$item['href'].'"';

			if ($this->isActiveLink($item['href']))
			{
				$output .= ' class="list-group-item active"';
			}
			else
			{
				$output .= ' class="list-group-item"';
			}
			$output .= '>';
		}
		else
		{
			$output .= '<'.$this->child.' class="list-group-item">';
		}
		$output .= $item[0].'</'.$this->child.'>';

		return $output;
	}

	/**
	 * Wrap generated content with wrapper before send output to user.
	 *
	 * @param string $content
	 * @return string
	 */
	protected function wrap($content)
	{
		return '<'.$this->wrapper.' class="list-group">'.$content.'</'.$this->wrapper.'>';
	}

}