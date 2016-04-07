<?php

namespace Rig\Control;

/**
 * Class Controller
 * Base controller class
 * @package FW
 */
abstract class Controller implements \Rig\HTTP\HTTPAware
{
    /**
     * @var \Rig\HTTP\Request
     */
    protected $request;
    /**
     * @var \Rig\HTTP\Response
     */
    protected $response;
    protected $session;
    protected $config;
    protected $permissions;

    public $method;
    public $uri;
    public $params;
    /**
     * @var \Rig\Track\Router
     */
    public $router;

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }

    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function setResponse($response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function setRouter($router)
    {
        $this->router = $router;
    }

    public function get($param = null)
    {
        if ($param === null) {
            return $this->getRequest()->getAllParameters();
        }
        return $this->getRequest()->get($param);
    }

    public function addJsonHeader()
    {
        $this->response->addHeader('Content-type', 'application/json');
    }

    public function json($output, $meta = null)
    {
        $this->addJsonHeader();
        $result = array('result' => $output);
        if ($meta !== null) {
            $result['meta'] = $meta;
        }
        return json_encode($result);
    }

    public function rawJson($output)
    {
        $this->addJsonHeader();
        return json_encode($output);
    }

    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }
}
