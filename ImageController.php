<?php

namespace App\Controllers;

use App\Models\FileModel;

class ImageController extends BaseController
{
    public function index()
    {
        return view('ImageUpload');
    }
    public function UploadImage()
    {
        $session = session();
        helper(['form']);
        $img_url = '';
        $fileModel = new FileModel();

        if($this->request->getMethod() == 'POST')
        {   
            $name = $this->request->getPost('name');
            $files = $this->request->getFiles();
            $rules = [
                'name'=>'required',
                'file'=>'uploaded[file]|is_image[file]|max_size[file,4096]',
           ]; 

           if($this->validate($rules))
           {
                    foreach($files['file'] as $img)
                    {
                        if($img->isValid() && !$img->hasMoved())
                        {
                                    $path = 'upload/';
                                    $newname = $img->getRandomName();
                                    $img->move('./'.$path,$newname);
                                    $file_url =   $path.$img->getName();

                                    $newFileName[] = $file_url;

                                    $img_url .= "<img src=".base_url().$file_url." width='200px'>";
                                   
                        }
                        else
                        {
                            $json = [
                                'status' => false,
                                'message' => 'file not uplaoded !',
                            ];
                        }
                    }

                    $newData = [
                        'name'=> $name,
                        'image_url' => json_encode($newFileName),
                    ];

                    

                    $lastIsertID = $fileModel->uploadfile($newData);

                    $appendData =  '<tr><td>'.$name.'</td><td>'.$img_url.'</td><td><a href="delete/'.$lastIsertID.'">Delete</a></td></tr>';
                    $json = [
                        'status' => true,
                        'message' => 'file uplaoded successfully',
                        'path'=> $appendData,
                        'name'=>$name,
                    ];

           }
           else
           {
                $json = [
                    'status'=>false,
                    'message'=> $this->validator->listErrors(),
                ]; 
           }
           echo json_encode($json);
        }
        else
        {   
                $data['getData'] = $fileModel->getfileData();
                return view('ImageUpload',$data);
        }
    }
    public function deletefileData($id)
    {

        
        $fileModel = new FileModel();
       $res = $fileModel->deletefileDate($id);

       $data['getData'] = $fileModel->getfileData();
       return redirect('imageupload',$data);
    }
}
