<?php

/**
 * <copyright>
 * This file/program is free and open source software released under the GNU General Public
 * License version 3, and is distributed WITHOUT ANY WARRANTY. A copy of the GNU General
 * Public Licence is available at http://www.gnu.org/licenses
 * </copyright>
 *
 * <author>Shuilin (Joseph) Zhao</author>
 * <company>SpEAR Lab, Faculty of Environmental Studies, York University
 * <email>zhaoshuilin2004@yahoo.ca</email>
 * <date>created at 2014/01/06</date>
 * <date>last updated at 2015/03/11</date>
 * <summary>This file is created for admin controller with bundle YorkuJuturnaBundle</summary>
 * <purpose>all admin actions process in this controller except the sonata admin dashboard</purpose>
 */

namespace Yorku\JuturnaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\DBAL\Types\Type;
use Yorku\JuturnaBundle\Entity\Users;

Type::overrideType('datetime', 'Doctrine\DBAL\Types\VarDateTimeType');
Type::overrideType('datetimetz', 'Doctrine\DBAL\Types\VarDateTimeType');
Type::overrideType('time', 'Doctrine\DBAL\Types\VarDateTimeType');

/**
 * Stations controller.
 *
 * @Route("/sysadmin")
 */
class AdminController extends Controller {

    /**
     * Lists all BenthicCollections entities.
     *
     * @Route("/", name="admin_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = null; // $em->getRepository('YorkuJuturnaBundle:BenthicCollections')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all admin roles.
     *
     * @Route("/terms_of_use", name="admin_terms_of_use")
     * @Method("GET")
     * @Template()
     */
    public function terms_of_useAction() {
        return new Response("Termal of Use");
    }

    /**
     * Lists all admin roles.
     *
     * @Route("/roles", name="admin_roles")
     * @Method("GET")
     * @Template()
     */
    public function rolesAction() {

//     $em = $this->getDoctrine()->getManager();
//     $entities = $em->getRepository('YorkuJuturnaBundle:Roles')->findAll();

        $conn = $this->get('database_connection');
        $roles = $conn->fetchAll("SELECT  * FROM roles  order by name");

        return new JsonResponse(array(
            'data' => $roles
        ));
    }

    /**
     * Lists all admin userprofile.
     *
     * @Route("/userprofile", name="admin_userprofile")
     * @Method("GET")
     * @Template()
     */
    public function userprofileAction() {
//     $em = $this->getDoctrine()->getManager();
//     $entities = $em->getRepository('YorkuJuturnaBundle:Roles')->findAll();

        $conn = $this->get('database_connection');

        $roles = null; //$conn->fetchAll("SELECT  * FROM roles  order by name");

        return new JsonResponse(array(
            'data' => $roles
        ));
    }

    /**
     * Lists all BenthicCollections entities.
     *
     * @Route("/javascript", name="admin_javascript")
     * @Method("GET")
     * @Template()
     */
    public function javascriptAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $logos = $em->getRepository('YorkuJuturnaBundle:Logo')->findBy(array('enabled' => true), array("showSeq" => 'ASC'));
        $systemparams = $em->getRepository('YorkuJuturnaBundle:Systemparams')->findAll();

        if ($systemparams) {
            $systemparam = $systemparams[0];
        } else {
            $systemparam = null;
        }
        return array('logos' => $logos, 'systemparams' => $systemparams);
    }

    /**
     * show details for watersheds , subwatersheds and stations.
     *
     * @Route("/details", name="admin_details")
     * @Method("GET")
     * @Template()
     */
    public function detailsAction() {

//        $em = $this->getDoctrine()->getManager();
//        $request = $this->getRequest();
//        $id = $request->get('id');
//        $content_id = $request->get('content_id');
//
//        if ($id !== null && $content_id !== null) {
//            $conn = $this->get('database_connection');
//            if ($id == 1) {
//                $watersheds = $conn->fetchAll("SELECT  * FROM watersheds  order by watershed_name");
//                return $this->render("YorkuJuturnaBundle:Admin:details.html.twig", array('watersheds' => $watersheds));
//            }
//            if ($id == 2) {
//
//                $subwatersheds = $conn->fetchAll("SELECT  * FROM subwatersheds where watershed_id=$content_id order by subwatershed_name");
//                return $this->render("YorkuJuturnaBundle:Admin:watersheddetails.html.twig", array('subwatersheds' => $subwatersheds));
//            }
//            if ($id == 3) {
//                $subwatershed = $em->getRepository('YorkuJuturnaBundle:Subwatersheds')->findOneById($content_id);
//                $stations = $conn->fetchAll("SELECT  * FROM stations  where subwatershed_id=$content_id order by station_name");
//                return $this->render("YorkuJuturnaBundle:Admin:subwatersheddetails.html.twig", array('stations' => $stations, 'content_id' => $content_id, 'subwatershed' => $subwatershed));
//            }
//            if ($id == 4) {
//                if (strlen($content_id) == 7)
//                    $stations = $conn->fetchAll("SELECT  * FROM stations  where station_name='$content_id' limit 1");
//                else if(is_numeric($content_id))
//                {
//                    $stations = $conn->fetchAll("SELECT  * FROM stations  where id=$content_id limit 1");
//                }
//                else {
//                    $stations = $conn->fetchAll("SELECT  * FROM stations  where station_name=$content_id limit 1");
//                    
//                }
//                    $station=null;
//                $watershed=null;
//                $subwatershed=null;
//                $samplesbenthic=null;
//                $waterchemistry=null;
//                $sitedescriptions=null;
//                if(isset($stations) && count($stations)>0)
//                {
//                    $station=$stations[0];
//                $watershed_id = $stations[0]['watershed_id'];
//                $subwatershed_id = $stations[0]['subwatershed_id'];
//                $station_id = $stations[0]['id'];
//
//                if ($stations[0] && sizeof($stations) == 1) {
//                    $watersheds = $conn->fetchAll("SELECT  * FROM watersheds  where id=$watershed_id limit 1");
//                    if($watersheds)
//                        $watershed=$watersheds[0];
//                    $subwatersheds = $conn->fetchAll("SELECT  * FROM subwatersheds  where id=$subwatershed_id limit 1");
//                    if($subwatersheds)
//                        $subwatershed=$subwatersheds[0];
////       $sitedescriptions=$conn->fetchAll("SELECT  * FROM site_descriptions  where station_id=$station_id");
//
//                    $sitedescriptions = $em->getRepository('YorkuJuturnaBundle:SiteDescriptions')->findBy(array('stationId' => $station_id), array(
//                        'samplingDate' => 'DESC'));
//
//                    //      $samplesbenthic=$conn->fetchAll("SELECT  * FROM benthics where station_id=$station_id");
//
//                    $samplesbenthic = $em->getRepository('YorkuJuturnaBundle:Benthics')->findBy(array('stationId' => $station_id), array('samplingDate' => 'DESC'));
//                    $waterchemistry = $em->getRepository('YorkuJuturnaBundle:WaterChemistries')->findBy(array('stationId' => $station_id), array('samplingDate' => 'DESC'));
//                }
//                }
//                return $this->render("YorkuJuturnaBundle:Admin:sitedetails.html.twig", array('id' => $id,
//                            'content_id' => $content_id,
//                            'station' => $station,
//                            'watershed' => $watershed,
//                            'subwatershed' => $subwatershed,
//                            'sitedescriptions' => $sitedescriptions,
//                            'samplesbenthic' => $samplesbenthic,
//                            'waterchemistry' => $waterchemistry));
//            }
//            if ($id == 5) {
//                
//            }
//        }
        return array();
    }

    /**
     * list  all group or school info.
     *
     * @Route("/groupschool", name="admin_groupschool")
     * @Method("GET")
     * @Template()
     */
    public function groupschoolAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('YorkuJuturnaBundle:Groupnames')->findAll();
        return array("entities" => $entities);
    }

    /**
     * show admin help in main window.
     *
     * @Route("/adminhelp", name="admin_adminhelp")
     * @Method("GET")
     * @Template()
     */
    public function adminhelpAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('YorkuJuturnaBundle:BenthicCollections')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all BenthicCollections entities.
     *
     * @Route("/systemhelp", name="admin_systemhelp")
     * @Method("GET")
     * @Template()
     */
    public function systemhelpAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('YorkuJuturnaBundle:BenthicCollections')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Displays a form to create a new Benthics entity.
     *
     * @Route("/sysmanagement", name="admin_sysmanagement")
     * @Method("GET")
     * @Template()
     */
    public function sysmanagementAction() {
//   $em = $this->getDoctrine()->getManager();
//   $entities = $em->getRepository('YorkuJuturnaBundle:Benthics')->findAll();
        //   $user=$this->get('security.context')->getToken()->getUser();
        $user = $this->container->get('security.context')->getToken()->getUser();
        return array("user" => $user);
    }

    /**
     * Displays a form to create a new Benthics entity.
     *
     * @Route("/systemparams", name="admin_systemparams")
     * @Method("GET")
     * @Template()
     */
    public function systemparamsAction() {
//   $em = $this->getDoctrine()->getManager();
//   $entities = $em->getRepository('YorkuJuturnaBundle:Benthics')->findAll();

        return array();
    }

    /**
     * Displays a form to create a new Benthics entity.
     *
     * @Route("/systembackup", name="admin_systembackup")
     * @Method("GET")
     * @Template()
     */
    public function systembackupAction() {
//   $em = $this->getDoctrine()->getManager();
//   $entities = $em->getRepository('YorkuJuturnaBundle:Benthics')->findAll();

        $databaseform = $this->createFormBuilder()
                ->add('database_folder', 'text', array('label' => '', 'data' => 'database'
                ))
                ->add('database_file', 'text', array('label' => '', 'data' => 'databasebackup_' . date('Y-m-d_H_i_s')
                ))
                ->add('database_schedule', 'checkbox', array('label' => 'Backup on Schedule:',
                ))
                ->add('database_backuptime', 'choice', array('label' => '',
                    'choices' => array('Daily' => 'Daily', 'Weekly' => 'Weekly', 'Monthly' => 'Monthly')
                ))
                ->getForm();

        $systemform = $this->createFormBuilder()
                ->add('system_folder', 'text', array('label' => '', 'data' => 'system'
                ))
                ->add('system_file', 'text', array('label' => '', 'data' => 'systembackup_' . date('Y-m-d_H_i_s')
                ))
                ->add('system_schedule', 'checkbox', array('label' => 'Backup on Schedule:',
                ))
                ->add('system_backuptime', 'choice', array('label' => '',
                    'choices' => array('Daily' => 'Daily', 'Weekly' => 'Weekly', 'Monthly' => 'Monthly')
                ))
                ->getForm();


        return array("databaseform" => $databaseform->createView(), "systemform" => $systemform->createView());
    }

    /**
     * Displays a form to create a new Benthics entity.
     *
     * @Route("/system_backup", name="admin_system_backup")
     * @Method("POST|GET")
     * @Template()
     */
    public function system_backupAction() {

//   $em = $this->getDoctrine()->getManager();
//   $entities = $em->getRepository('YorkuJuturnaBundle:Benthics')->findAll();

        return array();
    }

    /**
     * Displays a form to create a new Benthics entity.
     *
     * @Route("/database_backup", name="admin_database_backup")
     * @Method("POST")
     * @Template()
     */
    public function database_backupAction() {
//   $em = $this->getDoctrine()->getManager();
//   $entities = $em->getRepository('YorkuJuturnaBundle:Benthics')->findAll();

        return array();
    }

    private function processUploadedShapefile($conn, $data, $shapfile) {
        
    }

    // check the uploaded shapefile and if the assigned content field name exist or not
    private function isColumnExist($conn, $tablename, $columnname) {

        $sql = "SELECT column_name FROM information_schema.columns WHERE table_name=:tablename and column_name=:column_name";

        //    $sql = "SELECT st_srid(the_geom) as srid , box(the_geom) as bounds, st_astext(st_centroid(the_geom)) as the_geom FROM manifold_geoms WHERE userboundary_id=:userboundary_id  and ogc_fid=:ogc_fid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':tablename', $tablename);
        $stmt->bindParam(':column_name', $columnname); //PDO::PARAM_STR, 12);
        $stmt->execute();

//    $sql = "SELECT st_srid(the_geom) as srid , box(the_geom) as bounds, st_astext(st_centroid(the_geom)) as the_geom FROM manifold_geoms WHERE userboundary_id=" . $userboundary_id . ' and ogc_fid=' . $ogc_fid;
        $stmt_result = $stmt->fetchAll();

        $rowCount = count($stmt_result);
        if ($rowCount == 0) {
            return "Sorry,the watershed field name:" . $columnname . " is not found in shape file!";
        } else {
            return false;
        }
    }

    /*
     *   input parameter
     *  $epsg_name like EPSG:4326 or 4326
     *   $project_file line /shapfiles/testshapefile.prj
     *   return array with epsg and error variable
     */

    private function checkEPSG($epsg_name, $project_file) {
        $epsg_number = 0;
        $errors = array();
        if ($epsg_name !== null && $epsg_name !== '' && !empty($epsg_name)) {

            $conn = $this->get('database_connection');

            $epsg_name = strtoupper($epsg_name);
            $pos = strrpos($epsg_name, "EPSG:");
            if ($pos === false) {
                // EPSG number not found
                $epsg_number = intval($epsg_name);
                $sql = "select count(*) as count from spatial_ref_sys where auth_name='EPSG' and auth_srid=$epsg_number";
                $stmt = $conn->query($sql); // Simple, but has several drawbacks
                $row = $stmt->fetch();
                if ($row['count'] == 0) {
                    array_push($errors, "Defined EPSG number " . $epsg_number . " not found!");
                    $epsg_number = 0;
                    //           return array("epsg"=>$epsg_number,"error" => "Defined EPSG number not found!");
                }
            } else {
                $epsg_name = substr($epsg_name, $pos + 5);
                $epsg_number = intval($epsg_name);
                $sql = "select count(*) as count from spatial_ref_sys where auth_name='EPSG' and auth_srid=:epsg_number";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':epsg_number', $epsg_number);

                $stmt->execute();

//    $sql = "SELECT st_srid(the_geom) as srid , box(the_geom) as bounds, st_astext(st_centroid(the_geom)) as the_geom FROM manifold_geoms WHERE userboundary_id=" . $userboundary_id . ' and ogc_fid=' . $ogc_fid;
                //   $stmt_result = $stmt->fetch();
                //     $stmt = $conn->query($sql); // Simple, but has several drawbacks
                $row = $stmt->fetch();
                if ($row['count'] == 0) {

                    array_push($errors, "Defined EPSG number " . $epsg_number . " not found!");
                    $epsg_number = 0;
                    //           return array("epsg"=>$epsg_number,"error" => "Defined EPSG number not found!");
                }
            }
        }
        if ($epsg_number === 0 && ( $project_file === null || $project_file === '' || empty($project_file))) { // if user didn't input EPSG number and not upload projection file
            array_push($errors, "No projection file defined!");
            //     return array("epsg"=>$epsg_number,'error' => 'No EPSG number and projection file defined!');
        } else {

            // check if projection uploaded
            if ($epsg_number === 0 && $project_file != null) {
                $jsontext = file_get_contents($project_file);
                $i = strpos($jsontext, 'GEOGCS[');
                if ($i !== FALSE) {
                    $jsontext = substr($jsontext, $i);
                    $i = strpos($jsontext, ']],');
                    $jsontext = substr($jsontext, 0, $i + 2);

                    $sql = "select srid from spatial_ref_sys where srtext like '%" . $jsontext . "%'";

                    $stmt = $conn->fetchAll($sql); // Simple, but has several drawbacks
                    if (sizeof($stmt) == 0) {
                        array_push($errors, "EPSG number not found by projection file!");
                        //                     return array("epsg"=>$epsg_number,"error" => "EPSG number not found by projection file!");
                    } else {
                        $epsg_number = $stmt[0]['srid'];
                    }
                }
            }
            return array("epsg" => $epsg_number, "errors" => $errors);
        }
    }

}
