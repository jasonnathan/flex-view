<?php
namespace Flex\View;

use Flex\View\Exception\ViewException;

/**
 * Class PhtmlView
 *
 * @package Flex\View
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class PhtmlView extends AbstractView implements ViewInterface {

    /**
     * @var string
     */
    private $basePath;

    /**
     * @var string
     */
    private $template;

    /**
     * @return string
     */
    public function getBasePath() {
        return $this->basePath;
    }

    /**
     * @param $basePath
     * @throws ViewException
     */
    public function setBasePath($basePath) {
        $this->basePath = trim($basePath);

        if(empty($this->basePath)) {
            throw new ViewException("missing base path");
        }
    }

    /**
     * @return string
     */
    public function getTemplate() {
        return $this->template;
    }

    /**
     * @param string $template
     * @throws ViewException
     */
    public function setTemplate($template) {
        $this->template = trim($template);

        if(empty($this->template)) {
            throw new ViewException("missing template");
        }
    }

    /**
     * returns the body of the view
     *
     * @return string
     * @throws ViewException
     */
    public function getBody() {
        if(is_null($this->getBasePath())) {
            throw new ViewException("missing view base path");
        }

        if(is_null($this->getTemplate())) {
            throw new ViewException("missing template");
        }

        $path = "{$this->getBasePath()}/{$this->getTemplate()}";

        if(!realpath($path)) {
            throw new ViewException("view not found: {$path}");
        }

        $data = array();

        foreach($this->getData() as $name => $value) {
            $data[$name] = $value;

            if($value instanceof PhtmlView) {
                $data[$name] = $value->getBody();
            }
        }

        extract($data, EXTR_REFS);
        ob_start();

        include $path;

        return ob_get_clean();
    }

    /**
     * returns the response headers for the view
     *
     * @return array
     */
    public function getResponseHeaders() {
        return array(
            'Content-Type' => 'text/html'
        );
    }

    /**
     * @param string $template
     * @return string
     * @throws ViewException
     */
    public function render($template) {
        $path = "{$this->getBasePath()}/{$template}";

        if(!realpath($path)) {
            throw new ViewException("view not found: {$path}");
        }

        ob_start();

        include $path;

        return ob_get_clean();
    }
}