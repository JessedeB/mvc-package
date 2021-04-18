<?php

namespace App\Core;

class Router {

    protected array $routes = [];
    public Response $response;
    private Request $request;

    /**
     * Router constructor.
     * @param Response $response
     * @param Request $request
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param $path
     * @param $callback
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * @param $path
     * @param $callback
     */
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * @return mixed|string|string[]
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false) {
            $this->response->setStatusCode(404);
            return "Not found";
        }

        if(is_string($callback)) {
            return $this->renderView($callback);
        }

        return gettype($callback);
//       return call_user_func($callback);
    }

    /**
     * @param $view
     * @return string|string[]
     */
    public function renderView($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {

        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/app.php";
        return ob_get_clean();
    }

    /**
     * @param $view
     * @return false|string
     */
    protected function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }

}