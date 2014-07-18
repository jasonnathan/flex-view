<?php
namespace Flex\View;

/**
 * Class JsonView
 *
 * @package Flex\View
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class JsonView extends AbstractView implements ViewInterface {

    /**
     * @return string
     */
    public function getBody() {
        return json_encode($this->getData());
    }

    /**
     * @return array
     */
    public function getResponseHeaders() {
        return array(
            'Content-Type' => 'application/json'
        );
    }
}