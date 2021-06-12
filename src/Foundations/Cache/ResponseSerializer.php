<?php

namespace Orbitali\Foundations\Cache;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseSerializer
{
    const RESPONSE_TYPE_NORMAL = "response_type_normal";
    const RESPONSE_TYPE_FILE = "response_type_file";
    const CSRF_REPLACE_TOKEN = "<csrf-token-replaced>";

    public function serialize(Response $response): string
    {
        return serialize($this->getResponseData($response));
    }

    public function unSerialize(string $serializedResponse): Response
    {
        $responseProperties = unserialize($serializedResponse);
        if (!$this->containsValidResponseProperties($responseProperties)) {
            throw new UnexpectedValueException(
                "Could not unserialize `{$serializedResponse}`"
            );
        }
        $this->replaceCSRFTokenForUnserialize($responseProperties["content"]);
        $this->replaceCustomTokenForUnserialize($responseProperties["content"]);
        $response = $this->buildResponse($responseProperties);
        $response->headers = $responseProperties["headers"];
        return $response;
    }

    public function afterApply(Response $response)
    {
        if (!($response instanceof BinaryFileResponse)) {
            $content = $response->getContent();
            $this->replaceCustomTokenForUnserialize($content);
            $response->setContent($content);
        }
    }

    protected function getResponseData(Response $response): array
    {
        $statusCode = $response->getStatusCode();
        $headers = $response->headers;
        if ($response instanceof BinaryFileResponse) {
            $content = $response->getFile()->getPathname();
            $type = self::RESPONSE_TYPE_FILE;
            return compact("statusCode", "headers", "content", "type");
        }
        $content = $response->getContent();
        $this->replaceCSRFTokenForSerialize($content);
        $type = self::RESPONSE_TYPE_NORMAL;
        return compact("statusCode", "headers", "content", "type");
    }

    protected function containsValidResponseProperties($properties): bool
    {
        if (!is_array($properties)) {
            return false;
        }
        if (!isset($properties["content"], $properties["statusCode"])) {
            return false;
        }
        return true;
    }

    protected function buildResponse(array $responseProperties): Response
    {
        $type = $responseProperties["type"] ?? self::RESPONSE_TYPE_NORMAL;
        if ($type === self::RESPONSE_TYPE_FILE) {
            return new BinaryFileResponse(
                $responseProperties["content"],
                $responseProperties["statusCode"]
            );
        }
        return new Response(
            $responseProperties["content"],
            $responseProperties["statusCode"]
        );
    }

    protected function replaceCSRFTokenForSerialize(&$content)
    {
        $content = str_replace(
            csrf_token(),
            self::CSRF_REPLACE_TOKEN,
            $content
        );
    }
    protected function replaceCSRFTokenForUnserialize(&$content)
    {
        $content = str_replace(
            self::CSRF_REPLACE_TOKEN,
            csrf_token(),
            $content
        );
    }

    protected function replaceCustomTokenForUnserialize(&$content)
    {
        foreach (config("orbitali.cache.replacer", []) as $key => $value) {
            $list = explode("@", $value);
            $content = str_replace(
                $key,
                call_user_func([$list[0], $list[1]]),
                $content
            );
        }
    }
}
