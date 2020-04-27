<?php
namespace InpsydeTest\Util;

use WP;

class RouteExtractor
{
    /**
     * @param WP $wp
     * @return string|null
     */
    public function getRoute(WP $wp): ?string
    {
        if (!$wp->did_permalink) {
            $route = isset($wp->query_vars['pagename']) ? $wp->query_vars['pagename'] : null;
        } else {
            $route = $wp->request;
        }
    
        $route = ltrim(parse_url($route, PHP_URL_PATH), '/');

        return $route;
    }
}
