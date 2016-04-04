<?php

namespace Puli;

use Puli\Discovery\Api\Discovery;
use Puli\Discovery\Binding\Initializer\ResourceBindingInitializer;
use Puli\Discovery\JsonDiscovery;
use Puli\Manager\Api\Server\ServerCollection;
use Puli\Repository\Api\ResourceRepository;
use Puli\Repository\JsonRepository;
use Puli\UrlGenerator\Api\UrlGenerator;
use Puli\UrlGenerator\DiscoveryUrlGenerator;
use RuntimeException;

/**
 * Creates Puli's core services.
 *
 * This class was auto-generated by Puli.
 *
 * IMPORTANT: Before modifying the code below, set the "factory.auto-generate"
 * configuration key to false:
 *
 *     $ puli config factory.auto-generate false
 *
 * Otherwise any modifications will be overwritten!
 */
class GeneratedPuliFactory
{
    /**
     * Creates the resource repository.
     *
     * @return ResourceRepository The created resource repository.
     */
    public function createRepository()
    {
        if (!interface_exists('Puli\Repository\Api\ResourceRepository')) {
            throw new RuntimeException('Please install puli/repository to create ResourceRepository instances.');
        }

        $repo = new JsonRepository(__DIR__.'/path-mappings.json', __DIR__.'/..', true);

        return $repo;
    }

    /**
     * Creates the resource discovery.
     *
     * @param ResourceRepository $repo The resource repository to read from.
     *
     * @return Discovery The created discovery.
     */
    public function createDiscovery(ResourceRepository $repo)
    {
        if (!interface_exists('Puli\Discovery\Api\Discovery')) {
            throw new RuntimeException('Please install puli/discovery to create Discovery instances.');
        }

        $discovery = new JsonDiscovery(__DIR__.'/bindings.json', array(
            new ResourceBindingInitializer($repo),
        ));

        return $discovery;
    }

    /**
     * Creates the URL generator.
     *
     * @param Discovery $discovery The discovery to read from.
     *
     * @return UrlGenerator The created URL generator.
     */
    public function createUrlGenerator(Discovery $discovery)
    {
        if (!interface_exists('Puli\UrlGenerator\Api\UrlGenerator')) {
            throw new RuntimeException('Please install puli/url-generator to create UrlGenerator instances.');
        }

        $generator = new DiscoveryUrlGenerator($discovery, array());

        return $generator;
    }

    /**
     * Returns the order in which the installed packages should be loaded
     * according to the override statements.
     *
     * @return string[] The sorted package names.
     */
    public function getPackageOrder()
    {
        $order = array(
            'laravel/laravel',
            'classpreloader/classpreloader',
            'cloudinary/cloudinary_php',
            'clue/stream-filter',
            'container-interop/container-interop',
            'dnoegel/php-xdg-base-dir',
            'doctrine/annotations',
            'doctrine/cache',
            'doctrine/collections',
            'doctrine/common',
            'doctrine/dbal',
            'doctrine/inflector',
            'doctrine/instantiator',
            'doctrine/lexer',
            'facebook/php-sdk-v4',
            'fzaninotto/faker',
            'graham-campbell/github',
            'graham-campbell/manager',
            'guzzle/guzzle',
            'guzzlehttp/guzzle',
            'guzzlehttp/promises',
            'guzzlehttp/psr7',
            'hamcrest/hamcrest-php',
            'happyr/linkedin-api-client',
            'hassankhan/config',
            'hownowstephen/php-foursquare',
            'ircmaxell/random-lib',
            'ircmaxell/security-lib',
            'jakeasmith/http_build_url',
            'jakub-onderka/php-console-color',
            'jakub-onderka/php-console-highlighter',
            'jeremeamia/superclosure',
            'jrm2k6/cloudder',
            'justinrainbow/json-schema',
            'knplabs/github-api',
            'larabros/elogram',
            'laravel/framework',
            'laravel/socialite',
            'league/container',
            'league/flysystem',
            'league/oauth1-client',
            'league/oauth2-client',
            'league/oauth2-instagram',
            'mockery/mockery',
            'monolog/monolog',
            'mtdowling/cron-expression',
            'nesbot/carbon',
            'nikic/php-parser',
            'paragonie/random_compat',
            'php-http/discovery',
            'php-http/guzzle6-adapter',
            'php-http/httplug',
            'php-http/message',
            'php-http/message-factory',
            'php-http/promise',
            'phpdocumentor/reflection-docblock',
            'phpspec/prophecy',
            'phpunit/php-code-coverage',
            'phpunit/php-file-iterator',
            'phpunit/php-text-template',
            'phpunit/php-timer',
            'phpunit/php-token-stream',
            'phpunit/phpunit',
            'phpunit/phpunit-mock-objects',
            'psr/http-message',
            'psr/log',
            'psy/psysh',
            'puli/composer-plugin',
            'puli/discovery',
            'puli/repository',
            'puli/url-generator',
            'ramsey/uuid',
            'sebastian/comparator',
            'sebastian/diff',
            'sebastian/environment',
            'sebastian/exporter',
            'sebastian/global-state',
            'sebastian/recursion-context',
            'sebastian/version',
            'seld/jsonlint',
            'socialiteproviders/foursquare',
            'socialiteproviders/instagram',
            'socialiteproviders/manager',
            'swiftmailer/swiftmailer',
            'symfony/console',
            'symfony/css-selector',
            'symfony/debug',
            'symfony/dom-crawler',
            'symfony/event-dispatcher',
            'symfony/filesystem',
            'symfony/finder',
            'symfony/http-foundation',
            'symfony/http-kernel',
            'symfony/polyfill-mbstring',
            'symfony/polyfill-php56',
            'symfony/polyfill-util',
            'symfony/process',
            'symfony/routing',
            'symfony/translation',
            'symfony/var-dumper',
            'symfony/yaml',
            'themattharris/tmhoauth',
            'thujohn/twitter',
            'vinkla/facebook',
            'vinkla/instagram',
            'vlucas/phpdotenv',
            'webmozart/assert',
            'webmozart/expression',
            'webmozart/glob',
            'webmozart/json',
            'webmozart/path-util',
        );

        return $order;
    }
}
