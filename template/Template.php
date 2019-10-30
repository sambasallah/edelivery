<?php

namespace edelivery\template;

class Template
{
    // Template path
    protected $template_path;

    // To store variables
    protected $vars = array();

    public function __construct($path)
    {
        $this->template_path = $path;
    }

    // Get variables
    public function __get($key)
    {
        return $this->vars[$key];
    }

    // Set variables
    public function __set($key,$value)
    {
        $this->vars[$key] = $value;
    }

    // Print template
    public function __toString()
    {
        extract($this->vars);
        chdir(dirname($this->template_path));
        ob_start();
        include basename($this->template_path);
        return ob_get_clean();
    }
}