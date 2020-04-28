<?php
namespace InpsydeTest\Util;

class TemplateLoader
{
    /**
     * @param string $file
     * @return string|null
     */
    public function load(string $file, array $data = []): ?string
    {
        $output = null;

        extract($data);
        
        if (file_exists($file)) {
            ob_start();
            require_once($file);
            $output = ob_get_contents();
            ob_end_clean();
        }

        return $output;
    }
}
