<?php

namespace App\Helpers;

use Illuminate\Contracts\Config\Repository as Config;

class SeoHelper
{

    private $config;
    private $urlTools;

    /**
     * @param Config $config
     * @param UrlHelper $urlHelper
     */
    public function __construct(
        Config $config,
        UrlHelper $urlHelper
    )
    {
        $this->config = $config;
        $this->urlTools = $urlHelper;
    }

    /**
     * Sets meta tag for provided item (blog post or page)
     *
     * @param array $item
     *
     * @return array
     */
    public function getMetaTags($item)
    {

        // Setting up default values from ENV configuration file
        $meta = [
            'author' => $this->config->get('app.meta_author'),
            'description' => $this->config->get('app.meta_description'),
            'keywords' => $this->config->get('app.meta_keywords'),
            'title' => $this->config->get('app.meta_title'),
        ];

        // Set author only if it's set (pages has no author) and not empty
        if (isset($item['author'])) {
            if (!empty($item['author'])) {
                $meta['author'] = $item['author']['first_name'] . ' ' . $item['author']['last_name'];
            }
        }

        // Override default meta title <title> only if it's not empty
        if (!empty($item['meta_title'])) {
            $meta['title'] = $item['meta_title'];
        } else {
            $meta['title'] = $item['title'];
        }

        // Override default meta description only if it's not empty
        if (!empty($item['meta_description'])) {
            $meta['description'] = $item['meta_description'];
        } else {
            if (isset($item['intro_text'])) {
                $meta['description'] = substr(strip_tags($item['intro_text']), 0, 200) . '...';
            }
        }

        // Override default meta keywords only if it's not empty
        if (isset($item['meta_keywords'])) {
            $meta['keywords'] = $item['meta_keywords'];
        }

        return $meta;
    }

    /**
     * Creates nice url from given string
     *
     * @param $input
     * @return mixed|string
     */
    public function createNiceUrl($input)
    {
        return $this->urlTools->createUrlFromString($input);
    }
}
