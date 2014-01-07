<?php
if (K2_JVERSION == '15')
{
    jimport('joomla.html.parameter.element');
    class JMElement extends JElement
    {
    }

}
else
{
    jimport('joomla.form.formfield');
    class JMElement extends JFormField
    {

        function getInput()
        {
            return $this->fetchElement($this->name, $this->value, $this->element, $this->options['control']);
        }

        function getLabel()
        {
            if (method_exists($this, 'fetchTooltip'))
            {
                return $this->fetchTooltip($this->element['label'], $this->description, $this->element, $this->options['control'], $this->element['name'] = '');
            }
            else
            {
                return parent::getLabel();
            }

        }

        function render()
        {
            return $this->getInput();
        }

    }

}
?>