<?php


namespace Home\CompleteeBundle\Resources\contao\elements;


use Contao\ContentElement;
use Contao\PageModel;

class SearchWithAutocomplete extends ContentElement
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_search_autocomplete';

    /**
     * Display a wildcard in the back end
     *
     * @return string
     */
    public function generate()
    {

        return parent::generate();
    }

    /**
     * Generate the module
     */
    protected function compile()
    {
        if (TL_MODE == 'BE') {
            $this->generateBackend();
        } else {
            $this->generateFrontend();
        }
    }

    /**
     * generate backend for module
     */
    private function generateBackend()
    {
        $this->strTemplate          = 'be_wildcard';
        $this->Template             = new \BackendTemplate($this->strTemplate);
        $this->Template->title      = $this->headline;
        $this->Template->wildcard   = "### " . $GLOBALS['TL_LANG']['CTE']['search_autocomplete'][0] ." ###";
    }

    /**
     * generate frontend for module
     */
    private function generateFrontend()
    {
        $GLOBALS['TL_CSS'][] = '/bundles/homecompletee/style.css';

        #-- get auto_item
        if (!isset($_GET['item']) && \Config::get('useAutoItem') && isset($_GET['auto_item'])) {
            \Contao\Input::setGet('item', \Contao\Input::get('auto_item'));
        }

        $this->Template->keywordLabel = $GLOBALS['TL_LANG']['MSC']['keywords'];
        $this->Template->optionsLabel = $GLOBALS['TL_LANG']['MSC']['options'];
        $this->Template->search = \StringUtil::specialchars($GLOBALS['TL_LANG']['MSC']['searchLabel']);
        $this->Template->matchAll = \StringUtil::specialchars($GLOBALS['TL_LANG']['MSC']['matchAll']);
        $this->Template->matchAny = \StringUtil::specialchars($GLOBALS['TL_LANG']['MSC']['matchAny']);
        $this->Template->action = ampersand(\Environment::get('indexFreeRequest'));
        // Redirect page
        $objTarget = PageModel::findByIdOrAlias($this->urlSearch);
        if ($objTarget && $objTarget instanceof PageModel)
        {
            /** @var PageModel $objTarget */
            $this->Template->action = $objTarget->getFrontendUrl();
        }
    }

    public static function completeeSearch($strKeywords, $strQueryType, $arrPages = array(), $blnFuzzy=false)
    {
        $arrResult = array();

        try
        {
            $objSearch = \Search::searchFor($strKeywords, ($strQueryType == 'or'), $arrPages, 0, 0, $blnFuzzy);
            $arrResult = $objSearch->fetchAllAssoc();
        }
        catch (\Exception $e)
        {

        }

        return $arrResult;
    }
}
