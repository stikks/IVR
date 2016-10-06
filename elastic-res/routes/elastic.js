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


router.post('/elasticsearch/:type/create', function(req, res, next){
    res.render('index', { title: req.params.type });

  // check or create index type
  if(req.params.type == "campaign"){
    client.index({  
      index: 'ivr',
      type: req.params.type,
      body: {
        "name": req.body.name,
        "created_at": req.body.created_at,
        "updated_at": req.body.updated_At,
        "scheduled_time": req.body.scheduled_time,
        "file_path": req.body.file_path,
        "start_date": req.body.start_date,
        "end_date" : req.body.end_date
      }
    },function(err,resp,status) {
        console.log(resp);
    });
  }else if(req.params.type =="campaign_status"){
      client.index({  
      index: 'ivr',
      type: req.params.type,
      body: {
        "campaign_id": req.body.campaign_id,
        "created_at": req.body.created_at,
        "updated_at": req.body.updated_At,
        "success_count" : req.body.success_count
      }
    },function(err,resp,status) {
        console.log(resp);
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
      });
    }else{
    res.render('index', { title: 'Wrong type, please provide a valid type' });
  }
});

/* GET elastic listing. */
router.get('/', function(req, res, next) {
  res.send('respond with a resource');
});

module.exports = router;
