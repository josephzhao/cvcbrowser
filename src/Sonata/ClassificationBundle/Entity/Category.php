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
 * <summary>This is the extend of Sonata\ClassificationBundle\Entity\BaseCategory entity</summary>
 * <purpose>for entity extend based on Sonata\ClassificationBundle\Entity\BaseCategory</purpose>
 */

namespace Application\Sonata\ClassificationBundle\Entity;

use Sonata\ClassificationBundle\Entity\BaseCategory as BaseCategory;

/**
 * This file has been generated by the Sonata EasyExtends bundle ( http://sonata-project.org/bundles/easy-extends )
 *
 * References :
 *   working with object : http://www.doctrine-project.org/projects/orm/2.0/docs/reference/working-with-objects/en
 *
 * @author <yourname> <youremail>
 */
class Category extends BaseCategory {

    /**
     * @var integer $id
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $graphcharts;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */

    /**
     * Constructor
     */
    public function __construct() {
        $this->graphcharts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add graphcharts
     *
     * @param \Yorku\JuturnaBundle\Entity\GraphChart $graphcharts
     * @return Category
     */
    public function addGraphchart(\Yorku\JuturnaBundle\Entity\GraphChart $graphcharts) {
        $this->graphcharts[] = $graphcharts;

        return $this;
    }

    /**
     * Remove graphcharts
     *
     * @param \Yorku\JuturnaBundle\Entity\GraphChart $graphcharts
     */
    public function removeGraphchart(\Yorku\JuturnaBundle\Entity\GraphChart $graphcharts) {
        $this->graphcharts->removeElement($graphcharts);
    }

    /**
     * Get graphcharts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGraphcharts() {
        return $this->graphcharts;
    }

}