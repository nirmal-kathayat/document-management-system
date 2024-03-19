<?php

namespace App\Repository;

use IAnanta\UserManagement\Models\Admin;
use Illuminate\Http\UploadedFile;

class UserRepository
{
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
    if (isset($data['image']) && $data['image']) {
      $data['image'] = $this->uploadImage($data['image'], [
        'destination' => 'uploaded/user',
        'image_name' => now()->timestamp,
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
    // dd($query->toArray());
    if (isset($data['image']) && $data['image']) {
      $data['image'] = $this->uploadImage($data['image'], [
        'destination' => 'uploaded/user',
        'image_name' => now()->timestamp,
        'existing_file' => $query->image
      ]);
    }

    $query->update($data);
    return $query;
  }

  public function delete($id)
  {
    return $this->query->findOrFail($id)->delete();
  }

  public function uploadImage(UploadedFile $file, $params)
  {
    $imageName = $params['image_name'] . '.' . $file->getClientOriginalExtension();
    $file->move($params['destination'], $imageName);
    // dd($file);
    if (!empty($params['existing_file']) && file_exists(public_path() . '/' . $params['existing_file'])) {
      unlink($params['existing_file']);
    }

    return $params['destination'] . '/' . $imageName;
  }
}
