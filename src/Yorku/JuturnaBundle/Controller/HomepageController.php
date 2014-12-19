<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Yorku\JuturnaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Stations controller.
 *
 * @Route("/")
 */
class HomepageController extends Controller {

    /**
     * .
     *
     * @Route("/", name="homepage_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {
        $session = $request->getSession();
        $session->set('current_menu', "home");
          $em = $this->getDoctrine()->getManager();
        $description = $em->getRepository('YorkuJuturnaBundle:HomepageDescription')->findOneBy(array('active'=>true),array("updatedAt"=>'desc'));
        return array('current_menu' => "home",'description'=>$description);
    }

    /**
     * .
     *
     * @Route("/images", name="homepage_images")
     * @Method("GET")
     * @Template()
     */
    public function imagesAction(Request $request) {
        $type = $request->get("type");

        if (!isset($type) || $type == null) {
            $type = "Well-Being";
        }
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('YorkuJuturnaBundle:Category')->findOneByName($type);
        //    var_dump($category);
//        if (!isset($id)) {
//            return new Response(\json_encode(array('success' => false, 'message' => 'Parameter Id not found!')));
//        }
//        if  ((isset($id) && ( $id === 0 || $id === '0' || $id === 'undefined'))) {
//            $usergeometries = new UserDrawGeometries();
//        } else {
        $image = $em->getRepository('YorkuJuturnaBundle:HomepageImage')->findOneBy(array('category' => $category));
//
//            $update_geom = true;
//        }
        return array('image' => $image, 'type' => strtolower(str_replace("-", "_", $type)));
    }

    /**
     * .
     *
     * @Route("/flashs", name="homepage_flashs")
     * @Method("GET")
     * @Template()
     */
    public function flashsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//        if (!isset($id)) {
//            return new Response(\json_encode(array('success' => false, 'message' => 'Parameter Id not found!')));
//        }
//        if  ((isset($id) && ( $id === 0 || $id === '0' || $id === 'undefined'))) {
//            $usergeometries = new UserDrawGeometries();
//        } else {
        $flashs = $em->getRepository('YorkuJuturnaBundle:HomepageFlash')->findAll();
//
//            $update_geom = true;
//        }
        return array('flashs' => $flashs);
    }

    /**
     * .
     *
     * @Route("/well_being", name="homepage_well_being")
     * @Method("GET")
     * @Template()
     */
    public function well_beingAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $session->set('current_menu', "well_being");
        $category = $em->getRepository('YorkuJuturnaBundle:Category')->findOneByName("Well-Being");

//        if (!isset($id)) {
//            return new Response(\json_encode(array('success' => false, 'message' => 'Parameter Id not found!')));
//        }
//        if  ((isset($id) && ( $id === 0 || $id === '0' || $id === 'undefined'))) {
//            $usergeometries = new UserDrawGeometries();
//        } else {
        $image = $em->getRepository('YorkuJuturnaBundle:HomepageImage')->findOneBy(array('category' => $category));
//
//            $update_geom = true;
//        }


        $flashs = $em->getRepository('YorkuJuturnaBundle:HomepageFlash')->findAll();
//
//            $update_geom = true;
//        }
        return array('image' => $image, 'flashs' => $flashs);
    }

    /**
     * .
     *
     * @Route("/ecosystems", name="homepage_ecosystems")
     * @Method("GET")
     * @Template()
     */
    public function ecosystemsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $session->set('current_menu', "ecosystems");
        $category = $em->getRepository('YorkuJuturnaBundle:Category')->findOneByName("Ecosystems");

//        if (!isset($id)) {
//            return new Response(\json_encode(array('success' => false, 'message' => 'Parameter Id not found!')));
//        }
//        if  ((isset($id) && ( $id === 0 || $id === '0' || $id === 'undefined'))) {
//            $usergeometries = new UserDrawGeometries();
//        } else {
        $image = $em->getRepository('YorkuJuturnaBundle:HomepageImage')->findOneBy(array('category' => $category));

        $flashs = $em->getRepository('YorkuJuturnaBundle:HomepageFlash')->findAll();

        return array('image' => $image,'flashs' => $flashs);
    }

    /**
     * .
     *
     * @Route("/map", name="homepage_map")
     * @Method("GET")
     * @Template()
     */
    public function mapAction(Request $request) {
        $session = $request->getSession();
        $session->set('current_menu', "map");
        $em = $this->getDoctrine()->getManager();
//        if (!isset($id)) {
//            return new Response(\json_encode(array('success' => false, 'message' => 'Parameter Id not found!')));
//        }
//        if  ((isset($id) && ( $id === 0 || $id === '0' || $id === 'undefined'))) {
//            $usergeometries = new UserDrawGeometries();
//        } else {
        $flashs = $em->getRepository('YorkuJuturnaBundle:HomepageFlash')->findAll();
//
//            $update_geom = true;
//        }
        return array('flashs' => $flashs);
    }

    /**
     * .
     *
     * @Route("/stories", name="homepage_stories")
     * @Method("GET")
     * @Template()
     */
    public function storiesAction(Request $request) {
        $session = $request->getSession();
        $session->set('current_menu', "stories");
        $em = $this->getDoctrine()->getManager();
//        if (!isset($id)) {
//            return new Response(\json_encode(array('success' => false, 'message' => 'Parameter Id not found!')));
//        }
//        if  ((isset($id) && ( $id === 0 || $id === '0' || $id === 'undefined'))) {
//            $usergeometries = new UserDrawGeometries();
//        } else {
        $flashs = $em->getRepository('YorkuJuturnaBundle:HomepageFlash')->findAll();
//
//            $update_geom = true;
//        }
        return array('flashs' => $flashs);
    }

    /**
     * .
     *
     * @Route("/contact_us", name="homepage_contact_us")
     * @Method("GET")
     * @Template()
     */
    public function contact_usAction(Request $request) {
        $session = $request->getSession();
        $session->set('current_menu', "contact_us");
        $em = $this->getDoctrine()->getManager();
//        if (!isset($id)) {
//            return new Response(\json_encode(array('success' => false, 'message' => 'Parameter Id not found!')));
//        }
//        if  ((isset($id) && ( $id === 0 || $id === '0' || $id === 'undefined'))) {
//            $usergeometries = new UserDrawGeometries();
//        } else {
        $flashs = $em->getRepository('YorkuJuturnaBundle:HomepageFlash')->findAll();
//
//            $update_geom = true;
//        }
        return array('flashs' => $flashs);
    }

    /**
     * .
     *
     * @Route("/about_us", name="homepage_about_us")
     * @Method("GET")
     * @Template()
     */
    public function about_usAction(Request $request) {
        $session = $request->getSession();
        $session->set('current_menu', "about_us");
        $em = $this->getDoctrine()->getManager();
//        if (!isset($id)) {
//            return new Response(\json_encode(array('success' => false, 'message' => 'Parameter Id not found!')));
//        }
//        if  ((isset($id) && ( $id === 0 || $id === '0' || $id === 'undefined'))) {
//            $usergeometries = new UserDrawGeometries();
//        } else {
        $flashs = $em->getRepository('YorkuJuturnaBundle:HomepageFlash')->findAll();
//
//            $update_geom = true;
//        }
        return array('flashs' => $flashs);
    }
/**
     * .
     *
     * @Route("/footer", name="homepage_footer")
     * @Method("GET")
     * @Template()
     */
    public function footerAction(Request $request) {
      
        return array();
    }
}
