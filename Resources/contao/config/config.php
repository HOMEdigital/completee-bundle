<?php

#-- add modules --------------------------------------------------------------------------------------------------------
array_insert($GLOBALS['TL_CTE'], 2, array
(
    'search' => array
    (
        'search_autocomplete' => 'Home\CompleteeBundle\Resources\contao\elements\SearchWithAutocomplete'
    ),
));
