<?php
namespace App\Repository;
use IAnanta\UserManagement\Models\Admin;
class UserRepository{
  private $query;
  public function __construct(Admin $query)
  {
    $this->query = $query;
  }

  public function getAll()
  {
    return $this->query->get();
  }

  public function store(array $data)
  {
    if(isset($data['image']) && !empty($data['image'])){
      $data['image'] = $this->uploadImage($data['image'],[
         'destination' => 'uploaded/user',
         'image_name' => now(),
         'existing_file' => NULL
      ]);
    }
    return $this->query->create($data);

  }

  public function find($id)
  {
    return $this->query->findOrFail($id);
  }

  public function update(array $data, int $id)
  {
    $query = $this->find($id);
    if(isset($data['image'])){
      $data['image'] = $this->uploadImage($data['image'],[
         'destination' => 'uploaded/user',
         'image_name' => now(),
         'existing_file' => $query->image
      ]);
    }
		$query->update($data);

		return $query;
  }

  public function delete($id)
  {
    return $this->query->where(['id'=>$id])->delete($id);
  }


  public function uploadImage($file,$params){
    $imageName = $params['image_name'].'.'.pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
    $file->move($params['destination'],$imageName);
    if(!empty($params['existing_file'])){
      if(file_exists( public_path().'/'.$params['existing_file'])){
        unlink($params['existing_file']);
      }
    }
    return $params['destination'].'/'.$imageName;
  }
}