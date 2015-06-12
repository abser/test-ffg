<?php namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\FileOwnerInterface;
use Sprim\Repositories\Contracts\FileInterface as File;
use Sprim\Repositories\Eloquent\AbstractRepository;
use Sprim\Model\FileOwner;

class FileOwnerRepository extends AbstractRepository implements FileOwnerInterface {

    protected $model;

    public function __construct(FileOwner $model, File $file)
    {
        $this->model    = $model;
        $this->file     = $file;
    }
    
    public function _save($file_id, $owner_id, $owner_table)
    {
        $file_owner                 = $this->newInstance();
        $file_owner->file_id        = $file_id;
        $file_owner->owner_id       = $owner_id;
        $file_owner->owner_table    = $owner_table;
        
        $file_owner->save();
    }
    
    public function getFile($owner_id, $owner_table, $file_type)
    {
        $file = $this->model
            ->join('files', 'file_owners.file_id', '=', 'files.id')
            ->where('file_owners.owner_id', '=', $owner_id)
            ->where('file_owners.owner_table', '=', $owner_table)
            ->where('files.file_type', '=', $file_type)->first();
        
        return $file;
    }
    
    public function getAvatar($id, $owner_table, $file_type)
    {
        $avatar         = $this->getFile($id, $owner_table, $file_type);
        
        if (!$avatar){
            $file = new \stdClass();
            $file->name         = 'img/no-photo.png';
            $file->description  = 'no-photo.png';
            $avatar     = $file;
        }
        
        return $avatar;
    }
    
    public function checkDelete($owner_id, $owner_table, $file_type)
    {
        if($item = $this->getFile($owner_id, $owner_table, $file_type) ){
            if($item->id){
                $this->file->deleteById($item->id);
                $this->model->where('owner_id', '=', $item->owner_id)->
                    where('owner_table', '=', $item->owner_table)->
                    where('file_id', '=', $item->file_id)->delete();
            }
            
        }
        
        return true;
    }
    
    public function swapFile($keep_id, $delete_id, $type, $table)
    {
        
        if ($delete_file = $this->getFile($keep_id, $table, $type)){
            $this->file->destroy($delete_file->file_id);
        }
        
        if ($keep_file = $this->getFile($delete_id, $table, $type)){
            $this->model->where('file_id', '=', $keep_file->file_id)->
                where('owner_id', '=', $delete_id)->
                where('owner_table', '=', $table)->update(array('owner_id' => $keep_id));
        }
    }
}