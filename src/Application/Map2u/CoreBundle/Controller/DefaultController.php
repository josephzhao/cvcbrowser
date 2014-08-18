<?php

namespace Application\Map2u\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Map2u\CoreBundle\Entity\UploadShapefileLayer;
use Map2u\CoreBundle\Entity\UserUploadShapefile;
use Map2u\CoreBundle\Entity\UserUploadShapefileGeom;
use Map2u\CoreBundle\Controller\DefaultController as BaseController;

/**
 * Map2u Core Default controller.
 *
 * @Route("/")
 */
class DefaultController extends BaseController {

}
