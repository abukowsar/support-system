<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideosRequest extends FormRequest
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
            'title'        => 'required|max:191',
            'category_id'  => 'required',
            'videos'       => 'max:10240|mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv',
            'status'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_id.*' =>'Category is required.',
            'videos.max'  => 'Video file size too large',
            'videos.mimes'      => 'Accept only video file',
        ];
    }
}
