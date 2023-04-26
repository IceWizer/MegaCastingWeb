<?php
namespace Deployer;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__.'/vendor/autoload.php';

require 'recipe/symfony.php';
set('env', [
    'SYMFONY_ENV' => 'dev',
    'APP_ENV' => 'dev'
]);

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__.'/.env');


// Project name
set('application', 'app');
set('http_user', 'www-data');
set('writable_mode', 'chmod');
set('bin/console', '{{release_path}}/bin/console');
set('branch', 'main');

// Hosts
host($_ENV['DEPLOYER_REPO_HOST'])
    ->setRemoteUser('adminlocal')
    ->setHostname($_ENV['DEPLOYER_REPO_HOSTNAME'])
    ->setPort($_ENV['DEPLOYER_REPO_PORT'])
    ->set('deploy_path', '/var/www/symfony');

set('keep_releases', 3);

// Project repository
set('repository', $_ENV['DEPLOYER_REPO_URL']);

// [Optional] Allocate tty for git clone. Default value is false.
//set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
//add('writable_dirs', []);
set('allow_anonymous_stats', false);
set('composer_options', " --verbose --prefer-dist --no-progress --no-interaction  --optimize-autoloader");

// Tasks
task('set:env', function () {
    upload(dirname(__FILE__).'/.env.prod.local', '/var/www/symfony/release/.env');
});
after('deploy:update_code', 'set:env');

task('build:npm-composer', function () {
    run('cd {{release_path}} && composer install --optimize-autoloader');
    run('cd {{release_path}} && npm install && npm run build');
    run('sudo chmod 777 -R {{release_path}}');
    //run('sudo chown www-data:www-data -R {{release_path}}');
});
before('deploy:symlink', 'build:npm-composer');

// Migrate database before symlink new release.
task('database:create', function () {
    run('{{bin/php}} {{bin/console}} doctrine:database:create --if-not-exists --env=dev');
});
before('database:migrate', 'database:create');
before('deploy:symlink', 'database:migrate');


task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'deploy:cache:clear',
    'deploy:publish'
])->desc('Déploiement de Megacasting');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

