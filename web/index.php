<?php
require __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../src/views',
));
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\SwiftmailerServiceProvider(), array(
    'transport' => 'mail',
    'host' => 'smtp.1and1.fr',
    'port' => 25,
    'username' => 'noreply@anis-safine.fr',
    'password' => 'ApqmwnxdR_19891',
));

$app->get('/', 'Anis\\SecretSanta\\Controller\\IndexController::formAction');
$app->post('/', 'Anis\\SecretSanta\\Controller\\IndexController::sendAction');

$app->run();
