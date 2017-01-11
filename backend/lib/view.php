<?php
class View {
    // Array of vars to be set.
    protected $vars = array();
    protected $tpls = array();

    public function __construct()
    {
        $this->addTemplate('header');
    }

    public function set($name, $value)
    {
        $this->vars[$name] = $value;
        return $this;
    }

    public function addTemplate($template)
    {
        $this->tpls[] = $template;
        return $this;
    }

    public function render()
    {
        extract($this->vars);
        $this->addTemplate('footer');
        
        foreach ($this->tpls as $tpl) {
            require_once(getcwd() . "/frontend/view/{$tpl}.php");
        }
        exit();
    }

    public function renderError($errorMessage)
    {
        // Only header tpl will remain.
        $this->tpls = array(array_shift($this->tpls));
        $this->vars['errorMessage'] = $errorMessage;
        $this->addTemplate('error');
        $this->render();
    }
}