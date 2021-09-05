Hello worlds!

<? 

echo '<pre>';


// Test PHP
echo "PHP working! (".phpversion().") ".time()."\n";


// Test composer packages working
if(file_exists('/var/www/html/vendor/autoload.php')){
 require_once '/var/www/html/vendor/autoload.php';
 $dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/','test.env');
 $dotenv->load();
 if($_ENV['TEST'] == 'example'){
     echo "Composer and .env variables working!\n";
 }
}else{
  echo "Composer not set up, run: `docker-compose run --rm composer update`\n";
}


// Test redis
try {
    $redis = new Redis();

    if (!$redis->connect('redis', 6379)) {
        throw new \Exception('Redis failed to connect');
    }
    echo 'Redis working!';
} catch (\Exception $e) {
    echo '* Redis Exception * '.$e->getMessage();
}
echo "\n";

// Test MySQL
$dbname = 'db_name';
$dbuser = 'db_user';
$dbpass = 'db_pass';
$dbhost = 'mysql';

$dsn = 'mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8mb4';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try{
$pdo = new PDO($dsn, $dbuser, $dbpass, $options);
$stmt = $pdo->prepare('SELECT DATABASE()');
    if($stmt->execute()){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "MySQL is working! (DB: {$dbname} User: {$dbuser} Pass: {$dbpass})\n";
    }
}catch(PDOException $ex){
        echo  $ex->getMessage();
}
