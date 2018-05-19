<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    public function run()
    {
        foreach (self::SEED_DATA['subjects'] as $subject) {
            $subjectModel = \App\Models\Subject::create([
                'name' => $subject['name']
            ]);
            foreach ($subject['topics'] as $topic) {
                $topicModel = \App\Models\Topic::create([
                    'name'          => $topic['name'],
                    'subject_id'    => $subjectModel->id
                ]);
                foreach ($topic['questions'] as $question) {
                    $questionModel = \App\Models\Question::create([
                        'text'          => $question['name'],
                        'subject_id'    => $subjectModel->id,
                        'topic_id'      => $topicModel->id,
                        'level'         => $question['level'],
                        'time'          => rand(5, 10)
                    ]);
                    foreach ($question['answers'] as $answer) {
                        $answerModel = \App\Models\Answer::create([
                            'text'              => $answer['name'],
                            'question_id'       => $questionModel->id,
                            'is_true_answer'    => $answer['is_true_answer']
                        ]);
                    }
                }
                foreach ($topic['keyWords'] as $keyWord) {
                    \App\Models\KeyWord::create([
                        'name'          => $keyWord,
                        'subject_id'    => $subjectModel->id,
                        'topic_id'      => $topicModel->id
                    ]);
                }
            }
        }
    }

    const SEED_DATA = [
        'subjects' => [[
            'name' => 'Դիսկրետ մաթեմատիկա',
                'topics' => [
                    [
                        'name' => 'Բինար հարաբերություններ։',
                        'questions' => [
                            [
                                'name' => 'Վերջավոր բազմություն։',
                                'level' => \App\Models\Question::LEVELS['easy'],
                                'answers' => [
                                    [
                                        'name' => 'Ցանկացած բազմություն վերջավոր է։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Բազմությունը կանվանենք վերջավոր, եթե գոյություն ունի n>=0 ամբողջ թիվ, այնպիսին, որ այդ բազմությանը պատկանում են ճիշտ n-1 հատ տարրեր։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Բազմությունը կանվանենք վերջավոր, եթե գոյություն ունի n>=0 ամբողջ թիվ, այնպիսին, որ այդ բազմությանը պատկանում են ճիշտ n հատ տարրեր։',
                                        'is_true_answer' => 1
                                    ],
                                    [
                                        'name' => 'Բազմությունը կանվանենք վերջավոր, եթե այն փակ է և սահմանափակ։',
                                        'is_true_answer' => 0
                                    ],
                                ],
                            ],
                            [
                                'name' => 'Անվերջ բազմություն։',
                                'level' => \App\Models\Question::LEVELS['easy'],
                                'answers' => [
                                    [
                                        'name' => 'Բազմությունը կանվանենք անվերջ, եթե գոյություն չունի n>=0 ամբողջ թիվ, այնպիսին, որ այդ բազմությանը պատկանում են ճիշտ n հատ տարրեր։',
                                        'is_true_answer' => 1
                                    ],
                                    [
                                        'name' => 'Ցանկացած վերջավոր բազմություն նաև անվերջ է։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Բազմությունը կանվանենք անվերջ, եթե բոլոր տարրերի գումարը ձգտում է անվերջության։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Անվերջ բազմություններ չկան։',
                                        'is_true_answer' => 0
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Երբ են A և B բազմությունները իրար հավասար։',
                                'level' => \App\Models\Question::LEVELS['easy'],
                                'answers' => [
                                    [
                                        'name' => 'Կասենք, որ A և B բազմությունները հավասար են, եթե պարունակում են նույն քանակությամբ տարրեր։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Կասենք, որ A և B բազմությունները հավասար են, եթե A-ն ընկած է B-ի մեջ և B-ն ընկած է A-ի մեջ։',
                                        'is_true_answer' => 1
                                    ],
                                    [
                                        'name' => 'Կասենք, որ A և B բազմությունները հավասար են, եթե գոյություն ունի առնվազն մեկ ենթաբազմություն, որը գոյություն ունի և A-ում և B-ում։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Կասենք, որ A և B բազմությունները հավասար են, եթե գոյություն ունի առնվազն երկու ենթաբազմություն, որը գոյություն ունի և A-ում և B-ում։',
                                        'is_true_answer' => 0
                                    ],
                                ]
                            ],
                            [
                                'name' => 'A և B բազմությունների դեկարտյան արտադրյալ։',
                                'level' => \App\Models\Question::LEVELS['middle'],
                                'answers' => [
                                    [
                                        'name' => 'A և B բազմությունների դեկարտյան արտադրյալ կանվանենք այն բազմությունը, որի տարրերն են բոլոր հնարավոր (a, b) կարգավորված զույգերը, որտեղ a-ն A-ից է, իսկ b-ն B-ից։',
                                        'is_true_answer' => 1
                                    ],
                                    [
                                        'name' => 'A և B բազմությունների դեկարտյան արտադրյալ կանվանենք այն բազմությունը, որի տարրերն են բոլոր հնարավոր (a, b) կարգավորված զույգերը, որտեղ a-ն և b-ն կամայական են։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'A և B բազմությունների դեկարտյան արտադրյալ կանվանենք այն բազմությունը, որի տարրերն են բոլոր հնարավոր (a, b) կարգավորված զույգերը, որտեղ a-ն և b-ն A-ից են։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'A և B բազմությունների դեկարտյան արտադրյալ կանվանենք այն բազմությունը, որի տարրերն են բոլոր հնարավոր և A-ից են և B-ից։',
                                        'is_true_answer' => 0
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Կարգի հարաբերություն։',
                                'level' => \App\Models\Question::LEVELS['middle'],
                                'answers' => [
                                    [
                                        'name' => 'Հարաբերությունը կոչվում է կարգի հարաբերություն, եթե այն սիմետրիկ է և ռեֆլեքսիվ։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Հարաբերությունը կոչվում է կարգի հարաբերություն, եթե այն անտիսիմետրիկ, ռեֆլեքսիվ Է։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Հարաբերությունը կոչվում է կարգի հարաբերություն, եթե այն անտիսիմետրիկ, տրանզիտիվ և ռեֆլեքսիվ Է։',
                                        'is_true_answer' => 1
                                    ],
                                    [
                                        'name' => 'Հարաբերությունը կոչվում է կարգի հարաբերություն, եթե այն տրանզիտիվ և ռեֆլեքսիվ Է։',
                                        'is_true_answer' => 0
                                    ],
                                ]
                            ],
                        ],
                        'keyWords' => [
                            'Վերջավոր բազմություն',
                            'Անվերջ բազմություն',
                            'Հավասար բազմություններ',
                            'Դեկարտյալ արտադրյալ',
                            'Կարգի հարաբերույթւն',
                        ]
                    ],
                    [
                        'name' => 'Կոմբինատորիկայի տարրերը։',
                        'questions' => [
                            [
                                'name' => 'Ընտրույթ։',
                                'level' => \App\Models\Question::LEVELS['easy'],
                                'answers' => [
                                    [
                                        'name' => 'Ընտրույթ A բազմությունից կանվանենք այդ բազմության տարրերի ցանկացած հաջորդականաությունը։',
                                        'is_true_answer' => 1
                                    ],
                                    [
                                        'name' => 'Ընտրույթ A բազմությունից կանվանենք այդ բազմության տարրերի ցանկացած հաջորդականաություն, որտեղ բոլոր իրար հարևան տարրերը կարգավորված զույգ են։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Ընտրույթ A բազմությունից կանվանենք այդ բազմության տարրերի ցանկացած հաջորդականաություն, որտեղ բոլոր իրար հարևան տարրերը նույն են։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Ընտրույթ A բազմությունից կանվանենք այդ բազմության տարրերի ցանկացած հաջորդականաություն, որտեղ բոլոր իրար հարևան տարրերը տարբեր են։',
                                        'is_true_answer' => 0
                                    ]
                                ]
                            ],
                            [
                                'name' => 'Նշվածներից, որը ընտրույթ չէ։',
                                'level' => \App\Models\Question::LEVELS['easy'],
                                'answers' => [
                                    [
                                        'name' => 'Կարգավորված ընտրույթ։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Ընտրույթներ չկրկնվող տարրերով։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Ընտրույթներ կրկնվող տարրերով։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Ընտրույթներ մեկը մյուսից մեծ տարրերով։',
                                        'is_true_answer' => 1
                                    ]
                                ]
                            ],
                            [
                                'name' => 'Ովքեր էին հայտնի կոկոսյան ընկուզենիների խնդրի գործող անձինք։',
                                'level' => \App\Models\Question::LEVELS['easy'],
                                'answers' => [
                                    [
                                        'name' => 'Նավաստիները։',
                                        'is_true_answer' => 1
                                    ],
                                    [
                                        'name' => 'Ֆիզիկոսները։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Մաթեմատիկոսները։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Վթարված ինքնաթիռի ղեկավար անձնակազմը։',
                                        'is_true_answer' => 0
                                    ],
                                ]
                            ],
                        ],
                        'keyWords' => [
                            'Ընտրույթ'
                        ]
                    ],
                    [
                        'name' => 'Բուլյան ֆունկցիաներ։',
                        'questions' => [
                            [
                                'name' => 'Բուլյան ֆունկցիաները կարող ենք ներկայանցենլ նաև (լրացնել այս հատվածը) միջոցով։',
                                'level' => \App\Models\Question::LEVELS['middle'],
                                'answers' => [
                                    [
                                        'name' => 'կոնյուկտիվ նորմալ ձևի',
                                        'is_true_answer' => 1
                                    ],
                                    [
                                        'name' => 'տարրական դիզունկցիայի',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'դիզյունկտիվ նորմալ ձևի',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'սահմանված տիրույթի վրա, իր ընդունած արշեքների գումարի',
                                        'is_true_answer' => 0
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Ինչ է կոչվում միմյանցից տարբեր փոփոխականների կամ դրանց ժխտումների տրամաբանական գումարը։',
                                'level' => \App\Models\Question::LEVELS['middle'],
                                'answers' => [
                                    [
                                        'name' => 'Տարրական դիզունկցիա։',
                                        'is_true_answer' => 1
                                    ],
                                    [
                                        'name' => 'Կոնյուկտիվ նորմալ ձև։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Դիզյունկտիվ նորմալ ձև։',
                                        'is_true_answer' => 0
                                    ],
                                    [
                                        'name' => 'Կարգավորված արժեք։։',
                                        'is_true_answer' => 0
                                    ],
                                ]
                            ],
                            [
                                'name' => 'Ինքնաերկակի ֆունկցիաների դասը (լրացնել այս հատվածը)։',
                                'level' => \App\Models\Question::LEVELS['middle'],
                                'answers' => [
                                    [
                                        'name' => 'asd',
                                        'is_true_answer' => 1
                                    ],
                                    [
                                        'name' => 'zxc',
                                        'is_true_answer' => 0
                                    ]
                                ]
                            ]
                        ],
                        'keyWords' => [
                            'Կոնյուկտիվ նորմալ ձև',
                            'Տարրական դիզյունկցիա',
                            'Ինքնաերկակի ֆունկցիա',
                        ]
                    ],
                    [
                        'name' => 'Գրաֆների տեսության տարրերը։',
                        'questions' => [
                            [
                                'name' => 'Թեորեմ։ Ամեն մի G=(V,X) գրաֆում * աստիճան ունեցող գագաթների քանակը զույգ թիվ է։ Փոխարինե *-ը։',
                                'level' => \App\Models\Question::LEVELS['middle'],
                                'answers' => [
                                    [
                                        'name' => 'asd',
                                        'is_true_answer' => 1
                                    ],
                                    [
                                        'name' => 'zxc',
                                        'is_true_answer' => 0
                                    ]
                                ]
                            ],
                            [
                                'name' => 'Տրված է G=(V,X) գրաֆը։ Նրա գագաթների U1, U2, U3,..., Uk հաջորդականությունը կանվանենք U1-ից Uk ճանապարհ, եթե
                                {U1, U2}, {U2, U3},...,{Uk, Uk-1}-ն G գրաֆի (շարունակել միտքը)։',
                                'level' => \App\Models\Question::LEVELS['middle'],
                                'answers' => [
                                    [
                                        'name' => 'asd',
                                        'is_true_answer' => 1
                                    ],
                                    [
                                        'name' => 'zxc',
                                        'is_true_answer' => 0
                                    ]
                                ]
                            ],
                            [
                                'name' => 'Ամեն մի գրաֆ միարժեք ձևով ներկայացվում է իր (լրացնել այս հատվածը) ուղիղ գումարի տեսքով։',
                                'level' => \App\Models\Question::LEVELS['middle'],
                                'answers' => [
                                    [
                                        'name' => 'asd',
                                        'is_true_answer' => 1
                                    ],
                                    [
                                        'name' => 'zxc',
                                        'is_true_answer' => 0
                                    ]
                                ]
                            ],
                            [
                                'name' => 'Էլյերյան ճանապարհ։',
                                'level' => \App\Models\Question::LEVELS['middle'],
                                'answers' => [
                                    [
                                        'name' => 'asd',
                                        'is_true_answer' => 1
                                    ],
                                    [
                                        'name' => 'zxc',
                                        'is_true_answer' => 0
                                    ]
                                ]
                            ]
                        ],
                        'keyWords' => [
                            'Ճանապարհ',
                            'Էյլերյան Ճանապարհ',
                        ]
                    ],
                ]
            ]
        ]
    ];
}
