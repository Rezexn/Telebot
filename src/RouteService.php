<?php

namespace Rezexn\Telebot;

abstract class RouteService extends Methods
{
    abstract protected function message();
    abstract protected function callbackQuery();
    abstract protected function first();
    abstract protected function last();

    protected $data = [];
    protected $routes = [];

    function __construct($token)
    {
        $this->token = $token;

        $update = json_decode(file_get_contents('php://input'));
        if (isset($update->message)) {
            $this->data = $update->message;
            $this->data->type = 'message';
            $this->first();
            $this->message();
            $this->run($this->data->text ?? '');
        } elseif (isset($update->callback_query)) {
            $this->data = $update->callback_query->message;
            $this->data->id = $update->callback_query->id;
            $this->data->data = $update->callback_query->data;
            $this->data->from = $update->callback_query->from;
            $this->data->type = 'callback_query';
            $this->first();
            $this->callbackQuery();
            $this->run($this->data->data);
        }

        $this->last();
    }

    public function add($callback, $expression, $compare = true)
    {
        $this->routes[] = [
            'callback' => $callback,
            'expression' => $expression,
            'compare' => $compare
        ];
    }

    public function run($path)
    {
        foreach ($this->routes as $route) {
            if ($route['compare'] && ($route['expression'] === true || preg_match(sprintf('#^%s$#', $route['expression']), $path, $matches))) {
                if ($route['expression'] === true || is_null($matches))
                    $matches = [];
                array_shift($matches);
                return call_user_func_array([$this, $route['callback']], $matches);
            }
        }
    }
}
