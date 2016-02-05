<?php

require_once 'Michelf/MarkdownExtra.inc.php';
class Markdown
{
	private $MarkdownExtra;
    public function __construct()
    {
    	$this->MarkdownExtra = new Michelf\MarkdownExtra();
    }
	public function markdown_to_html($markdown)
	{
		return $this->MarkdownExtra->defaultTransform($markdown);
	}

}
