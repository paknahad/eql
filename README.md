```
                                                                      
EEEEEEEEEEEEEEEEEEEEEE     QQQQQQQQQ     LLLLLLLLLLL                  
E::::::::::::::::::::E   QQ:::::::::QQ   L:::::::::L                  
E::::::::::::::::::::E QQ:::::::::::::QQ L:::::::::L                  
EE::::::EEEEEEEEE::::EQ:::::::QQQ:::::::QLL:::::::LL                  
  E:::::E       EEEEEEQ::::::O   Q::::::Q  L:::::L                    
  E:::::E             Q:::::O     Q:::::Q  L:::::L                    
  E::::::EEEEEEEEEE   Q:::::O     Q:::::Q  L:::::L                    
  E:::::::::::::::E   Q:::::O     Q:::::Q  L:::::L                    
  E:::::::::::::::E   Q:::::O     Q:::::Q  L:::::L                    
  E::::::EEEEEEEEEE   Q:::::O     Q:::::Q  L:::::L                    
  E:::::E             Q:::::O  QQQQ:::::Q  L:::::L                    
  E:::::E       EEEEEEQ::::::O Q::::::::Q  L:::::L         LLLLLL     
EE::::::EEEEEEEE:::::EQ:::::::QQ::::::::QLL:::::::LLLLLLLLL:::::L     
E::::::::::::::::::::E QQ::::::::::::::Q L::::::::::::::::::::::L     
E::::::::::::::::::::E   QQ:::::::::::Q  L::::::::::::::::::::::L     
EEEEEEEEEEEEEEEEEEEEEE     QQQQQQQQ::::QQLLLLLLLLLLLLLLLLLLLLLLLL     
                                   Q:::::Q                            
                                    QQQQQQ                                                                   
```

Overview
-----------


This project will a try to be a `php` equivalent of [elasticsql](https://github.com/cch123/elasticsql).

Currently support:

- [ ] sql and expression
- [ ] sql or expression
- [ ] equal(=) support
- [ ] not equal(!=) support
- [ ] gt(>) support
- [ ] gte(>=) support
- [ ] lt(<) support
- [ ] lte(<=) support
- [ ] sql in (eg. id in (1,2,3) ) expression
- [ ] sql not in (eg. id not in (1,2,3) ) expression
- [ ] paren bool support (eg. where (a=1 or b=1) and (c=1 or d=1))
- [ ] sql like expression (currently use match phrase, perhaps will change to wildcard in the future)
- [ ] sql order by support
- [ ] sql limit support
- [ ] sql not like expression
- [ ] field missing check
- [ ] support aggregation like count(\*), count(field), min(field), max(field), avg(field)
- [ ] support aggregation like stats(field), extended_stats(field), percentiles(field) which are not standard sql function
- [ ] null check expression(is null/is not null)
- [ ] join expression
- [ ] having support

Usage
-------------

`> composer require meysampg/eql`

Demo :
```php
<?php

namespace Sample;

use Meysampg\Eql\Parser;

$sql = "
select * from aaa
where a=1 and x = '三个男人'
and create_time between '2015-01-01T00:00:00+0800' and '2016-01-01T00:00:00+0800'
and process_id > 1 order by id desc limit 100,10
";

function main() 
{
    $dsl = Parser::buildFrom($sql);
    print_r(json_encode($dsl));
}

```

will produce :
```json
{
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
}
```

If your sql contains some keywords, eg. order, timestamp, don't forget to escape these fields as follows:

```
select * from `order` where `timestamp` = 1 and `desc`.id > 0
```

