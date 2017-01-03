<?php
namespace Marmiton\Controller;

/**
 *
 * Permet de générer un formulaire Bootstrap rapidement et simplement
 *
 * Class bootstrapForm
 * @package Marmiton\Controller
 */
class bootstrapForm extends Form
{
    /**
     * @param $title
     * @param string $name
     * @return string
     */
    public function inputText($title, $name)
    {
        return
            $this->surround(
                '<label>' . $title . '</label>
            <input type="text" class="form-control" name="' . $name . '" required>'
            );
    }

    /**
     * @param $name
     * @param $size
     * @return string
     */
    public function inputSizedText($title, $name, $size)
    {
        return
            $this->surroundSized(
                '<label>' . $title . '</label>
            <input type="text" class="form-control" maxlength="20" name="' . $name . '" required>', $size
            );
    }

    /**
     * @param $title
     * @param $name
     * @param $size
     * @return string
     */
    public function inputSizedTime($title, $name, $size)
    {
        return
            $this->surroundSized(
                '<label>' . $title . '</label>
            <input type="text" class="form-control time" name="' . $name . '" placeholder="Minutes" maxlength="3" required>', $size
            );
    }


    /**
     * @param $title
     * @param $name
     * @return string
     */
    public function inputMail($title, $name)
    {
        return
            $this->surround(
                '<label>' . $title . '</label>
            <input type="email" class="form-control" name="' . $name . '" required>'
            );
    }

    /**
     * @param $title
     * @param $name
     * @param $size
     * @return string
     */
    public function inputSizedMail($title, $name, $size)
    {
        return
            $this->surroundSized(
                '<label>' . $title . '</label>
            <input type="email" class="form-control" name="' . $name . '" required>', $size
            );
    }

    /**
     * @param $name
     * @param $rows
     * @return string
     */
    public function inputTextarea($title, $name, $rows)
    {
        return
            $this->surround(
                '<label>' . $title . '</label>
            <textarea class="form-control" name="' . $name . '" rows="' . $rows . '" required></textarea>'
            );
    }

    /**
     * @param $name
     * @param $rows
     * @param $size
     * @return string
     */
    public function inputSizedTextarea($title, $name, $rows, $size)
    {
        return
            $this->surroundSized(
                '<label>' . $title . '</label>
            <textarea class="form-control" name="' . $name . '" rows="' . $rows . '" required></textarea>', $size
            );
    }

    /**
     * @param $name
     * @param $size
     * @param array $tab
     * @return string
     */
    public function selectSized($title, $name, $size, $tab = array())
    {
        $id = 1;
        $html = '<label>' . $title . '</label><select name="' . $name . '" class="form-control" required>';
        foreach ($tab as $tabs) {
            $html .= '<option value="' . $id . '">' . $tabs . '</option>';
            $id++;
        }
        $html .= '</select>';
        return $this->surroundSized($html, $size);
    }

    /**
     * @param $title
     * @param $name
     * @param $size
     * @return string
     */
    public function inputSizedFile($title, $name, $size)
    {
        return
            $this->surroundSized(
                '<label>' . $title . '</label>
            <input type="file" name="' . $name . '">', $size
            );
    }

    /**
     * @param $name
     * @return string
     */
    public function inputPassword($title, $name)
    {
        return
            $this->surround(
                '<label>' . $title . '</label>
            <input type="password" class="form-control" maxlength="30" name="' . $name . '">'
            );
    }

    /**
     * @param $name
     * @param $size
     * @return string
     */
    public function inputSizedPassword($title, $name, $size)
    {
        return
            $this->surroundSized(
                '<label>' . $title . '</label>
            <input type="password" class="form-control" maxlength="30" name="' . $name . '">', $size
            );
    }

    /**
     * @return string
     */
    public function submit()
    {
        return $this->surround('<button type="submit" class="btn btn-primary orange darken-3">Envoyer</button>');
    }

    /**
     * @param $title
     * @param $name
     * @param $value
     * @param $size
     * @return string
     */
    public function buttonInfo($title, $name, $value, $size)
    {
        return $this->surroundSized(
            '<label>' . $title . '</label>
            <button type="button" class="btn btn-info orange darken-3" name="' . $name . '">' . $value . '</button>', $size
        );
    }

    /**
     * @param $title
     * @param $name
     * @param $value
     * @param $size
     * @return string
     */
    public function buttonDanger($title, $name, $value, $size)
    {
        return $this->surroundSized(
            '<label>' . $title . '</label>
            <button type="button" class="btn btn-danger orange darken-3" name="' . $name . '">' . $value . '</button>', $size
        );
    }

    /**
     * @param $name
     * @param $size
     * @return string
     */
    public function inputSizedTextInTabQuantite($title, $name, $size)
    {
        return
            $this->surroundSized(
                '<label>' . $title . '</label>
            <input type="text" class="form-control quantite" maxlength="3" name="' . $name . '[]">', $size
            );
    }

    /**
     * @param $name
     * @param $size
     * @return string
     */
    public function inputSizedTextInTab($title, $name, $size)
    {
        return
            $this->surroundSized(
                '<label>' . $title . '</label>
            <input type="text" class="form-control" name="' . $name . '[]">', $size
            );
    }

    /**
     * @param $name
     * @param $size
     * @return string
     */
    public function inputSizedTextInTabRequired($title, $name, $size)
    {
        return
            $this->surroundSized(
                '<label>' . $title . '</label>
            <input type="text" class="form-control" name="' . $name . '[]" maxlength="30" required>', $size
            );
    }

    /**
     * @param $title
     * @param $name
     * @param $size
     * @param array $tab
     * @return string
     */
    public function selectSizedInTab($title, $name, $size, $tab = array())
    {
        $id = 1;
        $html = '<label>' . $title . '</label><select name="' . $name . '[]" class="form-control">';
        foreach ($tab as $tabs) {
            $html .= '<option value="' . $id . '">' . $tabs . '</option>';
            $id++;
        }
        $html .= '</select>';
        return $this->surroundSized($html, $size);
    }

    /**
     * @param $html string Code HTML à entourer
     * @return string
     */
    protected function surround($html)
    {
        return "<div class=\"form-group\">{$html}</div>";
    }

    /**
     * @param $html
     * @param $size
     * @return string
     */
    protected function surroundSized($html, $size)
    {
        return "<div class=\"form-group col-sm-" . $size . "\">{$html}</div>";
    }

    /**
     * @param $html
     * @return string
     */
    protected function surroundSelect($html)
    {
        return "<select class=\"form-control\">{$html}</select>";
    }

}