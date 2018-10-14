<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title','content'];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function setTitleAttribute($value)
    {
      $this->attributes['title'] = $value;
      $this->attributes['slug'] = str_slug($value);
    }

    public function getUrlAttribute()
    {
      return route("questions.show", $this->slug);
    }

    public function getCreatedDateAttribute()
    {
      return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
      if ($this->answers_count > 0) {
        if ($this->accepted_answer_id) {
          return "answered-accepted";
        }
        return "answered";
      }
      return "unanswered";
    }

    public function getContentHtmlAttribute()
    {
      return \Parsedown::instance()->text($this->content);
    }

    public function answers()
    {
      return $this->hasMany(Answer::class);
    }

    public function acceptBestAnswer(Answer $answer)
    {
      $this->accepted_answer_id = $answer->id;
      $this->save();
    }
}
