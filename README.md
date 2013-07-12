# CakePHP Trailing Slash Support

Legacy support for Cake apps that still use/need trailing slash routing.

License: MIT
CakePHP: 2.x (tested with 2.3)

## Disclaimer
*Do not use this for new projects!* We just had to keep the support for legacy 1.2 apps in 2.x.

It creates more complications than it's worth.
Also, it's totally uncessary these days to do it this way. Just never allow access both ways (with and without trailing slash).
Best to stick to the Cake convention, dont use trailing slashes and 301-redirect the trailing slash urls back (using htaccess).
See the notes for details.

## Get it running

Put the TrailingSlashRouter class in your /Lib/Routing/ folder

Then modify your AppController for all redirects:

	/**
	 * Add trailing slash to all redirects.
	 * Also try to prevent 301s due to missing / at the end
	 *
	 * @overwrite
	 * @param mixed $url
	 * @param mixed $status
	 * @param boolean $exit
	 * @return void
	 */
	public function redirect($url, $status = null, $exit = true) {
		TrailingSlashRouter::addTrailingSlash(true);
		$url = TrailingSlashRouter::url($url, true);
		return parent::redirect($url, $status, $exit);
	}

Do not forget the App::uses() statement at the top of the ontroller file (after `<?php`):

	App::uses('TrailingSlashRouter', 'Routing');

Your AppHelper also needs adjustments (for Html::url() and Html::link() to function properly):

	/**
	 * Add trailing slash to all redirects.
	 * Also try to prevent 301s due to missing / at the end
	 *
	 * @param mixed $url
	 * @param boolean $full
	 * @return string Url
	 */
	public function url($url = null, $full = false) {
		TrailingSlashRouter::addTrailingSlash(true);
		$routerUrl = TrailingSlashRouter::url($url, $full);
		$routerUrl = h($routerUrl);
		return $routerUrl;
	}

### Notes
For this to work it needs array urls. String urls will not be modified and need to be already appended with the correct slash.

As mentioned above, to avoid SEO issues, it's best to use htacess to prevent access to the other "form" (non trailing in this case).
You can read more on that here: http://www.dereuromark.de/2012/12/29/cakephp-and-seo/

### Tests
I use the AppController and AppHelper test files to test that the behavior for the url generation works.
For convenience I just copied in some exemplary checks you might want to add to your tests.