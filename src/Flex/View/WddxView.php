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
     * @return string
     */
    public function getBody() {
        return wddx_serialize_value($this->getData());
    }

    /**
     * @return array
     */
    public function getResponseHeaders() {
        return array(
            'Content-Type' => 'text/xml'
        );
    }
}