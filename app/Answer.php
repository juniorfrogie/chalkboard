<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  protected $fillable = ['content', 'user_id'];
  public function question()
  {
    return $this->belongsTo(Question::class);
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function getContentHtmlAttribute()
  {
    return \Parsedown::instance()->text($this->content);
  }

  public function getCreatedDateAttribute()
  {
    return $this->created_at->diffForHumans();
  }

  public static function boot()
  {
    parent::boot();
    static::created(function ($answer) {
      $answer->question->increment('answers_count');
    });

    static::deleted(function ($answer) {
      // $question = $answer->question;
      // $question->decrement('answers_count');
      // if ($question->accepted_answer_id == $answer->id) {
      //   $question->accepted_answer_id = NULL;
      //   $question->save();
      // }
      $answer->question->decrement('answers_count');
    });
  }

  public function getStatusAttribute()
  {
    return $this->isBest() ? 'vote-accepted' : '';
  }

  public function getIsBestAttribute()
  {
    return $this->isBest();
  }

  public function isBest()
  {
    return $this->id == $this->question->accepted_answer_id;
  }
}
