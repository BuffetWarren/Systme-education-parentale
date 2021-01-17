<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use App\APIError;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validate(
        array $data,
        array $rules,
        array $messages = [],
        array $customAttributes = []
    ) {
        $validator = $this->getValidationFactory()
            ->make(
                $data,
                $rules,
                $messages,
                $customAttributes
            );

        if ($validator->fails()) {
            $errors = (new ValidationException($validator))->errors();
            $apiError = APIError::validationError('VALIDATION_ERROR', $errors);
            throw new HttpResponseException(response()->json($apiError, 400));
        }
    }


    public function saveMultipleImages($parent, $request, $key_validator, $directory)
    {
        $photos = [];
        if( $files = $request->file($key_validator) ){
            $i = 1;
            foreach($files as $key => $file){
                $parent->validate($request->all(), [ $key_validator.'[]' => 'image|mimes:jpeg,png,jpg,gif,svg']);
                $extension = $file->getClientOriginalExtension();
                $destinationPath = public_path('uploads/'.$directory);
                $safeName =  uniqid(substr($directory,0,3).'.',true) . '.' . $extension;
                $file->move($destinationPath, $safeName);
                $photos[] = str_replace('\\','',url('/uploads/'.$directory.'/'.$safeName));
                $i++;
            }
        }

        return $photos;
    }

    public function saveSingleImage($parent, $request, $key_validator, $directory)
    {
        $photo = '';
        if( $file = $request->file($key_validator) ){
            $parent->validate($request->all(), [ $key_validator => '']); // image|mimes:jpeg,png,jpg,gif,svg|mimetypes:application/pdf
            $extension = $file->getClientOriginalExtension(); 
            $destinationPath = public_path('uploads/'.$directory);
            $safeName =  uniqid(substr($directory,0,3).'.',true) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $photo = str_replace('\\','',url('/uploads/'.$directory.'/'.$safeName));
        }

        return $photo;
    }
}
