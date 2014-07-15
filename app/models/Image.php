<?php

use Watson\Validating\ValidatingTrait;

class Image extends Eloquent {

	use ValidatingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'images';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * The attributes that can be filled.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'path', 'width', 'height', 'background_color', 'key_color', 'secondary_color'];

	/**
	 * The attributes are not in the database
	 *
	 * @var array
	 */
	protected $appends = ['thumbnail_xs', 'thumbnail_sm', 'thumbnail_md', 'thumbnail_lg'];

	/**
	 * Validation Rules
	 *
	 * @var array
	 */
	protected $rules = [
		'name' => 'min:4',
        'path' => 'required|min:4',
        'width' => 'required|numeric',
        'height' => 'required|numeric',
    ];

    /**
	 * Whether the model should throw a ValidationException if it
	 * fails validation. If not set, it will default to false.
	 *
	 * @var boolean
	 */
	protected $throwValidationExceptions = true;

	/**
	 * Attributes converters
	 */

	public function getIdAttribute($attribute)
	{
		return (int) $attribute;
	}

	public function getThumbnailXsAttribute()
	{	
		$path = $this->attributes['path'];
		$parts = explode('/', $path);
		$parts[2] = str_replace('.jpg', '', $parts[2]);
		$thumbnail = $parts[0] . '/' . $parts[1] . '/thumbnails/' . $parts[2] . 'xs.jpg';
		return $thumbnail;
	}

	public function getThumbnailSmAttribute()
	{
		$path = $this->attributes['path'];
		$parts = explode('/', $path);
		$parts[2] = str_replace('.jpg', '', $parts[2]);
		$thumbnail = $parts[0] . '/' . $parts[1] . '/thumbnails/' . $parts[2] . 'sm.jpg';
		return $thumbnail;
	}

	public function getThumbnailMdAttribute()
	{
		$path = $this->attributes['path'];
		$parts = explode('/', $path);
		$parts[2] = str_replace('.jpg', '', $parts[2]);
		$thumbnail = $parts[0] . '/' . $parts[1] . '/thumbnails/' . $parts[2] . 'md.jpg';
		return $thumbnail;
	}

	public function getThumbnailLgAttribute()
	{
		$path = $this->attributes['path'];
		$parts = explode('/', $path);
		$parts[2] = str_replace('.jpg', '', $parts[2]);
		$thumbnail = $parts[0] . '/' . $parts[1] . '/thumbnails/' . $parts[2] . 'lg.jpg';
		return $thumbnail;
	}

}