<?php
namespace Flex\View;

/**
 * Class ViewInterface
 *
 * @package Flex\View
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
interface ViewInterface {

    /**
     * @return string
     */
    public function getBody();

    /**
     * @return array
     */
    public function getResponseHeaders();
}