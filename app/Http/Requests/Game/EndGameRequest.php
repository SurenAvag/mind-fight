<?php

namespace App\Http\Requests\Game;

use App\Http\Requests\BaseRequest;
use App\Managers\Rating\EloAlgorithmManager;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @property mixed answers
 * @property mixed game
 * @property mixed endTime
 */
class EndGameRequest extends BaseRequest
{
    private $winner;
    private $loser;

    public function authorize()
    {
        return !$this->game->isFinished();
    }

    public function rules()
    {
        return [
            'answers'   => 'required|array',
            'answers.*' => 'integer|exists:answers,id'
        ];
    }

    public function endGame()
    {
        $this->updatePivotTableValues($this->getTrueAnswersCount());

        if ($this->game->isFinished()) {
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
                $trueAnswersCount ++;
            }
        }

        return $trueAnswersCount;
    }

    private function getGameQuestions()
    {
        return Question::with('trueAnswer')->find(array_keys($this->answers));
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
        $winnerRatingChanges = EloAlgorithmManager::getRatingForWinner(
            $this->winner ?? $this->loser, $this->loser ?? $this->winner
        );
        $loserRatingChanges = EloAlgorithmManager::getRatingForLoser(
            $this->loser ?? $this->winner, $this->winner ?? $this->loser
        );

        if ($this->winner) {
            $this->winner->increment('rating', $winnerRatingChanges);
        }
        if ($this->loser) {
            $this->loser->decrement('rating', $loserRatingChanges);
        }

        $this->updatePivotTableRatingChangesAttribute($winnerRatingChanges, $loserRatingChanges);
    }

    private function updatePivotTableRatingChangesAttribute(float $winnerRatingChanges, float $loserRatingChanges): void
    {
        if ($this->winner) {
            DB::table('game_users')->where('game_id', $this->game->id)
                ->where('user_id', $this->winner->id)
                ->update([
                    'rating_changes' => $winnerRatingChanges
                ]);
        }

        if ($this->loser) {
            DB::table('game_users')->where('game_id', $this->game->id)
                ->where('user_id', $this->loser->id)
                ->update([
                    'rating_changes' => -$loserRatingChanges
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

    public function getPoints()
    {
        return Auth::user()->fresh()->rating;
    }
}
