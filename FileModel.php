<?php
namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{

    protected $table = "tbl_image";
    protected $allowedFields = ['name','image_url'];

    public function uploadfile($data)
    {
       
        $res = $this->insert($data);
        $id  = $this->insertID();
        return $id;
    }
    public function getfileData()
    {
        $res = $this->get()->getResult();
       
        return $res;
    }
    public function deletefileDate($id)
    {
        $res = $this->delete(['id' => $id]);
    }


}

?>