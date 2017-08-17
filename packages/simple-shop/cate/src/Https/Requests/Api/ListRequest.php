<?php

namespace SimpleShop\Cate\Https\Requests\Api;


use SimpleShop\Cate\Https\Requests\Request;

class ListRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * @return array
     */
    public function getParams()
    {
        $params = $this->route()->parameters();

        if (! isset($params['order'])) {
            $params['order'] = 'id';
        }

        if (! isset($params['sort'])) {
            $params['sort'] = 'desc';
        }

        return $params;
    }
}
