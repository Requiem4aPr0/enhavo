<?php
/**
 * Slider.php
 *
 * @since 15/10/14
 * @author Gerhard Seidel <gseidel.message@googlemail.com>
 */

namespace esperanto\ProjectBundle\Entity;

use esperanto\SliderBundle\Entity\Slider as BaseSlider;
use esperanto\ProjectBundle\Entity\Slide;

class Slider extends BaseSlider
{

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $slides;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->slides = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add slides
     *
     * @param \esperanto\ProjectBundle\Entity\Slide $slides
     * @return Slider
     */
    public function addSlide(\esperanto\ProjectBundle\Entity\Slide $slides)
    {
        $this->slides[] = $slides;

        return $this;
    }

    /**
     * Remove slides
     *
     * @param \esperanto\ProjectBundle\Entity\Slide $slides
     */
    public function removeSlide(\esperanto\ProjectBundle\Entity\Slide $slides)
    {
        $this->slides->removeElement($slides);
    }

    /**
     * Get slides
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSlides()
    {
        return $this->slides;
    }
}