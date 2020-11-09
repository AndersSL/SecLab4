<?php

namespace foo\foo\controller;

use Symfony\Component\HttpFoundation\Response;

class controller {
	/**
	 *
	 * @return unknown
	 */


	public function handle() {
		return new Response('foo/foo controller handle() method', 200);
	}


}
