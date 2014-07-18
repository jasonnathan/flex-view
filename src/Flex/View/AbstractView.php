<?php
namespace Flex\View;

/**
 * Class AbstractView
 *
 * @package Flex\View
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
abstract class AbstractView implements ViewInterface {

    /**
     * @var mixed
     */
    private $data;

    /**
     * @return array
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data = array()) {
        $this->data = is_array($this->data) ? $this->data : array();
        $this->data = array_merge($this->data, $data);
    }

    /**
     * @param string $property
     * @return mixed
     */
    public function get($property) {
        $this->data = is_array($this->data) ? $this->data : array();

        if(!array_key_exists($property, $this->data)) {
            return null;
        }

        return $this->data[$property];
    }

    /**
     * @param string $property
     * @param mixed $value
     */
    public function set($property, $value) {
        $this->data = is_array($this->data) ? $this->data : array();
        $this->data[$property] = $value;
    }

    /**
     * @param string $property
     * @return mixed
     */
    public function __get($property) {
        return $this->get($property);
    }

    /**
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value) {
        $this->set($property, $value);
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->getBody();
    }
}