<?php
namespace App\Repository;
use App\Models\Admins;

class UsersRepository{
  private $query;
  public function __construct(Admins $query)
  {
    $this->query = $query;
  }

  public function getAll()
  {
    return Admins::all();
  }

  public function store(array $data)
  {
    return $this->query->create($data);
  }

  public function find($id)
  {
    return $this->query->findOrFail($id);
  }

  public function update(array $data, int $id)
  {
    $query = $this->find($id);

		if (isset($data['image']) && !empty($query->image) && file_exists(public_path() . '/uploaded/passports/' . $query->image)) {
			$file_path = 'uploaded/passports/' . $query->image;
			unlink($file_path);
		}

		$query->update($data);

		return $query;
  }

  public function delete($id)
  {
    return $this->query->where(['id'=>$id])->delete($id);
  }
}