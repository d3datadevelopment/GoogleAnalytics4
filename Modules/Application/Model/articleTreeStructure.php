<?php

namespace D3\GoogleAnalytics4\Modules\Application\Model;

trait articleTreeStructure
{
    /**
     * @param int $indexOfArray
     * @return string
     */
    public function getSplitCategoryArray(int $indexOfArray = -1, bool $bShallTakeStd = false) :string
    {
        if ($bShallTakeStd){
            $splitCatArray =
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