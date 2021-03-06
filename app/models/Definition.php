<?php

use Watson\Validating\ValidatingTrait;

class Definition extends Eloquent {

	use ValidatingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'definitions';

	/**
	 * The database colums
	 *
	 * @var array
	 */
	protected $columns = ['id', 'created_at', 'updated_at', 'description', 'type', 'editable', 'hidden', 'string', 'text', 'integer', 'image_id', 'image', 'tag', 'code', 'boolean'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['id', 'editable', 'hidden', 'tag', 'description'];

	/**
	 * The attributes that can be filled.
	 *
	 * @var array
	 */
	protected $fillable = ['identifier', 'description', 'type', 'editable', 'hidden', 'string', 'text', 'integer', 'image_id', 'image', 'tag', 'code', 'boolean'];

	/**
	 * The attributes are not in the database
	 *
	 * @var array
	 */
	protected $appends = ['code', 'boolean'];

	/**
	 * Validation Rules
	 *
	 * @var array
	 */
	protected $rules = [
		'identifier' => 'required|alpha_dash|unique:definitions,identifier',
        'type' => 'required|in:string,text,integer,image,code,boolean',
        'editable' => 'boolean',
        'hidden' => 'boolean',
        'string' => '',
        'text' => '',
        'integer' => 'numeric',
        'image_id' => 'exists:images,id',
        'tag' => 'alpha_dash',
        'code' => '',
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

	public function getEditableAttribute($attribute)
	{
		return (boolean) $attribute;
	}

	public function getHiddenAttribute($attribute)
	{
		return (boolean) $attribute;
	}

	public function image() {
		return $this->belongsTo('Image');
	}

	public function setCodeAttribute($attribute)
	{
		$this->attributes['text'] = $attribute;
	}

	public function getCodeAttribute()
	{
		return $this->attributes['text'];
	}

	public function setBooleanAttribute($attribute)
	{
		$this->attributes['integer'] = $attribute;
	}

	public function getBooleanAttribute()
	{
		return (boolean) $this->attributes['integer'];
	}

}
