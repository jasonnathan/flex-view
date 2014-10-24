<?php
namespace FlexTest\View;

use Flex\View\PhtmlView;

/**
 * Class PhtmlViewTest
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class PhtmlViewTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var PhtmlView
     */
    private $view;

    /**
     * @return void
     */
    public function setUp() {
        $this->view = new PhtmlView();
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
    public function test_setBasePath() {
        $expexted = 'foo/bar/baz';
        $this->view->setBasePath($expexted);
        $this->assertEquals($expexted, $this->view->getBasePath());
    }

    /**
     * @test
     * @expectedException \Flex\View\Exception\ViewException
     * @expectedExceptionMessage missing base path
     */
    public function test_setBasePathEmpty() {
        $this->view->setBasePath('  ');
    }

    /**
     * @test
     */
    public function test_setTemplate() {
        $expexted = 'template';
        $this->view->setTemplate($expexted);
        $this->assertEquals($expexted, $this->view->getTemplate());
    }

    /**
     * @test
     * @expectedException \Flex\View\Exception\ViewException
     * @expectedExceptionMessage missing template
     */
    public function test_setTemplateEmpty() {
        $this->view->setTemplate('  ');
    }

    /**
     * @test
     * @expectedException \Flex\View\Exception\ViewException
     * @expectedExceptionMessage missing view base path
     */
    public function test_getBodyInvalidBasePath() {
        $this->view->getBody();
    }

    /**
     * @test
     * @expectedException \Flex\View\Exception\ViewException
     * @expectedExceptionMessage missing template
     */
    public function test_getBodyInvalidTemplate() {
        $this->view->setBasePath('tests/resources');
        $this->view->getBody();
    }

    /**
     * @test
     * @expectedException \Flex\View\Exception\ViewException
     */
    public function test_getBodyInvalidView() {
        $this->view->setBasePath('tests/resources');
        $this->view->setTemplate('views/script-not-found.phtml');
        $this->view->getBody();
    }

    /**
     * @test
     */
    public function test_getBody() {
        $this->view->setBasePath('tests/resources');
        $this->view->setTemplate('views/unit-testing/profile-settings.phtml');
        $this->view->name = 'foo';
        $this->assertEquals('<h2>user profile</h2><h3>foo</h3>', $this->view->getBody());
    }

    /**
     * @test
     */
    public function test_getBodyLayout() {
        $layout = new PhtmlView();
        $layout->setBasePath('tests/resources');
        $layout->setTemplate('layouts/unit-testing.phtml');

        $view = new PhtmlView();
        $view->setBasePath('tests/resources');
        $view->setTemplate('views/unit-testing/profile-settings.phtml');
        $view->name = 'foo';

        $layout->content = $view;
        $this->assertEquals('<h1>unit test layout</h1><h2>user profile</h2><h3>foo</h3>', $layout->getBody());
    }

    /**
     * @test
     */
    public function test_getResponseHeaders() {
        $expected = array(
            'Content-Type' => 'text/html'
        );

        $this->assertEquals($expected, $this->view->getResponseHeaders());
    }

    /**
     * @test
     */
    public function test_render() {
        $layout = new PhtmlView();
        $layout->setBasePath('tests/resources');
        $layout->setTemplate('layouts/unit-testing.phtml');

        $this->assertEquals('<h2>navigation</h2>', (string) $layout->render('views/unit-testing/navigation.phtml'));
    }

    /**
     * @test
     * @expectedException \Flex\View\Exception\ViewException
     */
    public function test_renderInvalid() {
        $layout = new PhtmlView();
        $layout->setBasePath('tests/resources');
        $layout->setTemplate('layouts/unit-testing.phtml');

        $layout->render('views/unit-testing/script-not-found.phtml');
    }
}