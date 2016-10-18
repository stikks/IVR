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
},function(error,exists){
	if (exists == true){
	 	console.log("This exists")
	}else{
	 	client.indices.create({  
			index: 'ivr'
		},function(err,resp,status) {
			if(err) {
			   console.log("This works");
			}
			else {
			    console.log("create",resp);
			}
		});
	}
});

//Indexing into a type
router.post('/elasticsearch/:type/create', function(req, res, next){
    res.render('index', { title: req.params.type });

  // check or create index type
  if(req.params.type == "campaign"){
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
      body: {
        "name": req.body.name,
        "created_at": cat,
        "updated_at": uat,
        "scheduled_time": req.body.scheduled_time,
        "file_path": req.body.file_path,
        "start_date": sd,
        "end_date" : ed
      }
    },function(err,resp,status) {
        console.log(resp);
    });
  }else if(req.params.type =="campaign_status"){
    var cat = new Date(req.body.created_at);
    var uat = new Date(req.body.updated_at);
    cat.toDateString;
    uat.toDateString;
      client.index({  
      index: 'ivr',
      type: req.params.type,
      body: {
        "campaign_id": req.body.campaign_id,
        "created_at": cat,
        "updated_at": uat,
        "success_count" : req.body.success_count
      }
    },function(err,resp,status) {
        console.log(resp);
        return resp;
    });
  }else if(req.params.type == "cdr"){

      client.index({  
        index: 'cdr',
        //id: req.body.id,
        type: req.params.type,
        body: {
          "accountcwode" : req.body.accountcode,
          "src" : req.body.src,
          "dst" : req.body.dst,
          "dcontext" : req.body.dcontext,
          "clid" : req.body.clid,
          "channel" : req.body.channel,
          "dstchannel" : req.body.dstchannel,
          "lastapp" : req.body.lastapp,
          "lastdata" : req.body.lastdata,
          "start" : req.body.start,
          "answer" : req.body.answer,
          "end" : req.body.end,
          "duration" : req.body.duration,
          "billsec" : req.body.billsec,
          "disposition" : req.body.disposition,
          "amaflags" : req.body.amaflags,
          "userfield" : req.body.userfield,
          "uniqueid" : req.body.campaign_id,
          "is_successful" : req.body.is_successful,
          "is_clicked" : req.body.is_clicked
        }
      },function(err,resp,status) {
          console.log(resp);
          return resp;
      });
    }else{
    res.render('index', { title: 'Wrong type, please provide a valid type' });
  }
});

//crd wherre unigue id == campaign_id and billsec > 25


/*Number of campaign over a certain period*/
router.get('/no_of_campaign', function(req, res, next) {

  var sevenDays = new Date(new Date().getTime()-(7*24*60*60*1000));
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
                        "range" : {
                            "created_at" : {
                                "gte": sevenDays, 
                                "lte": today.
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
router.get('/impressions/:campaign_id', function(req, res, next){
    var sevenDays = new Date(new Date().getTime()-(7*24*60*60*1000));
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
    }).then(function(resp){
        var result = resp.hits.hits;

        var ar = groupBy(result, "created_at");

        var cat = Object.keys(ar);
    })

});
 

var groupBy = function(xs, key) {
    return xs.reduce(function(rv, x) {
        (rv[x[key]] = rv[x[key]] || []).push(x); 
        return rv; 
    }, {
        
    }
    ); 
}; 


/* GET elastic listing. */
router.get('/', function(req, res, next) {
  res.send('respond with a resource');
});

module.exports = router;
