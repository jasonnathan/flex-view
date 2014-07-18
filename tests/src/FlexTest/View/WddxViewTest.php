<?php
namespace FlexTest\View;

use Flex\View\WddxView;

/**
 * Class WddxViewTest
 *
 * @package FlexTest\View
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class WddxViewTest extends \PHPUnit_Framework_TestCase {

    /**
     * @return void
     */
    public function test_getBody() {
        $data = array('foo' => 'bar');
        $expected = wddx_serialize_value($data);

        $view = new WddxView();
        $view->setData($data);

        $this->assertEquals($expected, $view->getBody());
    }

    /**
     * @return void
     */
    public function test_getResponseHeaders() {
        $view = new WddxView();

        $expected = array(
            'Content-Type' => 'text/xml'
        );

        $this->assertEquals($expected, $view->getResponseHeaders());
    }
}