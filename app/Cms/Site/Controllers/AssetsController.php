<?php namespace Cms\Site\Controllers;

class AssetsController extends \Controller {

	public function getAppJs() {

		$routes = \PublicRouteDriver::all();
		$entities = \EntityDriver::all();
		$content = \View::make('site.assets.appjs', compact('routes', 'entities'));
		return $content;
	}

}
