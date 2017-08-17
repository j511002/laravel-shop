<?php

namespace SimpleShop\Cate\Https\Requests\Api;


use SimpleShop\Cate\Https\Requests\Request;

class SubmitRequest extends Request
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
            'id'          => 'sometimes|integer|exists:commodity_cate,id',
            'pid'         => 'required|integer',
            'name'        => 'required|string|between:1,10',
            'description' => 'sometimes|string|max:50',
        ];
    }

    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'pid.required'    => '必须选择父分类',
            'name.required'   => '分类名字是必须填写',
            'name.between'    => '分类名字字数在1-10之间',
            'description.max' => '备注不能超过50个字',
        ];
    }
}
