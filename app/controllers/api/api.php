<?php

class API extends BaseController
{
    public function _api()
    {
        echo $this->template->render('templates/webapp', '@todo');
    }

    public function docs()
    {
        $view = new View();

        $api_path = '../api/codebase/paco';
        $class_data = array();

        // here we're going to use reflection to extract as much information about the API as we can
        if ($handle = opendir($api_path . '/classes'))
        {
                include_once($api_path . '/paco-api.inc');

                $classes = array();
                while (false !== ($file = readdir($handle)))
                {
                        if ($file != "." && $file != ".." && substr_Count($file, '~') == 0)
                        {
                                // test to see if this is a API file (will have a filename along the lines of paco.CLASSNAME.php
                                preg_match("/paco\.([a-z\.]+)\.php$/", $file, $matches);
                                if (isset($matches[1]))
                                {
                                        $class = $matches[1];
                                        array_push($classes, $class);

                                        //load file
                                        include_once($api_path . '/classes/' . $file);
                                }
                        }
                }
                // sort classes
                asort($classes);
                //
                closedir($handle);

                if (sizeof($classes) > 0)
                {
                        foreach($classes as $class)
                        {
                                $derived_class = 'Paco' . ucwords($class);
                                if (class_exists($derived_class))
                                {
                                        $r = new ReflectionClass($derived_class);
                                        $comment = $r->getDocComment();
                                        if (strpos($comment, '[WebClass]') > 0)
                                        {
                                                // extract the document comments
                                                preg_match("/\\* (.*)/", $comment, $comment_parts);

                                                // we have a class exposed to the api
                                                $class_data[$class] = array
                                                (
                                                        'name'=>$class,
                                                        'description'=>$comment_parts[1],
                                                        'methods'=>array()

                                                );

                                                $methods = $r->getMethods();
                                                foreach($methods as $method)
                                                {
                                                        $m = $method->getDocComment();

                                                        // make sure this method is exposed
                                                        if (strpos($m, '[WebMethod]') > 0)
                                                        {
                                                                $method_description = $method->getDocComment();
                                                                // extract the document comments
                                                                preg_match("/\\* (.*)/", $method_description, $method_comment_parts);

                                                                if (isset($method_comment_parts[1]))
                                                                {
                                                                        $method_desc = $method_comment_parts[1];
                                                                } else {$method_desc = 'No description';}

                                                                $p = array();
                                                                $params = $method->getParameters();

                                                                foreach($params as $param)
                                                                {
                                                                        // get the comment specific for this argument (ensure we escape the dollar ;))
                                                                        preg_match("/@param (string|int|array)? \\$" . $param->getName() . "(.*)/", $method_description, $param_comments);

                                                                        $description = "";
                                                                        $type = "Unknown";

                                                                        if (isset($param_comments[1]))
                                                                        {
                                                                                $type = $param_comments[1];
                                                                        }

                                                                        if (isset($param_comments[2]))
                                                                        {
                                                                                $description = $param_comments[2];
                                                                        }
                                                                        if (empty($description))
                                                                        {
                                                                                $description = null;
                                                                        }
                                                                        $p[] = array(
                                                                                'name'=>$param->getName(),
                                                                                'type'=>$type,
                                                                                'optional'=>$param->isOptional(),
                                                                                'description'=>$description
                                                                        );
                                                                }

                                                                $class_data[$class]['methods'][] = array
                                                                        (
                                                                                'name'=>$method->getName(),
                                                                                'description'=>$method_desc,
                                                                                'params'=>$p
                                                                        );
                                                        }
                                                }
                                        }
                                }
                                else
                                {
                                        echo $derived_class;
                                }

                        }
                        $view->bind('classes', $class_data);
                }
        }
        echo $this->template->render('templates/webapp', $view->render('api/docs'));
    }
}
?>