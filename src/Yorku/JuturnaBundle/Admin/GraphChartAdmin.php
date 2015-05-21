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
 * <summary>This file Graphchart administration form type</summary>
 */
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class GraphChartAdmin extends Admin {

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('id')
                ->add('citation')
                ->add('citationLink')
                ->add('graphchartName')
                ->add('graphchartTitle')
                ->add('graphchartImages')
                ->add('categories')
                ->add('tags')
                ->add('description')
                ->add('createdAt')
                ->add('updatedAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('id')
                ->add('citation')
                ->add('citationLink')
                ->add('graphchartName')
                ->add('graphchartTitle')
                ->add('graphchartImages')
                ->add('tags')
                ->add('description')
                ->add('createdAt')
                ->add('updatedAt')
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
                ->with('Graph and Chart', array('class' => 'col-md-6'))
                ->add('id', 'hidden')
                ->add('graphchartName')
                ->add('graphchartTitle')
                ->add('citation')
                ->add('citationLink')
                ->add('categories', 'entity', array('label' => 'Category',
                    'required' => false,
                    'expanded' => false,
                    'class' => 'Yorku\JuturnaBundle\Entity\Category',
                    'property' => 'name',
                    'multiple' => true
                ))
                ->add('graphchartImages_file', 'file', array('required' => false, 'mapped' => false, 'attr' => array('multiple' => true, 'accept' => 'image/*')))
                ->end()
                ->with(' ', array('class' => 'col-md-6'))
                ->add('tags')
                ->add('description')
                ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                ->add('id')
                ->add('citation')
                ->add('citationLink')
                ->add('graphchartName')
                ->add('graphchartTitle')
                ->add('graphchartImages')
                ->add('categories')
                ->add('tags')
                ->add('description')
                ->add('createdAt')
                ->add('updatedAt')
        ;
    }

}
