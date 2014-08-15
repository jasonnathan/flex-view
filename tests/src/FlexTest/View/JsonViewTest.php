<?php
namespace FlexTest\View;

use Flex\View\JsonView;

/**
 * Class JsonViewTest
 *
 * @package FlexTest\View
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class JsonViewTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function getBody() {
        $data = array('foo' => 'bar');
        $expected = json_encode($data);

        $view = new JsonView();
        $view->setData($data);

        $this->assertEquals($expected, $view->getBody());
    }

    /**
     * @test
     */
    public function getResponseHeaders() {
        $view = new JsonView();

        $expected = array(
            'Content-Type' => 'application/json'
        );

        $this->assertEquals($expected, $view->getResponseHeaders());
    }
}