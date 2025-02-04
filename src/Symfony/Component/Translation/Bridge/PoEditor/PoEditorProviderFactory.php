<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation\Bridge\PoEditor;

use Psr\Log\LoggerInterface;
use Symfony\Component\Translation\Exception\UnsupportedSchemeException;
use Symfony\Component\Translation\Loader\LoaderInterface;
use Symfony\Component\Translation\Provider\AbstractProviderFactory;
use Symfony\Component\Translation\Provider\Dsn;
use Symfony\Component\Translation\Provider\ProviderInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * @author Mathieu Santostefano <msantostefano@protonmail.com>
 *
 * @experimental in 5.3
 */
final class PoEditorProviderFactory extends AbstractProviderFactory
{
    private const HOST = 'api.poeditor.com';

    private $client;
    private $logger;
    private $defaultLocale;
    private $loader;

    public function __construct(HttpClientInterface $client, LoggerInterface $logger, string $defaultLocale, LoaderInterface $loader)
    {
        $this->client = $client;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
        $this->loader = $loader;
    }

    /**
     * @return PoEditorProvider
     */
    public function create(Dsn $dsn): ProviderInterface
    {
        if ('poeditor' !== $dsn->getScheme()) {
            throw new UnsupportedSchemeException($dsn, 'poeditor', $this->getSupportedSchemes());
        }

        $endpoint = sprintf('%s%s', 'default' === $dsn->getHost() ? self::HOST : $dsn->getHost(), $dsn->getPort() ? ':'.$dsn->getPort() : '');
        $client = $this->client->withOptions([
            'base_uri' => 'https://'.$endpoint.'/v2/',
        ]);

        return new PoEditorProvider($this->getPassword($dsn), $this->getUser($dsn), $client, $this->loader, $this->logger, $this->defaultLocale, $endpoint);
    }

    protected function getSupportedSchemes(): array
    {
        return ['poeditor'];
    }
}
