// Chat.JS
// William Moody
// 21.03.2021

// Database connection 
var MongoClient = require('mongodb').MongoClient;
var db_url = "mongodb://localhost:27017/";

// Necessary packages for authentication
var session = require('express-session');
var bodyParser = require('body-parser');
var crypto = require('crypto');

// Necessary packages for drafts
var cookieParser = require('cookie-parser');
var serialize = require('node-serialize');

// Web-App framework
var express = require('express');
var app = new express();
var port = 3000;

// Set some Express.JS settings
app.set('view engine', 'ejs');
app.use('/public', express.static('public'));
app.use(session({
    secret: 'c02b7d24a066adb747fdeb12deb21bfa',
    resave: true,
    saveUninitialized: true
}));
app.use(bodyParser.urlencoded({extended: true}));
app.use(bodyParser.json());
app.use(cookieParser());

/**
 * Home page
 * 
 * Unauthenticated users may read chat
 * Authenticated users may post messages
 * 
 * Limits messages retrieved to 100 to keep loading times short
 */
app.get('/', function(req, res) {
    console.log('[*] ' + req.ip + ' > GET /');
    MongoClient.connect(db_url, { useNewUrlParser:true, useUnifiedTopology:true }, function(err, db) {
        if (err) {
            throw err;
        }
        var dbo = db.db("chatjs");
        dbo.collection("messages").aggregate([
            {
                $lookup:  {
                    from: 'users', 
                    localField: 'author', 
                    foreignField: '_id', 
                    as: 'author'
                }
            },
            {
                $sort: { 
                    datetime: -1 
                }
            },
            {
                $limit: 100
            }
        ]).toArray(function(err, result) {
            if (err) {
                throw err;
            }
            var draft = null;
            if (req.session.logged_in && req.cookies.draft) {
                draft = serialize.unserialize(new Buffer(req.cookies.draft, 'base64').toString()).msg;
            }
            res.render('pages/index', {messages: result, session: req.session, draft:draft});
            db.close();
        });
    });
});

/**
 * Register page
 * 
 * Authenticated users can't see this
 */
app.get('/register', function(req, res) {
    console.log('[*] ' + req.ip + ' > GET /register');
    if (req.session.logged_in == true) {
        res.redirect('/');
    }
    else {
        res.render('pages/register', {session: req.session, error:null});
    }
});

/**
 * Register API
 * 
 * Requests from Authenticated users are ignored
 * 
 * Checks if the username exists already before registering a
 * new account
 * 
 * Request body: {username: ..., password: ...}
 */
app.post('/register', function(req, res) {
    console.log('[*] ' + req.ip + ' > POST /register');
    if (req.session.logged_in == true) {
        res.redirect('/');
    } else {
        var username = req.body.username;
        var password = req.body.password;
        if (username && password) {
            MongoClient.connect(db_url, { useNewUrlParser:true, useUnifiedTopology:true }, function(err, db) {
                if (err) {
                    throw err;
                }
                var dbo = db.db("chatjs");
                var query = {$where: `this.username == '${username}'`};
                dbo.collection("users").findOne(query, function(err, result) {
                    if (err) {
                        throw err;
                    }
                    if (result == null) {
                        // TODO: Actually insert new users
                        
                        // var sha256_password = crypto.createHash('sha256').update(password).digest('hex');
                        // dbo.collection("users").insertOne({
                        //     username:username,
                        //     password:sha256_password
                        // },function() {
                        //     res.redirect('/');
                        // });
                        res.redirect('/');
                    } else {
                        res.render('pages/register', {session: req.session, error:"User already exists"});
                    }
                });
            });
        }
    }
});

/**
 * Authentication API
 * 
 * Ignores requests from authenticated users
 * 
 * Request body: {username:..., password:...}
 */
app.post('/auth', function(req, res) {
    console.log('[*] ' + req.ip + ' > POST /auth');
    if (req.session.logged_in == true) {
        res.redirect('/');
    } else {
        var username = req.body.username;
        var password = req.body.password;
        if (username && password) {
            MongoClient.connect(db_url, { useNewUrlParser:true, useUnifiedTopology:true }, function(err, db) {
                if (err) {
                    throw err;
                }
                var dbo = db.db("chatjs");
                var sha256_password = crypto.createHash('sha256').update(password).digest('hex');
                dbo.collection("users").findOne({ username:username, password:sha256_password }, function(err, result) {
                    if (err) {
                        throw err;
                    }
                    if (result) {
                        req.session.logged_in = true;
                        req.session.username = username;
                        req.session.user_id = result._id;
                    } 
                    req.session.save();
                    db.close();
                });
            });
        }
        res.redirect('/');
    }
});

/**
 * Logout API
 * 
 * Ignores requests from unauthenticated users
 */
app.post('/logout', function(req, res) {
    console.log('[*] ' + req.ip + ' > POST /logout');
    if (req.session.logged_in == true) {
        req.session.destroy();
    }
    res.redirect('/');
});

/**
 * Send API (Post or Save a message)
 * 
 * Ignores requests from unauthenticated users
 * 
 * Request body: {message:..., [post:'' | save:'']}
 */
app.post('/send', function(req, res) {
    console.log('[*] ' + req.ip + ' > POST /send');
    if (req.session.logged_in == true && req.body.message) {
        var post = req.body.post;
        var save = req.body.save;
        if (post != null) {
            res.cookie('draft','',{expires:new Date()});
            console.log('    -- Post');
            MongoClient.connect(db_url, { useNewUrlParser:true, useUnifiedTopology:true }, function(err, db) {
                if (err) {
                    throw err;
                }
                var dbo = db.db("chatjs");
                dbo.collection('messages').insertOne({
                    author:req.session.user_id,
                    datetime:new Date(),
                    text:req.body.message
                }, function() {
                    db.close();
                });
            });
        } else if (save != null) {
            console.log('    -- Save');
            var cookie_val = Buffer.from(serialize.serialize({'msg':req.body.message})).toString('base64');
            res.cookie('draft',cookie_val,{maxAge:900000,httpOnly:true});
        }
    }
    res.redirect('/');
});

// Entrypoint
app.listen(port, function() {
    console.log('[+] Chat.JS is running on port ' + port);
});