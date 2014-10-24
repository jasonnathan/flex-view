<?php
namespace FlexTest\View;

use Flex\View\AbstractView;

/**
 * Class AbstractViewTest
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class AbstractViewTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var AbstractView
     */
    private $view;

    /**
     * @return void
     */
    public function setUp() {
        $this->view = $this->getMockBuilder('Flex\View\AbstractView')->getMockForAbstractClass();
    }

    /**
     * @return void
     */
    public function tearDown() {
        $this->view = null;
    }

    /**
     * @test
     */
    public function test_setData() {
        $expected = array('foo' => 'bar');
        $this->view->setData($expected);

        $this->assertEquals($expected, $this->view->getData());
    }

    /**
     * @test
     */
    public function test_setPropertyMagic() {
        $expected = uniqid();
        $this->view->title = $expected;

        $this->assertEquals($expected, $this->view->title);
        $this->assertNull($this->view->name);
    }

    /**
     * @test
     */
    public function test_setProperty() {
        $expected = uniqid();
        $this->view->set('title', $expected);

        $this->assertEquals($expected, $this->view->get('title'));
        $this->assertNull($this->view->get('name'));
    }
}