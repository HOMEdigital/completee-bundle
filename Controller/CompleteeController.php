<?php

namespace Home\CompleteeBundle\Controller;

use Contao\Database;
use Home\CompleteeBundle\Resources\contao\elements\SearchWithAutocomplete;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompleteeController extends Controller
{
    /**
     * @Route("/completee/{type}/{searchString}", name="getSearchResults")
     *
     * @param $type
     * @param $searchString
     * @return JsonResponse
     */
    public function importDbWithScriptAction($searchString, $type)
    {
        $this->container->get('contao.framework')->initialize();

        $response = array(
            'success' => false,
            'results' => array()
        );

        if($searchString && is_string($searchString)){
            $results = SearchWithAutocomplete::completeeSearch($searchString, $type);
            $response['success'] = true;
            $response['results'] = $results;
        }

        return new JsonResponse($response);
    }

}
