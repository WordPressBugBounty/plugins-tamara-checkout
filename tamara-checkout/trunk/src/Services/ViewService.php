<?php


namespace Tamara\Wp\Plugin\Services;


use Tamara\Wp\Plugin\Traits\ConfigTrait;
use Tamara\Wp\Plugin\Traits\ServiceTrait;

class ViewService
{
    use ConfigTrait;
    use ServiceTrait;

    public $basePath;
    public $baseUrl;

    /**
     * @inheritDoc
     */
    public function init()
    {
        $this->basePath = $this->getContainer()->basePath;
        $this->baseUrl  = $this->getContainer()->baseUrl;
    }

    /**
     * @param $viewFilePath
     * @param array $params
     *
     * @return string|void|null
     */
    public function render($viewFilePath, $params = [])
    {
        global $wp_query;

        $extension = '.php';
        // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
        $wp_query->query_vars['viewParams'] = $params;

        if (strpos($viewFilePath, '/') === 1) {
            $templateFile = $viewFilePath.$extension;
        } else {
            $templateFile = locate_template($viewFilePath.$extension, false, false);
            if (empty($templateFile) && file_exists($this->basePath.DIRECTORY_SEPARATOR.$viewFilePath.$extension)) {
                $templateFile = $this->basePath.DIRECTORY_SEPARATOR.$viewFilePath.$extension;
            }
        }

        if (!empty($templateFile)) {
            ob_start();
            load_template($templateFile, false);
            $renderedContent = ob_get_clean();

            return is_string($renderedContent) ? $renderedContent : '';
        }

        $errorMessage = sprintf(
            "View file not working: %s.\nTrace: %s",
            $viewFilePath.$extension,
            print_r(debug_backtrace(), true)
        );
        // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
        trigger_error($errorMessage, E_USER_WARNING);

        return '';
    }
}
