<?php

class ModuleTile extends Module
{
  /**
   * Template
   * @var string
   */
  protected $strTemplate = 'mod_Tile';
  
  public function generate()
  {
	return parent::generate();
  }
	
  protected function compile()
  {
  	
  	$arrayhref [] = array 
  	(
  			'fohn'		=> '#',
  			'jprogram' 	=> '#',
  			'bericht'	=> '#',
  			'kontakt'	=> '#',
  	);
    $this->Template->href = $arrayhref;
  }
}


?>
