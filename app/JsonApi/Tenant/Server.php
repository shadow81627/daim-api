<?php

namespace App\JsonApi\Tenant;

use App\JsonApi\Tenant\Articles\ArticleSchema;
use LaravelJsonApi\Core\Server\Server as BaseServer;

class Server extends BaseServer
{

    /**
     * The base URI namespace for this server.
     *
     * @var string
     */
    protected function baseUri(): string
    {
        if ($this->baseUri) {
            return $this->baseUri;
        }

        return $this->baseUri = '/clients/' . tenant('id');
    }

    /**
     * Bootstrap the server when it is handling an HTTP request.
     *
     * @return void
     */
    public function serving(): void
    {
        // no-op
    }

    /**
     * Get the server's list of schemas.
     *
     * @return array
     */
    protected function allSchemas(): array
    {
        return [
            Articles\ArticleSchema::class
        ];
    }
}
