<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Support\Facades\Auth;

class Theme extends Model
{
	use Sluggable, SluggableScopeHelpers;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'client_id', 'forum_id', 'name', 'fake_name',
		'description', 'created_at', 'is_enable'
	];

	/**
	 * Relation between forums and themes (one to many) inverse
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function client()
	{
		return $this->belongsTo('App\Models\Client');
	}

	/**
	 * Relation between themes and forums (one to many inverse)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function forum()
	{
		return $this->belongsTo('App\Models\Forum');
	}

	/**
	 * Relation between themes and messages (one to many)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function messages()
	{
		return $this->hasMany('App\Models\Message');
	}

	/**
	 * Relation between themes and tags (many to many)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany('App\Models\Tag', 'themes_tags');
	}

	/**
	 * Sluggable source
	 *
	 * @return array
	 */
	public function sluggable()
	{
		return [
			'slug' => [
				'source' => 'name'
			]
		];
	}

	/**
	 * Get themes by `forum_id`
	 *
	 * @param $forum_id
	 * @return \Illuminate\Support\Collection
	 */
	public function getAllThemesByForumId($forum_id)
	{
		$themes = self::where('is_enable', true)
			->where('forum_id', $forum_id)->get();

		return $themes;
	}

	/**
	 * Get all client`s answers by `client_id`
	 *
	 * @param $forum_id
	 * @param $client_id
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
	 */
	public function getAllAnswerThemesByClientId($forum_id, $client_id)
	{
		$themes = self::whereHas('messages', function ($query) {
			$query->where(['client_view' => false, 'is_enable' => true]);
		})->where(['client_id' => $client_id, 'is_enable' => true, 'forum_id' => $forum_id])
			->get();

		return $themes;
	}

	/**
	 * Get Client theme
	 *
	 * @param $forum_id
	 * @param $client_id
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getAllClientTheme($forum_id, $client_id)
	{
		$themes = self::where(['forum_id' => $forum_id, 'client_id' => $client_id])
			->orderBy('created_at', 'DESC')->paginate(10);

		return $themes;
	}

	/**
	 * Get all themes by `forum_id`
	 *
	 * @param $forum_id
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getAllThemeByForumId($forum_id)
	{
		$themes = self::where('is_enable', true)
			->where('forum_id', $forum_id)
			->orderBy('created_at', 'DESC')->paginate(10);

		return $themes;
	}

	/**
	 * Get answer`s tags by `forum_id`
	 *
	 * @param $forum_id
	 * @param $client_id
	 * @return array
	 */
	public function getAllAnswerTagByForumId($forum_id, $client_id)
	{
		$themes = $this->getAllAnswerThemesByClientId($forum_id, $client_id);

		return $this->uniqueTags($themes);
	}

	/**
	 * Get forum`s themes by tag
	 *
	 * @param $forum_id
	 * @param $tag_id
	 * @return mixed
	 */
	public static function getForumThemesByTag($forum_id, $tag_id)
	{
		$tag = Tag::findOrFail($tag_id);

		$themes = $tag->themes()
			->where('forum_id', $forum_id)
			->where('is_enable', '=', true)
			->orderBy('created_at', 'DESC')
			->paginate(10);

		return $themes;
	}

	/**
	 * Get theme`s answers by tag
	 *
	 * @param $forum_id
	 * @param $tag_id
	 * @param $client_id
	 * @return mixed
	 */
	public static function getForumAnswerThemesByTag($forum_id, $tag_id, $client_id)
	{
		$tag = Tag::findOrFail($tag_id);;

		$themes = $tag->themes()->whereHas('messages', function ($query) {
			$query->where('client_view', '=', false)->where('is_enable', '=', true);
		})->where('client_id', '=', $client_id)
			->where('forum_id', '=', $forum_id)
			->where('is_enable', '=', true)
			->paginate(10);

		return $themes;
	}

	/**
	 * Get unique tags
	 *
	 * @param $themes
	 * @return array
	 */
	public static function uniqueTags($themes)
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

	/**
	 * Save forum`s theme
	 *
	 * @param $request
	 * @param $forum_id
	 * @return $this
	 */
	public function saveTheme($request, $forum_id)
	{
		$this->name = $request->title;
		$this->forum_id = $forum_id;
		$this->is_enable = false;
		$this->description = $request->body;
		$this->client_id = Auth::guard('clients')->user()->id;

		$this->save();
		$this->tags()->attach($request->featured_tag);

		return $this;
	}
}
