<?php

use Antoniputra\Asmoyo\Options\OptionInterface;

class Admin_OptionController extends AsmoyoController
{
	public function __construct(OptionInterface $option)
	{
		$this->option = $option;
	}
}