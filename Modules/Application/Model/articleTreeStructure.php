<?php

namespace D3\GoogleAnalytics4\Modules\Application\Model;

use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\ViewConfig;

trait articleTreeStructure
{
    /**
     * Get all parent category titles, starting from the base category.
     *
     * @return array
     */
    protected function getParentCategoryTitles() :array
    {
        $parentTitles[] = $this->getTitle();
        // we may be in Manufacturer, Vendor, etc.
        if (method_exists($this, 'getParentCategory')) {
            $parent = $this->getParentCategory();
            while ($parent != null) {
                $parentTitles[] = $parent->getTitle();
                $parent = $parent->getParentCategory();
            }
        }
        return array_reverse(array_map([$this, 'cleanUpTitle'], $parentTitles));
    }
    /**
     * Cleanup title, decode entities, remove some chars and trim
     *
     * @param string $title
     * @return string
     */
    public function cleanUpTitle($title) :string
    {
        // decode encoded characters
        $title = html_entity_decode($title, ENT_QUOTES);
        // remove unwanted characters, e.g. Zoll "
        $charsToReplace = Registry::get(ViewConfig::class)->getCharsToReplaceInCategorTitles();
        $title = preg_replace('/[' . $charsToReplace . ']/', '', $title);
        // trim whitespace from both ends of the string
        $title = trim($title);
        return $title;
    }
    /**
     * @param int $indexOfArray
     * @return string
     */
    public function getSplitCategoryArray(int $indexOfArray = -1, bool $bShallTakeStd = false) :string
    {
        if ($bShallTakeStd){
            $bUseRealCatTitles = (bool)Registry::get(ViewConfig::class)->d3GetModuleConfigParam('_blUseRealCategoyTitles');
            $splitCatArray = $bUseRealCatTitles ? $this->getParentCategoryTitles() :
                array_values(
                    array_filter(
                        explode(
                            '/',
                            trim(
                                parse_url(
                                    $this->getLink(),
                                    5
                                )
                            )
                        )
                    )
                );

            if (($indexOfArray >= 0) and (false === empty($splitCatArray[$indexOfArray]))){
                return $splitCatArray[$indexOfArray];
            }else{
                return "";
            }
        }

        return
            trim(
                parse_url(
                    $this->getLink(),
                    5
                )
            );
    }
}