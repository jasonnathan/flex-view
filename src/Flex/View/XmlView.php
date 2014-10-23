<?php
namespace Flex\View;

use Flex\Converter\ArrayToXml;

/**
 * Class XmlView
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class XmlView extends AbstractView implements ViewInterface {

    /**
     * @return string
     */
    public function getBody() {
        $converter = new ArrayToXml();

        return $converter->convert('root', $this->getData());
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