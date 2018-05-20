<?php

namespace App\Models;

use App\Graphs\DirectedGraph;
use App\Graphs\Line;
use App\Graphs\Node;
use App\Models\Fragments\Question\Relations;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property mixed level
 * @property mixed text
 */
class Question extends BaseModel
{
    use Relations;

    const GRAPH_TYPES = [
        'answered' => 1,
        'notAnswered' => 2,
        'all' => 3
    ];

    const POINT = 3;
    const MINUTE_COEFFICIENT = 0.05;

    const LEVELS = [
        'easy'      => 1,
        'middle'    => 2,
        'high'      => 3
    ];

    const MAT_ANALIZ_QUESTIONS = [
        'Ֆունկցիայի սահմանի սահմանում։',
        'Անբացահայտ ֆունկցիա։',
        'Անորոշ ինտեգրալ։',
        'Որոշյալ ինտեգրալ։',
        'Ֆունկցիայի էքստրեմումի կետեր։',
        'Վայերշտրասի թեորեմը։',
        'Կոշիի զուգամիտության սկզբունքը։',
        'Զուգամետ ֆունկցիա։',
        'Տարամետ ֆունկցիա։',
        'Կոմպլեքս թբեր։',
    ];

    const QUESTIONS_TEXTS = [
        'Սիլվեստրի անհավասարություններ։',
        'Օրթոգոնալ համակարգ։',
        'Կապակցված գրաֆներ',
    ];

    const DISKRET_QUESTIONS = [
        'Վերջավոր բազմություն։' => 'binar',
        'Անվերջ բազմություն։' => 'binar',
        'Երբ են A և B բազմությունները իրար հավասար։' => 'binar',
        'A և B բազմությունների դեկարտյան արտադրյալ։' => 'binar',
        'Կարգի հարաբերություն։' => 'binar',
        'Ընտրույթ։' => 'kombinator',
        'Նշվածներից, որը ընտրույթ չէ։' => 'kombinator',
        'Ովքեր էին հաըտչ կոկոսյան ընկուզենիների խնդրի գործող անձինք։' => 'kombinator',
        'Թեորեմ։ Ամեն մի G=(V,X) գրաֆում * աստիճան ունեցող գագաթների քանակը զույգ թիվ է։ Փոխարինե *-ը։' => 'grafner',
        'Տրված է G=(V,X) գրաֆը։ Նրա գագաթների U1, U2, U3,..., Uk հաջորդականությունը կանվանենք U1-ից Uk ճանապարհ, եթե 
        {U1, U2}, {U2, U3},...,{Uk, Uk-1}-ն G գրաֆի (շարունակել միտքը)։' => 'grafner',
        'Ամեն մի գրաֆ միարժեք ձևով ներկայացվում է իր (լրացնել այս հատվածը) ուղիղ գումարի տեսքով։' => 'grafner',
        'Էլյերյան ճանապարհ։' => 'grafner',
        'Բուլյան ֆունկցիաները կարող ենք ներկայանցենլ նաև (լրացնել այս հատվածը) միջոցով։' => 'boolyanFunkcianer',
        'Ինչ է կոչվում միմյանցից տարբեր փոփոխականների կամ դրանց ժխտումների տրամաբանական գումարը։' => 'boolyanFunkcianer',
        'Ինքնաերկակի ֆունկցիաների դասը (լրացնել այս հատվածը)։' => 'boolyanFunkcianer'
    ];

    const LEVEL_COEFFICIENT = [
        self::LEVELS['easy'] => 0.8,
        self::LEVELS['middle'] => 1,
        self::LEVELS['high'] => 1.2
    ];

    protected $fillable = [
        'text',
        'subject_id',
        'topic_id',
        'level',
        'time'
    ];

    public function asGraph($type)
    {
        $keyWords = KeyWord::where(function ($query) {

            foreach (explode(' ', $this->text) as $word) {
                $query->orWhere('name', 'like', "%$word%");
            }
        })->where('subject_id', $this->subject->id)->get();

        if($type == self::GRAPH_TYPES['notAnswered']){
            $keyWords = KeyWord::whereNotIn('id', $keyWords->pluck('id')->toArray())
                ->where('subject_id', $this->subject->id)->get();
        } elseif($type == self::GRAPH_TYPES['all']) {
            $keyWords = KeyWord::where('subject_id', $this->subject->id)->get();
        } else {
            session(['fullAnswered' => $keyWords->count() == KeyWord::where('subject_id', $this->subject->id)->count()]);
        }
//        dd($keyWords->count(), KeyWord::where('subject_id', $this->subject->id)->count());

        $nodes = $this->nodesFromKeyWords($keyWords);
        $lines = $this->linesFromKeyWords($keyWords);

        return new DirectedGraph($nodes, $lines);
    }

    private function nodesFromKeyWords(Collection $keyWords): array
    {
        $nodes = [];

        foreach ($keyWords as $keyWord) {
            $nodes [] = new Node(
                $keyWord->id,
                $keyWord->name,
                $keyWord->parents->pluck('id')->toArray(),
                $keyWord->children->pluck('id')->toArray()
            );
        }

        return $nodes;
    }

    private function linesFromKeyWords(Collection $keyWords): array
    {
        $lines = [];

        foreach ($keyWords as $keyWord) {

            foreach ($keyWord->parents as $parent){

                if($keyWords->where('id', $parent->id)->isNotEmpty()){
                    $lines [] = new Line(
                        $parent->id,
                        $keyWord->id
                    );
                }
            }

            foreach ($keyWord->children as $child){

                if($keyWords->where('id', $child->id)->isNotEmpty()){

                    $lines [] = new Line(
                        $keyWord->id,
                        $child->id
                    );
                }
            }
        }

        return $lines;
    }
}
