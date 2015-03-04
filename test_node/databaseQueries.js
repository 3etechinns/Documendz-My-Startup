"use strict";
var globalDb = '',
    annotationDataCollection = '',
    annotationHistoryCollection = '',
    MongoClient = require('mongodb').MongoClient;
MongoClient.connect('mongodb://127.0.0.1:27017/annotationStorage', function(err, db) {
    if (err) {
     //   console.log("mongo db unconnected");
        console.log(err);
        //throw err; 
    } else {
        globalDb = db;
        annotationDataCollection = db.collection('annotationData');
        annotationHistoryCollection = db.collection('annotationHistory');
       // console.log("Connected to MongoDb");
    }
});


//Try to use single funtion for pull and push for different cases !! 


exports.fireQuery = function(data, type, userId, shareId) {

    //console.log(data);

    switch (type) {

        case "highlight":

            annotationDataCollection.update({
                "shareId": shareId
            }, {
                "$push": {
                    "highlight": {
                        "serializeData": data.serializeData,
                        "uniqueClass": data.uniqueClass,
                        "userId": userId
                    }
                }
            }, callBackHandler("Pushed HighLight :" + data.uniqueClass));

            break;

        case "remove-highlight":

        //    console.log("Removing HighLight");

            annotationDataCollection.update({
                "shareId": shareId
            }, {
                "$pull": {
                    "highlight": {
                        "uniqueClass": data
                    }
                }
            }, callBackHandler("Removed HighLight :" + data));

            pullHistory(data, shareId);
            break; // case remove-highlight ends

        case "strikeout":

            annotationDataCollection.update({
                "shareId": shareId
            }, {
                "$push": {
                    "strikeout": {
                        "serializeData": data.serializeData,
                        "uniqueClass": data.uniqueClass,
                        "userId": userId
                    }
                }
            }, callBackHandler("Strikeout Pushed :" + data.uniqueClass));

            break; // case strike out ends

        case "remove-strikeout":

         //   console.log("Removing Strike Out");
            //console.log(data);
            annotationDataCollection.update({
                "shareId": shareId
            }, {
                "$pull": {
                    "strikeout": {
                        "uniqueClass": data
                    }
                }
            }, callBackHandler("Strikeout Removed :" + data));
            pullHistory(data, shareId);

            break; // case remove-strikeout ends

        case "draw-create":

            data.userId = userId;

            annotationDataCollection.update({
                "shareId": shareId
            }, {
                "$push": {
                    "draw": data
                }
            }, callBackHandler("Draw Created : " + data.pathClass));

            break;

        case "remove-draw":

          //  console.log("Removing Draw");
            // console.log(data);

            annotationDataCollection.update({
                "shareId": shareId
            }, {
                "$pull": {
                    "draw": {
                        "pathClass": data.pathClass
                    }
                }
            }, callBackHandler("Draw Removed : " + data.pathClass));

            pullHistory(data.pathClass, shareId);

            break;

        case "textbox-new":
            data.userId = userId;
            annotationDataCollection.update({
                "shareId": shareId
            }, {
                "$push": {
                    "textBoxComment": data
                }
            }, callBackHandler("Pushed New textBoxComment :" + data.uniqueClass));

            break;

        case "textbox-update":


            break;

        case "delete-textbox":

           // console.log("Removing TextBox");
            // console.log(data);

            annotationDataCollection.update({
                "shareId": shareId
            }, {
                "$pull": {
                    "textBoxComment": {
                        "uniqueClass": data.uniqueClass
                    }
                }
            }, callBackHandler("Removed TextBox Comment :" + data.uniqueClass));

            pullHistory(data.uniqueClass, shareId);
            break;


        case "textbox-position-update":

      //  console.log("changing Position");
      //  console.log(data);

        annotationDataCollection.update({"shareId":shareId,"textBoxComment.uniqueClass":data.uniqueClass},{"$set":{"textBoxComment.$.x":data.x,"textBoxComment.$.y":data.y}},callBackHandler("Updated X and Y positions : " + data.uniqueClass));


            break;



        case "new-drop-comment":

            var comment = {
                content: data.content,
                liId: data.newLiId,
                userId: userId,
                userName: data.userName
            };
            delete data.newLiId;
            delete data.content;
            delete data.userName;
            data.comments = [];

            switch (data.cords.type) {



                case "drop":
                    annotationDataCollection.update({
                        "shareId": shareId
                    }, {
                        "$push": {
                            "pinComment": data
                        }
                    }, function(err, added) {
                        if (err) {
                            console.log(err);
                        } else {
                        //    console.log("Pushed New pinComment Data to Array for shareId : " + shareId);
                            pushComments(comment, data, shareId);
                        }
                    });



                    break; //case nested drop


                case "drag":

                    annotationDataCollection.update({
                        "shareId": shareId
                    }, {
                        "$push": {
                            "highlightComment": data
                        }
                    }, function(err, added) {
                        if (err) {
                      //      console.log(err);
                        } else {
                         //   console.log("Pushed New highlightComment Data to Array for shareId : " + shareId);
                            pushComments(comment, data, shareId);
                        }
                    });


                    break; // case nested drag

            }

            break; // mian case ends


        case "update-drop-comment":
            //console.log(data);

            var comment = {
                content: data.content,
                liId: data.newLiId,
                userId: userId,
                userName: data.userName
            };
            pushComments(comment, data, shareId);

            break;

        case "delete-drop-comment":



        // console.log(data);

        switch(data.type) {

            case "drop":

             annotationDataCollection.find({
                "shareId": shareId,
                "pinComment.uniqueClass": data.uniqueClass
            }, {
                "pinComment.$.comments": 1,
                "_id": 0
            }).toArray(function(err, results) {

                if (err) {
                    console.log(err);
                } else {

                   
                        if(results.length === 0) {
                      //      console.log("No such Comment Box");
                            pullHistory(data.uniqueClass, shareId);
                        }
                    else if (results[0].pinComment[0].comments.length > 1) {
 // console.log(results[0].pinComment[0].comments.length);
                        annotationDataCollection.update({
                            "shareId": shareId,
                            "pinComment.uniqueClass": data.uniqueClass
                        }, {
                            "$pull": {
                                "pinComment.$.comments": {
                                    "liId": data.delLiId
                                }
                            }
                        }, callBackHandler("PinComment Li Removed : LiId : " + data.delLiId));

                    } else {

                        annotationDataCollection.update({
                            "shareId": shareId,

                        }, {
                            "$pull": {
                                "pinComment": {
                                    "uniqueClass": data.uniqueClass
                                }
                            }
                        }, callBackHandler("Pin CommentBox Removed :" + data.uniqueClass));

                        pullHistory(data.uniqueClass, shareId);
                    }
                }
            });

            break;

            case "drag":

         //   console.log(data.uniqueClass);

             annotationDataCollection.find({
                "shareId": shareId,
                "highlightComment.uniqueClass": data.uniqueClass
            }, {
                "highlightComment.$.comments": 1,
                "_id": 0
            }).toArray(function(err, results) {

                if (err) {
                    console.log(err);
                } else {
                    //console.log(results[0].highlightComment[0].comments.length);
                    if (results[0].highlightComment[0].comments.length > 1) {

                        annotationDataCollection.update({
                            "shareId": shareId,
                            "highlightComment.uniqueClass": data.uniqueClass
                        }, {
                            "$pull": {
                                "highlightComment.$.comments": {
                                    "liId": data.delLiId
                                }
                            }
                        }, callBackHandler("HighLight Li Removed : LiId : " + data.delLiId));

                    } else {

                        annotationDataCollection.update({
                            "shareId": shareId,

                        }, {
                            "$pull": {
                                "highlightComment": {
                                    "uniqueClass": data.uniqueClass
                                }
                            }
                        }, callBackHandler("HighLight CommentBox Removed :" + data.uniqueClass));

                        pullHistory(data.uniqueClass, shareId);
                    }
                }
            });




            break;

        }
           



            break;



        case "add-history":
            //console.log(data);
            data.userId = userId;
            annotationHistoryCollection.update({
                "shareId": shareId
            }, {
                "$push": {
                    "history": data
                }
            }, callBackHandler("Pushed History " + data.anno_type));



            break;

        case "update-history":

         //   console.log(data);

            break;

            case "remove-comment-ul":

           // console.log("Removing Comment Ul");
          //  console.log(data);

            annotationDataCollection.update({"shareId":shareId}, {"$pull":{"highlightComment":{"uniqueClass":data.uniqueClass}}}, callBackHandler("Removed Comment Box Ul :"+ data.uniqueClass));

            break;

    }

};



exports.checkDocumentExist = function(shareId) {

    annotationDataCollection.find({
        shareId: shareId
    }).toArray(function(err, results) {
        //console.log(results);
        if (results.length > 0) {
         //   console.log("Document Exist shareid " + shareId);

        } else {

            annotationDataCollection.insert({
                "shareId": shareId,
                "highlight": [],
                "strikeout": [],
                "textBoxComment": [],
                "pinComment": [],
                "highlightComment": [],
                "draw": []
            }, function(err, res) {
                if (err) {
                    console.log(err);
                } else {
              //      console.log("Annotation Document Creatred for shareId : " + shareId)
                }
            });
         //   console.log("Creating New Annotation and History Document for shareid : " + shareId);


            annotationHistoryCollection.insert({
                "shareId": shareId,
                "history": []
            }, function(err, res) {
                if (err) {
                    console.log(err);
                } else {
             //       console.log(" History Document Creatred for shareId : " + shareId)
                }
            });
        }

    });


};

exports.pullAnnotationData = function(req, res) {
    var shareId = req.param('shareid');
    annotationDataCollection.find({shareId:shareId}).sort({"pinComment.cords.boxY":1}).toArray(function(err,results){
        if(err) {
            console.log(err);
            res.send({error:true});
        } else {
      //  console.log("API called");
       // console.log(results);
        res.send({error:false,data:results});    
        }     

    });
}
    exports.pullHistoryData = function(req, res) {
    var shareId = req.param('shareid');
    annotationHistoryCollection.find({shareId:shareId}).toArray(function(err,results){
        if(err) {
            console.log(err);
             res.send({error:true});
        } else {
     //   console.log("History API called");
       // console.log(results);
         res.send({error:false,data:results});    
        }     

    });

     // db.annotationData.aggregate({$match:{shareId:"15"}},{$unwind:'$pinComment'},{$sort:{'pinComment.cords.boxY':1}}, function(er))


}

function pushComments(comment, data, shareId) {
    //console.log(data);

    switch (data.cords.type) {

        case "drop":
            annotationDataCollection.update({
                "shareId": shareId,
                'pinComment.uniqueClass': data.uniqueClass
            }, {
                "$push": {
                    'pinComment.$.comments': comment
                }
            }, callBackHandler("Push Drop Comment " + data.uniqueClass));
            break;
        case "drag":

            annotationDataCollection.update({
                "shareId": shareId,
                'highlightComment.uniqueClass': data.uniqueClass
            }, {
                "$push": {
                    'highlightComment.$.comments': comment
                }
            }, callBackHandler("Push HighLight Comment :" + data.uniqueClass));


            break;
    }


};


function pullHistory(uniqueClass, shareId) {

  //  console.log("Removing History : " + uniqueClass)

    annotationHistoryCollection.update({
        "shareId": shareId
    }, {
        "$pull": {
            "history": {
                "append_class": uniqueClass
            }
        }
    }, callBackHandler("Removed History: " + uniqueClass));
}


//Callback handling can be done using one function

function callBackHandler(type) {

    return function(err, results) {
        if (err) {
            console.log(err);
        } else if (!results) {
      //      console.log("Error " + type);
        } else {
     //       console.log("SucessfUll in " + type);
        }
    }

}