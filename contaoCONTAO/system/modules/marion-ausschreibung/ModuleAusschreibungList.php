<?php
 
namespace Contao;
 
/**
 * Class ModuleAusschreibungList
 *
 * Front end module "cd list".
 */
class ModuleAusschreibungList extends Module
{
 
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_ausschreibunglist';
 
 
    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new \BackendTemplate('be_wildcard');
 
            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['ausschreibung_list'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&table=tl_module&act=edit&id=' . $this->id;
 
            return $objTemplate->parse();
        }
 
        return parent::generate();
    }
 
 
    
    
    
    
    
    /**
     * Generate the module
     */
    protected function compile()
    {
        
    	//die ganze Tabelle
    	$arrAus = array();
    	$objAus = $this->Database->execute("SELECT * FROM tl_ausschreibung ORDER BY start_date ASC");
    	
    	while ($objAus->next()) {
    		$arrAus[] = array
    		(
    			'title' => $objAus->title,
                'start_date' => $objAus->start_date,
                'end_date' => $objAus->end_date,
                'anmelde_schluss' => $objAus->anmelde_schluss,
                //'cover' => $strCover,
				'teaser' => $objAus->teaser,
                'text' => $objAus->text
    		);
    	}
    	if (TL_MODE == 'FE') {
    		$this->Template->fmdId = $this->id;
    		$this->Template->Ausschreibung = $arrAus;
    	}
    	$arrNextEvent = array();
    	$objAus = $this->Database->prepare("SELECT * FROM tl_ausschreibung WHERE start_date>?")->limit(3)->execute(time());
    	
    	while ($objAus->next()) {
    		$arrNextEvent[] = array
    		(
    			'title' => $objAus->titel,
                'start_date' => date('Y-m-d', (int)$objAus->start_date),
                'end_date' => $this->datumswandler(date('Y-m-d', (int)$objAus->end_date)),
                'anmelde_schluss' => $objAus->anmelde_schluss,
                //'cover' => $strCover,
				'teaser' => $objAus->teaser,
                'text' => $objAus->text
    		);
    	}
    	$this->Template->arrNextEvent = $arrNextEvent;
    	}
    	
    	
 
            //coover Image
            /*$strCover = '';
            $objCover = \FilesModel::findByPk($objCds->cover);
 
            // Add cover image
            if ($objCover !== null)
            {
                $strCover = \Image::getHtml(\Image::get($objCover->path, '100', '100', 'center_center'));
            }*/
    	public function datumswandler($Datum)
    	{
    	
    		$Tag = substr($Datum, 8, 2); //Nimmt die 2 Zeichen rechts des 8. Zeichens(=Zeichen 9 und 10)
    		$Monat = substr($Datum, 5, 2); //Nimmt die 2 Zeichen rechts des 5. Zeichens(=Zeichen 6 und 7)
    		$Jahr = substr($Datum, 0, 4); //Gibt die 4-stellige Jahreszahl z.B 2007)
    	
    		$WochentagEnglisch = date("l", mktime(0, 0, 0, $Monat, $Tag, $Jahr));
    	
    		$WochentagArray = array(
    				'Monday' => "Mo",
    				'Tuesday' => "Di",
    				'Wednesday' => "Mi",
    				'Thursday' => "Do",
    				'Friday' => "Fr",
    				'Saturday' => "Sa",
    				'Sunday' => "So"
    		);
    		$WochentagDeutsch = $WochentagArray[$WochentagEnglisch];
    	
    		$Jahr = substr($Datum, 2, 2); //Gibt die 2-stellige Jahreszahl z.B. "07")
    	
    		$Datum = $WochentagDeutsch . ', ' . $Tag . '.' . $Monat . '.' . $Jahr; //Haengt die Variablen zum fertigen Datum zusammen
    		return $Datum;
    	}
            
}