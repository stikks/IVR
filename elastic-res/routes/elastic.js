var express = require('express');
var router = express.Router();
var elasticsearch = require('elasticsearch');

//connect to elastic search
var client = elasticsearch.Client({
    host: 'localhost:9200',
    log: 'trace'
});

client.ping({
    // ping usually has a 3000ms timeout
    requestTimeout: Infinity,
    // undocumented params are appended to the query string
    hello: "elasticsearch!"
}, function (error) {
    if (error) {
        console.log(error);
        console.trace('elasticsearch cluster is down!');
    } else {
        console.log('All is well');
    }
});

//Check if index exist or create it 
client.exists({
    index: 'ivr'
}, function (error, exists) {
    if (exists == true) {
        console.log("This exists")
    } else {
        client.indices.create({
            index: 'ivr'
        }, function (err, resp, status) {
            if (err) {
                console.log("This works");
            }
            else {
                console.log("create", resp);
            }
        });
    }
});

//Indexing into a type
router.post('/elasticsearch/:type/create', function (req, res, next) {

    if (req.body.name == null && req.body.created_at == null &&
        req.body.updated_at == null && req.body.start_date == null &&
        req.body.end_date == null && req.body.file_path == null && req.body.scheduled_time == null) {
        res.setHeader('Content-Type', 'application/json');
        res.send(JSON.stringify({message: 'Missing parameters'}));
    } else {
        // check or create index type
        if (req.params.type == "campaign") {
            var cat = new Date(req.body.created_at);
            var uat = new Date(req.body.updated_at);
            var sd = new Date(req.body.start_date);
            var ed = new Date(req.body.end_date);
            cat.toDateString
            uat.toDateString
            sd.toDateString
            ed.toDateString

            client.index({
                index: 'ivr',
                type: req.params.type,
                id: req.body.id,
                body: {
                    "name": req.body.name,
                    "description": req.body.description,
                    "username": req.body.username,
                    "is_active": req.body.is_active,
                    "file_path": req.body.file_path,
                    "created_at": cat,
                    "updated_at": uat,
                    "start_date": sd,
                    "end_date": ed
                }
            }, function (err, resp, status) {
                res.setHeader('Content-Type', 'application/json');
                res.send(JSON.stringify({response: resp, error: err, status: status}));
            });
        } else if (req.params.type == "statuses") {
            var cat = new Date(req.body.created_at);
            var uat = new Date(req.body.updated_at);
            cat.toDateString;
            uat.toDateString;
            client.index({
                index: 'ivr',
                type: req.params.type,
                id: req.body.id,
                body: {
                    "campaign_id": req.body.campaign_id,
                    "impressions_count": req.body.impressions_count,
                    "success_count": req.body.success_count,
                    "created_at": cat,
                    "updated_at": uat
                }
            }, function (err, resp, status) {
                res.setHeader('Content-Type', 'application/json');
                res.send(JSON.stringify({response: resp, error: err, status: status}));
            });
        } else if (req.params.type == "cdr") {
            var cat = new Date(req.body.created_at);
            var uat = new Date(req.body.updated_at);
            cat.toDateString;
            uat.toDateString;
            client.index({
                index: 'cdr',
                id: req.body.id,
                type: req.params.type,
                body: {
                    "accountcode": req.body.accountcode,
                    "src": req.body.src,
                    "dst": req.body.dst,
                    "dcontext": req.body.dcontext,
                    "clid": req.body.clid,
                    "channel": req.body.channel,
                    "dstchannel": req.body.dstchannel,
                    "lastapp": req.body.lastapp,
                    "lastdata": req.body.lastdata,
                    "start": req.body.start,
                    "answer": req.body.answer,
                    "end": req.body.end,
                    "duration": req.body.duration,
                    "billsec": req.body.billsec,
                    "disposition": req.body.disposition,
                    "amaflags": req.body.amaflags,
                    "userfield": req.body.userfield,
                    "uniqueid": req.body.uniqueid,
                    //custom fields that need to be updated in db
                    "impression": req.body.impression,
                    "is_clicked": req.body.is_clicked,
                    "created_at": cat,
                    "updated_at": uat
                }
            }, function (err, resp, status) {
                res.setHeader('Content-Type', 'application/json');
                res.send(JSON.stringify({response: resp, error: err}));
            });
        } else {
            res.setHeader('Content-Type', 'application/json');
            res.send(JSON.stringify({error: 'Wrong type, please provide a valid type'}));
        }
    }
});

//crd wherre unigue id == campaign_id and billsec > 25


/*Number of campaign over a certain period*/
router.get('/no_of_campaign', function (req, res, next) {

    var sevenDays = new Date(new Date().getTime() - (7 * 24 * 60 * 60 * 1000));
    var today = new Date()
    sevenDays.toDateString
    today.toDateString
    //Add javacript check date
    client.search({
        index: "ivr",
        type: "campaign",
        body: {
            "query": {
                "constant_score": {
                    "filter": {
                        "range": {
                            "created_at": {
                                "gte": sevenDays,
                                "lte": today
                            }
                        }
                    }
                }
            }
        }
    }).then(function (resp) {
        var result = resp.hits.hits;

        var ar = groupBy(result, "created_at");

        var cat = Object.keys(ar);

        var data = {"series": res, "text": 'Campaign Impressions', "subtitle": "ivr", "categories": cat}
        return data
    }, function (err) {
        console.trace(err.message);
    });
});


//Campign impressions
router.get('/impressions/:campaign_id', function (req, res, next) {
    var sevenDays = new Date(new Date().getTime() - (7 * 24 * 60 * 60 * 1000));
    var today = new Date()
    sevenDays.toDateString
    today.toDateString

    client.search({
        index: "ivr",
        type: "cdr",
        body: {
            "query": {
                "constant_score": {
                    "filter": {
                        "bool": {
                            "must": [
                                {
                                    "term": {
                                        "uniqueid": body.params.campaign_id
                                    }
                                }
                            ],
                            "should": [
                                {
                                    "range": {
                                        "start": {
                                            "from": sevenDays,
                                            "to": today
                                        }
                                    }
                                }
                            ]
                        }
                    }
                }
            }
        }
    }).then(function (resp) {
        var result = resp.hits.hits;

        var ar = groupBy(result, "created_at");

        var cat = Object.keys(ar);
    })

});


var groupBy = function (xs, key) {
    return xs.reduce(function (rv, x) {
            (rv[x[key]] = rv[x[key]] || []).push(x);
            return rv;
        }, {}
    );
};


/* GET elastic listing. */
router.get('/', function (req, res, next) {
    res.send('respond with a resource');
});

module.exports = router;
