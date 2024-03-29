<?php
require 'vendor/autoload.php';
require 'app/app.php';

use Mongrel2\Connection;

$sender_id = "82209006-86FF-4982-B5EA-D1E29E55D481";
$conn = new Connection($sender_id, "tcp://127.0.0.1:9997", "tcp://127.0.0.1:9996");

while (true)
{
  $req = $conn->recv();

  if ($req->is_disconnect()) {
    continue;
  }

  $app->set_request($req, \Tertius\Request::TYPE_MONGREL);
  $app->run($conn, $req);
}
