<?php
namespace Flex\View;

/**
 * Class WddxView
 *
 * @package Flex\View
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class WddxView extends AbstractView implements ViewInterface {

    /**
     * returns the body of the view
     *
     * @return string
     */
    public function getBody() {
        return wddx_serialize_value($this->getData());
    }

    /**
     * returns the response headers for the view
     *
     * @return array
     */
    public function getResponseHeaders() {
        return array(
            'Content-Type' => 'text/xml'
        );
    }
}