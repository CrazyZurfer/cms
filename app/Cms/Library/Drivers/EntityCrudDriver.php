<?php namespace Cms\Library\Drivers;

use Cms\Library\Clases\ModelDriverWithSlug;

class EntityCrudDriver extends ModelDriverWithSlug {

	protected $model;
	protected $entity;

	public function __construct($model) {
		$this->model = '\\Site\\' . $model;
		$this->entity = \EntityDriver::findByModelName($model);
	}

	public function query() {
		$class = $this->model;
		$query = $class::where('id', '>', '0');

		foreach ($this->entity->attributes as $index => $attribute) {
			if ($attribute->type == 'image') {
				$query->with('image_' . $attribute->name);
			}
			if ($attribute->type == 'image_array') {
				$query->with('images_' . $attribute->name);
			}
		}

		return $query;
	}

	public function store($data) {

		foreach ($this->entity->attributes as $index => $attribute) {
			if ($attribute->type == 'image' && $data[$attribute->name]) {
				$image = \ImageDriver::store(['file' => $data[$attribute->name]]);
				$data[$attribute->name] = $image->id;
			} else if ($attribute->type == 'image') {
				unset($data[$attribute->name]);
			}
		}

		return parent::store($data);
	}

	public function update($id, $data) {

		foreach ($this->entity->attributes as $index => $attribute) {
			if ($attribute->type == 'image' && $data[$attribute->name]) {
				$image = \ImageDriver::store(['file' => $data[$attribute->name]]);
				$data[$attribute->name] = $image->id;
			} else if ($attribute->type == 'image') {
				unset($data[$attribute->name]);
			}
		}

		return parent::update($id, $data);
	}

	public function findByModel($model) {
		$public_view = parent::store($data);
		return $public_view;

	}

	public function addImage($id, $attribute_name, $file) {
		$image = \ImageDriver::store(['file' => $file]);
		$item = $this->get($id);
		$item->{'images_' . $attribute_name}()->attach($image->id);

		return $image;
	}

	public function removeImage($id, $attribute_name, $image_id) {
		$image = \ImageDriver::get($image_id);
		$item = $this->get($id);
		$item->{'images_' . $attribute_name}()->detach($image->id);

		\ImageDriver::delete($image_id);

		return $image;
	}

}