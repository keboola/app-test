<?php

require ('vendor/autoload.php');
ob_implicit_flush(true);

$errHandler = new Monolog\Handler\StreamHandler('php://stderr', \Monolog\Logger::NOTICE, false);
$handler = new Monolog\Handler\StreamHandler('php://stdout', \Monolog\Logger::INFO);
$logger = new Monolog\Logger("logger", [$errHandler, $handler]);
$logger->info("M: info");
$logger->error("M: error");

class UserException extends Exception
{
}

class ApplicationException extends Exception
{
}

function a(Monolog\Logger $logger)
{
	$logger->info("MI: a");
	echo "I'm an a";
	sleep(2);
	$logger->error("ME: a");
	b($logger);
}

function b(Monolog\Logger $logger)
{
	$logger->info("MI: b");
	echo "I'm a b";
	sleep(2);
	$logger->error("ME: b");
	c($logger);
}

function c(Monolog\Logger $logger)
{
	$logger->info("MI: c");
	echo "I'm a c";
	sleep(2);
	$logger->error("ME: c");	
	d($logger);
}

function d(Monolog\Logger $logger)
{
	$logger->info("MI: d");
	echo "I'm a d and throwing up";
	sleep(2);
	$logger->error("ME: d");	
	throw new UserException("kilim idai");
	//throw new ApplicationException("kilim idai pinis");
}

try {
	echo "Hello world";
	a($logger);
	echo "Finished";
} catch (UserException $e) {
	$logger->info("First catch");
	echo "UserException caught " . $e->getMessage();
	sleep(2);
	$logger->error("UEC" . $e->getMessage());
	exit(1);
} catch (Exception $e) {
	$logger->info("Second catch");
	echo "Other exception caught " . $e->getMessage();
	sleep(2);
	$logger->error("AEC" . $e->getMessage());
    $logger->log('error', $e->getMessage(), [
        'errFile' => $e->getFile(),
        'errLine' => $e->getLine(),
        'code' => $e->getCode(),
        'trace' => $e->getTrace()
    ]);
	exit(2);
}
