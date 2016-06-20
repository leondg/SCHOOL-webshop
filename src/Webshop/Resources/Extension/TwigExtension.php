<?php
namespace Webshop\Resources\Extension;

use Twig_Extension;

class TwigExtension extends Twig_Extension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'MyTwigExtension';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('price', [$this, 'price']),
        ];
    }

    public function price($value)
    {
        if (substr($value, -2) == '00') {
            return '€ '.number_format(bcdiv($value, '100', 2), 0, ',', '.').',-';
        }
        return '€ '.number_format(bcdiv($value, '100', 2), 2, ',', '.');
    }
}