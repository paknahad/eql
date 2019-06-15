<?php

return [
     [
          'sql' => "select * from aaa
where a=1 and x = '三个男人'
and create_time between '2015-01-01T00:00:00+0800' and '2016-01-01T00:00:00+0800'
and process_id > 1 order by id desc limit 100,10",
          'dsl' => '{
    "query": {
        "bool": {
            "must": [
                {
                    "match": {
                        "a": {
                            "query": "1",
                            "type": "phrase"
                        }
                    }
                },
                {
                    "match": {
                        "x": {
                            "query": "三个男人",
                            "type": "phrase"
                        }
                    }
                },
                {
                    "range": {
                        "create_time": {
                            "from": "2015-01-01T00:00:00+0800",
                            "to": "2016-01-01T00:00:00+0800"
                        }
                    }
                },
                {
                    "range": {
                        "process_id": {
                            "gt": "1"
                        }
                    }
                }
            ]
        }
    },
    "from": 100,
    "size": 10,
    "sort": [
        {
            "id": "desc"
        }
    ]
}',
     ],
     //[
     // and some other cases in
     // 'sql' => 'QUERY GOES HERE',
     // 'dsl' => 'ES DSL GOES HERE',
     //],
];
