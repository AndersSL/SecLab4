<?php
/**
 * This file is part of the phpBB Forum Software package.
 *
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @copyright Portions (c) 2009 Fabien Potencier, Armin Ronacher
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 * For full copyright and license information, please see
 * the docs/CREDITS.txt file.
 *
 * @package default
 */


namespace phpbb\template\twig\node;

class definenode extends \Twig\Node\Node
{

	/**
	 *
	 * @param unknown $capture
	 * @param Node    $name
	 * @param Node    $value
	 * @param unknown $lineno
	 * @param unknown $tag     (optional)
	 */
	public function __construct($capture, \Twig\Node\Node $name, \Twig\Node\Node $value, $lineno, $tag = null) {
		parent::__construct(array('name' => $name, 'value' => $value), array('capture' => $capture, 'safe' => false), $lineno, $tag);
	}


	/**
	 * Compiles the node to PHP.
	 *
	 * @param \Twig\Compiler           A Twig\Compiler instance
	 * @param Compiler       $compiler
	 */
	public function compile(\Twig\Compiler $compiler) {
		$compiler->addDebugInfo($this);

		if ($this->getAttribute('capture')) {
			$compiler
			->write("ob_start();\n")
			->subcompile($this->getNode('value'))
			;

			$compiler->write("\$value = ('' === \$value = ob_get_clean()) ? '' : new \Twig\Markup(\$value, \$this->env->getCharset());\n");
		}
		else {
			$compiler
			->write("\$value = ")
			->subcompile($this->getNode('value'))
			->raw(";\n")
			;
		}

		$compiler
		->write("\$context['definition']->set('")
		->raw($this->getNode('name')->getAttribute('name'))
		->raw("', \$value);\n")
		;
	}


}
