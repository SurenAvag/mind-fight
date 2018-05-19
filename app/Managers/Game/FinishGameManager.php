<?php

namespace App\Managers\Game;

use App\Managers\Rating\EloAlgorithmManager;
use App\Models\Game;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinishGameManager
{
    private $game;
    private $answers = [];
    private $winner;
    private $loser;
    private $winnerRatingChanges;
    private $loserRatingChanges;
    private $gameIsFinished;

    function __construct(Game $game, array $answers)
    {
        $this->game = $game;
        $this->answers = $answers;
    }

    public function endGame()
    {
        $this->updatePivotTableValues($this->getTrueAnswersCount());

        if ($this->gameIsFinished = $this->game->isFinished()) {
            $this->initializePlayerRoles();

            if ($this->checkIfRolesDivided()) {
                $this->updatePlayersRating();
            }

            $this->updateGame();
        }

        return $this;
    }

    private function updateGame(): void
    {
        $this->game->update([
            'winner_id'     => $this->winner ? $this->winner->id : null,
            'loser_id'      => $this->loser ? $this->loser->id : null,
        ]);
    }

    private function getTrueAnswersCount(): int
    {
        $trueAnswersCount = 0;

        foreach ($this->getGameQuestions() as $question) {
            if($question->trueAnswer->id == $this->answers[$question->id]){

                Auth::user()->answeredQuestions()->syncWithoutDetaching($question->id);

                $trueAnswersCount ++;
            }
        }

        return $trueAnswersCount;
    }

    private function getGameQuestions()
    {
        return Question::with('trueAnswer')->find(array_filter(array_keys($this->answers)));
    }

    private function initializePlayerRoles(): void
    {
        $playedUsers = $this->game->decideWinnerAndLoser();
        $this->winner = $playedUsers['winner'];
        $this->loser = $playedUsers['loser'];
    }

    private function checkIfRolesDivided(): bool
    {
        return (is_null($this->winner) && is_null($this->loser)) ? false : true;
    }

    private function updatePlayersRating(): void
    {
        $this->winnerRatingChanges = EloAlgorithmManager::getRatingForWinner(
            $this->winner ?? $this->loser, $this->loser ?? $this->winner
        );
        $this->loserRatingChanges = EloAlgorithmManager::getRatingForLoser(
            $this->loser ?? $this->winner, $this->winner ?? $this->loser
        );

        if ($this->winner) {
            $this->winner->increment('rating', $this->winnerRatingChanges);
        }
        if ($this->loser) {
            $this->loser->decrement('rating', $this->loserRatingChanges);
        }

        $this->updatePivotTableRatingChangesAttribute();
    }

    private function updatePivotTableRatingChangesAttribute(): void
    {
        if ($this->winner) {
            DB::table('game_users')->where('game_id', $this->game->id)
                ->where('user_id', $this->winner->id)
                ->update([
                    'rating_changes' => $this->winnerRatingChanges
                ]);
        }

        if ($this->loser) {
            DB::table('game_users')->where('game_id', $this->game->id)
                ->where('user_id', $this->loser->id)
                ->update([
                    'rating_changes' => -$this->loserRatingChanges
                ]);
        }
    }

    private function updatePivotTableValues(int $trueAnswersCount): void
    {
        DB::table('game_users')->where('game_id', $this->game->id)
            ->where('user_id', Auth::id())
            ->update([
                'true_answers_count'    => $trueAnswersCount,
                'finished_date'         => Carbon::now()->toDateTimeString()
            ]);
    }

    public function getMessage()
    {
        if ($this->game->for_two_player) {
            if ($this->gameIsFinished) {
                return [
                    'gameIsFinished'    => $this->gameIsFinished,
                    'gameForTwoPlayer'  => true,
                    'winnerUser'        => $this->game->winner,
                    'winnerPoint'       => $this->winnerRatingChanges,
                    'loserUser'         => $this->game->loser,
                    'loserPoint'        => $this->loserRatingChanges,
                ];
            }

            return [
                'gameIsFinished'    => $this->gameIsFinished,
                'gameForTwoPlayer'  => true,
            ];

        } else {
            if ($this->winner) {
                return [
                    'gameIsFinished'    => $this->gameIsFinished,
                    'gameForTwoPlayer'  => false,
                    'isWin'             => true,
                    'points'            => $this->winnerRatingChanges
                ];
            }

            return [
                'gameIsFinished'    => $this->gameIsFinished,
                'gameForTwoPlayer'  => false,
                'isWin'             => false,
                'points'            => $this->winnerRatingChanges
            ];
        }
    }
}