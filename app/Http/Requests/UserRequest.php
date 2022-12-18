<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if($this->path() == "api/register"){
        return [

            //
                'email'=>'required|email|unique:users,email',
                'phone_number'=>'size:11',
                'username'=>'required|string|unique:users,username',
                'password'=>'required|min:8',
            

        ];
        }
        if($this->path() == "api/login"){
            return [
    
                //
                    'username'=>'required|string|exists:users,username',
                    'password'=>'required|min:8',
                
    
            ];
            }
            if($this->path() == "api/user/update"){
                return [
        
                    //
                        'id'=>'required',
                        
                    
        
                ];
                }
           
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'status' => false,
                    'message' => $validator->errors()->first(),
                ],
                400
            )
        );
    }
}