<?php
namespace Marmiton\Controller;


/**
 * Class Form
 * @package Marmiton\Controller
 */
class Form
{

    /**
     * @var string Tag utilisé pour entourer les champs
     */
    public $surround = 'p';

    /**
     * @var array Données utilisées par le formulaire
     */
    private $data;

    /**
     * @param array $data Données utilisées par le formulaire
     */
    public function __construct($data = array())
    {
        $this->data = $data;
    }

    /**
     * @param $name string
     * @return string
     */
    public function inputText($title, $name)
    {
        return $this->surround('<input type="text" name="' . $name . '" value="' . $this->getValue($name) . '">');
    }

    /**
     * @param $html string Code HTML à entourer
     * @return string
     */
    protected function surround($html)
    {
        return "<{$this->surround}>$html</{$this->surround}>";
    }

    /**
     * @param $index string Index de la valeure a récuperer
     * @return string
     */
    protected function getValue($index)
    {
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    /**
     * @return string
     */
    public function submit()
    {
        return $this->surround('<button type="submit">Envoyer</button>');
    }

}
