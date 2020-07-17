<?php

namespace Home\CompleteeBundle\Resources\contao\dca;
use Home\PearlsBundle\Resources\contao\Helper\Dca as Helper;

$moduleName = 'tl_content';

$tl_content = new Helper\DcaHelper($moduleName);

try{
    $tl_content
        #-- search --------------------------------------------------------------------------------------------------------
        ->addField('page','urlSearch', array('label'=>''))

        #-- search palette
        ->copyPalette('default', 'search_autocomplete')
        ->addPaletteGroup('search_autocomplete', array('urlSearch'), 'search_autocomplete')
    ;
}catch(\Exception $e){
    var_dump($e);
}
