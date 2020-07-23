<?php

namespace App\Helpers\Responses;

trait HttpResponse
{
    public $links;
    public $http_status;
    public $response_code;
    public $response_title;
    public $response_detail;
    public $response_data;

    public function get(): array
    {
        return [
            'links'  => $this->links,
            'status' => $this->http_status,
            'code'   => $this->response_code,
            'title'  => $this->response_title,
            'detail' => $this->response_detail,
            'data'   => $this->response_data,
        ];
    }

    public function link($link = '')
    {
        $this->links[] = $link;

        return $this;
    }

    public function status($http_code = '')
    {
        $this->http_status = $http_code;

        return $this;
    }

    public function code($code = '')
    {
        $this->response_code = $code;

        return $this;
    }

    public function title($title = '')
    {
        $this->response_title = $title;

        return $this;
    }

    public function detail($detail = '')
    {
        $this->response_detail = $detail;

        return $this;
    }

    public function data($data = [])
    {
        $this->response_data = $data;

        return $this;
    }
}
