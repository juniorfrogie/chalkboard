<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function getUrlAttribute()
    {
      // return route("question.show", $this->id);
      return "#";
    }

    public function answers()
    {
      return $this->hasMany(Answer::class);
    }

    public function getAvatarAttribute()
    {
      $email = $this->email;
      $size = 32;
      return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    public function favorites()
    {
      return $this->belongsToMany(Question::class, 'favorite_questions')->withTimestamps();
    }

    public function voteQuestions()
    {
      return $this->morphedByMany(Question::class, 'votable');
    }

    public function voteAnswers()
    {
      return $this->morphedByMany(Answer::class, 'votable');
    }

        public function voteAnswer(Answer $answer, $vote)
        {
          $voteAnswers = $this->voteAnswers();
          if($voteAnswers->where('votable_id', $answer->id)->exists()) {
            $voteAnswers->updateExistingPivot($answer, ['vote' => $vote]);
          } else {
            $voteAnswers->attach($answer, ['vote' => $vote]);
          }

          $answer->load('votes');
          $downVotes = (int) $answer->downVotes()->sum('vote');
          $upVotes = (int) $answer->upVotes()->sum('vote');

          $answer->votes_count = $upVotes + $downVotes;
          $answer->save();
        }

        public function voteQuestion(Question $question, $vote)
        {
          $voteAnswers = $this->voteQuestions();
          if($voteAnswers->where('votable_id', $question->id)->exists()) {
            $voteAnswers->updateExistingPivot($question, ['vote' => $vote]);
          } else {
            $voteAnswers->attach($question, ['vote' => $vote]);
          }

          $question->load('votes');
          $downVotes = (int) $question->downVotes()->sum('vote');
          $upVotes = (int) $question->upVotes()->sum('vote');

          $question->votes_count = $upVotes + $downVotes;
          $question->save();
        }
}
