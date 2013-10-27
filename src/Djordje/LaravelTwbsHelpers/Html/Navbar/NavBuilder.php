<?php namespace Djordje\LaravelTwbsHelpers\Html\Navbar;

use Illuminate\Support\Facades\Request;

class NavBuilder {

	/**
	 * Convert array of `'title' => 'link'` keys to nav items
	 *
	 * @param array $menu
	 * @return string
	 */
	public function build(array $menu)
	{
		$output = '';

		foreach ($menu as $title => $link)
		{
			if (is_array($link))
			{
				$output .= $this->buildDropdown($link, $title);
				continue;
			}

			$navEntity = $this->createNavEntity($title, $link);
			$output .= $navEntity['html'];
		}

		return $output;
	}

	/**
	 * Convert array of `'title' => 'link'` keys to nav dropdown
	 *
	 * @param array $menu
	 * @param string $dropdownTitle
	 * @return string
	 */
	public function buildDropdown(array $menu, $dropdownTitle = null)
	{
		$submenuActive = false;
		$outputBuffer = '';
		$output = '';

		foreach ($menu as $title => $link)
		{
			if ($link === '-divider-')
			{
				$outputBuffer .= '<li class="divider"></li>';
				continue;
			}
			$navEntity = $this->createNavEntity($title, $link);
			if ( ! $submenuActive && $navEntity['active'])
			{
				$submenuActive = true;
			}
			$outputBuffer .= $navEntity['html'];
		}

		if ($submenuActive)
		{
			$output .= '<li class="dropdown active">';
		}
		else
		{
			$output .= '<li class="dropdown">';
		}
		$output .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$dropdownTitle.' <b class="caret"></b></a>';
		$output .= '<ul class="dropdown-menu">';
		$output .= $outputBuffer;
		$output .= '</ul>';
		$output .= '</li>';

		return $output;
	}

	/**
	 * Generate link item html
	 *
	 * @param string $title
	 * @param string $link
	 * @return array
	 */
	protected function createNavEntity($title, $link)
	{
		$active = ($link === Request::url());
		$html = '';

		if ($active)
		{
			$html .= '<li class="active">';
		}
		else
		{
			$html .= '<li>';
		}
		$html .= '<a href="'.$link.'">'.$title.'</a></li>';

		return compact('html', 'active');
	}

}