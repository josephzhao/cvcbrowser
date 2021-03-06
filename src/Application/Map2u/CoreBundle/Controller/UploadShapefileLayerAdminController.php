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
 * <summary>This file is extend of Sonata\AdminBundle\Controller\CRUDController</summary>
 * <purpose>expose of routing of Sonata\AdminBundle\Controller\CRUDController , add custom actions in this controller and override the old actions</purpose>
 */

namespace Application\Map2u\CoreBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UploadShapefileLayerAdminController extends CRUDController {

    public function createAction(Request $request = NULL) {

        // the key used to lookup the template
        $templateKey = 'edit';
        $sld_path = $this->get('kernel')->getRootDir() . '/../Data';
        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $object = $this->admin->getNewInstance();
        return $this->submitForm($object, $sld_path);

//        $this->admin->setSubject($object);
//
//        /** @var $form \Symfony\Component\Form\Form */
//        $form = $this->admin->getForm();
//        $form->setData($object);
//
//        if ($this->getRestMethod() == 'POST') {
//            $form->bind($this->get('request'));
//
//            $isFormValid = $form->isValid();
//            //   $this->addFlash('sonata_flash_success', $isFormValid);
//            // persist if the form was valid and if in preview mode the preview was approved
//            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {
//                $upload_sld_file = $form['uploadSldName']->getData();
//                if ($upload_sld_file !== null) {
//                    $upload_sld_file->move($sld_path . '/sld/' . $this->getUser()->getId(), $upload_sld_file->getClientOriginalName());
//                    $object->setDefaultSldName($this->getUser()->getId() . '/' . $upload_sld_file->getClientOriginalName());
//                }
//
//                $object->setUserId($this->getUser()->getId());
//                $this->admin->create($object);
//
//
//                if ($this->isXmlHttpRequest()) {
//                    return $this->renderJson(array(
//                                'result' => 'ok',
//                                'objectId' => $this->admin->getNormalizedIdentifier($object)
//                    ));
//                }
//
//                $this->addFlash('sonata_flash_success', 'flash_create_success');
//                // redirect to edit mode
//                return $this->redirectTo($object);
//            }
//
//            // show an error message if the form failed validation
//            if (!$isFormValid) {
//                if (!$this->isXmlHttpRequest()) {
//                    $this->addFlash('sonata_flash_error', 'flash_create_error');
//                }
//            } elseif ($this->isPreviewRequested()) {
//                // pick the preview template if the form was valid and preview was requested
//                $templateKey = 'preview';
//                $this->admin->getShow();
//            }
//        }
//
//        $view = $form->createView();
//
//        // set the theme for the current Admin Form
//        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());
//
//        return $this->render($this->admin->getTemplate($templateKey), array(
//                    'action' => 'create',
//                    'form' => $view,
//                    'object' => $object,
//        ));
    }

    public function editAction($id = NULL, Request $request = NULL) {

        $templateKey = 'edit';

        $id = $this->get('request')->get($this->admin->getIdParameter());
        $sld_path = $this->get('kernel')->getRootDir() . '/../Data';
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('EDIT', $object)) {
            throw new AccessDeniedException();
        }
        return $this->submitForm($object, $sld_path);
    }

    private function submitForm($object, $sld_path) {

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);


        if ($this->getRestMethod() == 'POST') {
            $form->bind($this->get('request'));

            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {
                $upload_sld_file = $form['uploadSldName']->getData();
                if ($upload_sld_file !== null) {
                    $upload_sld_file->move($sld_path . '/sld/' . $this->getUser()->getId(), $upload_sld_file->getClientOriginalName());
                    $object->setDefaultSldName($this->getUser()->getId() . '/' . $upload_sld_file->getClientOriginalName());
                }

                $object->setUserId($this->getUser()->getId());
                $this->admin->update($object);

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array(
                                'result' => 'ok',
                                'objectId' => $this->admin->getNormalizedIdentifier($object)
                    ));
                }
                //  $flash =$this->getFlash('no_shape_file_uploaded');
                //  if(empty($flash))
                $this->addFlash('sonata_flash_success', 'flash_edit_success');

                // redirect to edit mode
                return $this->redirectTo($object);
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash('sonata_flash_error', 'flash_edit_error');
                }
            } elseif ($this->isPreviewRequested()) {
                // enable the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
                    'action' => 'edit',
                    'form' => $view,
                    'object' => $object,
        ));
    }

}
