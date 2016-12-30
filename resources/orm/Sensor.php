<?php
namespace ORM;

class Sensor {
  static function count() {
    $cursor = \ORM\MongoDB::count('sensors', []);
    return $cursor;
  }

  static function chart_data(array $argvs = []) {
    $cursor = \ORM\MongoDB::aggregate('sensor_log', [ [
        '$match' => [
          'type' => 'temperature',
          'uniqueid' => $argvs['uniqueid']
        ]
      ], [
        '$group' => [
            '_id' => [
              'year' => [ '$year' => '$created_at' ],
              'month' => [ '$month' => '$created_at' ],
              'day' => [ '$dayOfMonth' => '$created_at' ],
              'hour' => [ '$hour' => '$created_at' ],
              'interval' => [
                '$subtract' => [
                  ['$minute' => '$created_at'],
                  ['$mod' => [
                      ['$minute' => '$created_at'],
                      $argvs['interval']
                    ]
                  ]
                ]
              ]
            ],
          "count" => [ '$sum' => 1 ],
          "avgTemp" => ['$avg' => '$state.value']
        ]
      ],
      ['$limit' => $argvs['limit']],
      ['$sort' => [ '_id' => -1 ] ]
    ]);

    $data = [];
    foreach($cursor AS $val) {
      $data[] = [
        'date' => $val['_id'],
        'temp' => round($val['avgTemp'] / 100,2)
      ];
    }

    return array_reverse($data);
  }
}
?>
