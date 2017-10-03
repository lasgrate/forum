<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = [
		'name',
		'forum_id',
	];

	public $timestamps = false;

	/**
	 * Relation between themes and tags (many to many)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function themes()
	{
		return $this->belongsToMany('App\Models\Theme', 'themes_tags');
	}

	/**
	 * Relation between forums and tags (one to many inverse)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function forum()
	{
		return $this->belongsTo('App\Models\Forum');
	}

	/**
	 * Get Forum`s tags dy themes
	 *
	 * @param $themes
	 * @return array
	 */
	public static function getForumTagsByThemes($themes)
	{
		$tagsUnique = array();
		$tags = array();

		foreach ($themes as $theme) {
			foreach ($theme->tags()->get() as $tag) {
				if (!in_array($tag->id, $tagsUnique)) {
					$tagsUnique[] = $tag->id;
					$tags[] = $tag;
				} else {
					continue;
				}
			}
		}

		return $tags;
	}
}
