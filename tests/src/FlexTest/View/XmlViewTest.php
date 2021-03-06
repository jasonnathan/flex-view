<?php
namespace FlexTest\View;

use Flex\Converter\ArrayToXml;
use Flex\View\XmlView;

/**
 * Class XmlViewTest
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class XmlViewTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function test_getBody() {
        $converter = new ArrayToXml();

        $data = array('foo' => 'bar');
        $expected = $converter->convert('root', $data);

        $view = new XmlView();
        $view->setData($data);

        $this->assertEquals($expected, $view->getBody());
    }

    /**
     * @test
     */
    public function test_getResponseHeaders() {
        $view = new XmlView();

        $expected = array(
            'Content-Type' => 'text/xml'
        );

        $this->assertEquals($expected, $view->getResponseHeaders());
    }
}