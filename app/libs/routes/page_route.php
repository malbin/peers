<?php
class PageRoute extends CakeRoute {

    function parse($url) {
        $params = parent::parse($url);
        if (empty($params)) {
            return false;
        }
        $file = APP . 'views' . DS . 'pages' . DS . $params['_args_'] . '.ctp';
        if (file_exists($file)) {
            return $params;
        }
        return false;
    }

}
