<?php
/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 8/4/16
 * Time: 6:10 PM
 */
require 'app.php';

$container = $app->getContainer();
$db = $container->get('settings')['db'];
$pdo = new PDO('pgsql:dbname='.$db['database'].';host=localhost;user='.$db['username'].';password='.$db['password']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$list = array();    
    $users = "CREATE TABLE IF NOT EXISTS users (
        id serial,
	username varchar (50) PRIMARY KEY,
	password varchar (255) NOT NULL,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	created_at date
	);";

array_push($list, $users);

$campaigns = "CREATE TABLE IF NOT EXISTS campaigns(
  id serial PRIMARY KEY,
  username varchar REFERENCES users(username) NOT NULL,
  name VARCHAR (255) NOT NULL,
  description VARCHAR (255) NULL,
  file_path VARCHAR (255) NOT NULL,
  start_date date DEFAULT NULL,
  end_date date DEFAULT NULL,
  scheduled_time TIME DEFAULT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  created_at date DEFAULT NULL
);";

array_push($list, $campaigns);

$actions = "CREATE TABLE IF NOT EXISTS actions(
  id serial,
  campaign_id INTEGER REFERENCES campaigns(id) NOT NULL,
  number INTEGER NOT NULL,
  body VARCHAR (255) NOT NULL,
  value VARCHAR (255) NOT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  created_at date DEFAULT NULL
);";

array_push($list, $actions);

$files = "CREATE TABLE IF NOT EXISTS files(
  id serial PRIMARY KEY,
  name VARCHAR (255) NOT NULL,
  description VARCHAR (255) NOT NULL,
  size FLOAT NOT NULL,
  username varchar REFERENCES users(username) NOT NULL,
  file_path VARCHAR (255) NOT NULL,
  file_type VARCHAR (255) NOT NULL,
  duration VARCHAR (255) NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  created_at date DEFAULT NULL
);";

array_push($list, $files);

foreach ($list as $data) {
    $pdo->exec($data);
}

$tm30 = "INSERT INTO users
  (username , password)
VALUES
  ('tm30', '3243f9d5a6af570fc9ed94186a3749bb8c562c848c6db3b658706c442fd397c02fc4f798a75c5c655fd6870e5cc41ede5d27948327a00b64654ee1a688a755ca');";

$obj = $pdo->prepare($tm30);
$obj->execute();

$et = "INSERT INTO users
  (username , password)
VALUES
  ('etisalat', '1bdb096ea8faa59bd83b2024249f8ea2a1162d006ae12be99fd181998d1498029d8cd35e1515793021cfa07706b9e7b639d5e89e223f600b254848108eff6d1c');";

$obj = $pdo->prepare($et);
$obj->execute();

//$subscribers = "CREATE TABLE IF NOT EXISTS subscriber(
//  id serial PRIMARY KEY,
//  name varchar(100) NOT NULL,
//  msisdn VARCHAR (255) NOT NULL UNIQUE,
//  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//  created_at date DEFAULT NULL
//);";
//
//array_push($list, $subscribers);

//$details = "CREATE TABLE IF NOT EXISTS user_details(
//  id serial PRIMARY KEY,
//  password varchar(255) NOT NULL,
//  email varchar(100) NOT NULL UNIQUE,
//  phone varchar REFERENCES users(phone),
//  user_id INT NOT NULL,
//  uid int NOT NULL,
//  gid int NOT NULL,
//  realname VARCHAR (255),
//  first_name VARCHAR (255),
//  last_name VARCHAR (255),
//  address VARCHAR (255),
//  country VARCHAR (255),
//  website_url VARCHAR (255) NOT NULL,
//  maildir VARCHAR (100) NOT NULL,
//  institution VARCHAR (255) NULL,
//  graduation_date DATE DEFAULT NULL,
//  company_name VARCHAR (255) NULL,
//  work_period DATE DEFAULT NULL,
//  web_notification BOOL DEFAULT FALSE,
//  push_notification BOOL DEFAULT FALSE,
//  mobile_notification BOOL DEFAULT FALSE,
//  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//  created_at date DEFAULT NULL
//);";
//
//array_push($list, $details);

//$_sql = "CREATE TABLE IF NOT EXISTS virtual_domains (
//  id serial PRIMARY KEY,
//  name varchar(50) NOT NULL,
//  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//  created_at date DEFAULT NULL
//) ;";
//
//array_push($list, $_sql);
//
//$qsql = "CREATE TABLE IF NOT EXISTS user_details (
//  id serial PRIMARY KEY,
//  domain_id int NOT NULL,
//  user_phone varchar (50) NOT NULL,
//  password varchar(106) NOT NULL,
//  email varchar(100) NOT NULL UNIQUE,
//  website_url VARCHAR (255) NOT NULL,
//  FOREIGN KEY (user_phone) REFERENCES users(phone),
//  FOREIGN key (domain_id) REFERENCES virtual_domains(id),
//  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//  created_at DATE DEFAULT NULL
//)";
//
//array_push($list, $qsql);
//
//$rsql = "CREATE TABLE IF NOT EXISTS virtual_aliases (
//  id serial PRIMARY KEY,
//  domain_id int NOT NULL,
//  source varchar(100) NOT NULL,
//  destination varchar(100) NOT NULL,
//  FOREIGN KEY (domain_id) REFERENCES virtual_domains(id) ON DELETE CASCADE,
//  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//  created_at DATE DEFAULT NULL
//);";
