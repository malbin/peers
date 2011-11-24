<?php

class PagesController extends AppController {

    var $name = 'Pages';
    var $uses = array();

    function display() {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            $this->redirect('/');
        }
        $page = $subpage = $title_for_layout = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        if (!empty($path[$count - 1])) {
            $title_for_layout = Inflector::humanize($path[$count - 1]);
        }
        $this->set(compact('page', 'subpage', 'title_for_layout'));

        $page = Inflector::slug($page);
        if (method_exists($this, $page)) {
            $this->$page();
        }
        
        $this->layout = 'page';
        $this->render(implode('/', $path));
    }

}