<?php

namespace Simplex;

use Simplex\Exceptions\TemplateNotFoundException;

class Templating
{
    public function render(string $template, array $data)
    {
        $template = mb_split('::', $template);
        $module = $template[0];
        $file = $template[1];

        $template = __DIR__ . '/../' . $module . '/View/' . $file;

        try {
            if (!file_exists($template)) {
                throw new TemplateNotFoundException();
            }
        } catch (TemplateNotFoundException $e) {
            dd($e);
        }


        ob_start();

        include $template;

        return ob_get_clean();
    }
}