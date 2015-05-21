<?php

namespace Yorku\JuturnaBundle\Admin;

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
 * <date>created at 2014/11/04</date>
 * <date>last updated at 2015/03/15</date>
 * <summary>This file Homepage Images administration form type</summary>
 */

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class HomepageImageAdmin extends Admin {

    private $container = null;

    public function __construct($code, $class, $baseControllerName, $container = null) {
        parent::__construct($code, $class, $baseControllerName);
        $this->container = $container;
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('id')
                ->add('title')
                ->add('image')
                ->add('introduce')
                ->add('url')
                ->add('published')
                ->add('active')
                ->add('createdAt')
                ->add('updatedAt')
                ->add('description')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('id')
                ->add('title')
                ->add('category')
                ->add('image')
                ->add('introduce')
                ->add('url')
                ->add('published')
                ->add('active')
                ->add('createdAt')
                ->add('updatedAt')
                ->add('description')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'show' => array(),
                        'edit' => array(),
                        'delete' => array(),
                    )
                ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->with('Homepage Image', array('class' => 'col-md-6'))
                ->add('id', 'hidden')
                ->add('title')
                ->add('category', 'entity', array('label' => 'Category',
                    'required' => true,
                    'expanded' => false,
                    'class' => 'Yorku\JuturnaBundle\Entity\Category',
                    'property' => 'name',
                    'multiple' => false
                ))
                ->add('image_file', 'file', array('label' => 'Image Files:', 'mapped' => false, 'required' => false))
                ->add('introduce', 'ckeditor', array('label' => 'Introduce', 'required' => false,
                    'config_name' => 'basic',
                    'config' => array('uiColor' => '#ffffff')
                ))
                ->add('url')
                ->add('published')
                ->add('active')
                ->end()
                ->with('Homepage Image Description', array('class' => 'col-md-6'))
                ->add('description', 'ckeditor', array('label' => 'Description Content', 'required' => false,
                    'config_name' => 'forums',
                    'config' => array('uiColor' => '#ffffff')
                ))
                ->end()

        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                ->add('id')
                ->add('title')
                ->add('category')
                ->add('image')
                ->add('introduce')
                ->add('url')
                ->add('published')
                ->add('active')
                ->add('createdAt')
                ->add('updatedAt')
                ->add('description')
        ;
    }

}
