<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class FilterBlackListedExtension extends AbstractExtension
{
    private $blacklistedTags = ['script', 'p'];

    public function getFilters()
    {
        return array(
            new TwigFilter('filter_black_listed', array($this, 'htmlFilter')),
        );
    }

    public function htmlFilter($html)
    {
        foreach ($this->blacklistedTags as $tag) {

            preg_replace('/(<' . $tag . '>)(.*)(<\/' . $tag . '>)/', '', $html);
        }

        return $html; // maybe even apply the raw filter also afterwards.
    }

    public function getName()
    {
        return 'filter_black_listed_extension';
    }
}