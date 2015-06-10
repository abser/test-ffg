<?php namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\FileInterface;
use Sprim\Repositories\Eloquent\AbstractRepository;
use Sprim\Model\File;

class FileRepository extends AbstractRepository implements FileInterface {

    protected $model;

    public function __construct(File $model)
    {
        $this->model        = $model;
    }
    
    public function _save($file = array(), $file_type)
    {
        $clm_file               = $this->newInstance();
        $clm_file->name         = $file['name'];
        $clm_file->description  = $file['description'];
        $clm_file->file_type    = $file_type;
        
        $clm_file->save();
        
        return $clm_file->id;
        
    }
    
    public function deleteById($id)
    {
        $file = $this->model->where('id', '=', $id)->first();
        
        $this->s3_delete($file->name);
        $file->delete();
    }
    
    public function s3_delete($file_name)
    {
        $s3_conf      = \Config::get('aws-s3');
        $s3           = \AWS::get('s3');
        
        $s3->deleteObject(array(
            'Bucket'    => $s3_conf['bucket'],
            'Key'       => $file_name,
        ));
    }
}