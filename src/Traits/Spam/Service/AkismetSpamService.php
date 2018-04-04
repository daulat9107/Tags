<?php

namespace Daulat\Taggy\Traits\Spam\Service;


use Daulat\Taggy\Traits\Spam\Service\Exceptions\FailedToCheckSpamException;
use Daulat\Taggy\Traits\Spam\Service\Exceptions\FailedToMarkAsHamException;
use Daulat\Taggy\Traits\Spam\Service\Exceptions\FailedToMarkAsSpamException;
use Daulat\Taggy\Traits\Spam\Service\Exceptions\InvalidApiKeyException;
use Daulat\Taggy\Traits\Spam\Spam;
use GuzzleHttp\Client as Guzzle;

class AkismetSpamService implements SpamServiceInterface
{
    protected $client;

    protected $endpoint = 'https://%s.rest.akismet.com/1.1/%s';

    public function __construct(Guzzle $client)
    {
        $this->client = $client;

        if ($this->checkApiKey() === false) {
            throw new InvalidApiKeyException;
        }

    }

    public function isSpam(array $parameters, array $additional = [])
    {
       
        $request = $this->makeRequest('comment-check', $this->mapParameters($parameters, $additional));

        $response = $request->getBody()->getContents();

        if (!in_array($response, ['true', 'false'])) {
            throw new FailedToCheckSpamException;
        }

        return $response === 'true';
    }

    public function markAsSpam(array $parameters, array $additional = [])
    {
        $request = $this->makeRequest('submit-spam', $this->mapParameters($parameters, $additional));

        if ($request->getBody()->getContents() !== 'Thanks for making the web a better place.') {
            throw new FailedToMarkAsSpamException;
        }

        return true;
    }

    public function markAsHam(array $parameters, array $additional = [])
    {
        $request = $this->makeRequest('submit-ham', $this->mapParameters($parameters, $additional));

        if ($request->getBody()->getContents() !== 'Thanks for making the web a better place.') {
            throw new FailedToMarkAsHamException;
        }

        return true;
    }

    protected function checkApiKey()
    {
        
        $request = $this->makeRequest('verify-key', [
            'key' => config('services.akismet.secret')
        ]);
        
        return $request->getBody()->getContents() === 'valid';
    }

    protected function mapParameters($parameters, $additional = [])
    {
        $parameterMap = config('spam.parameter_map');
        
       
        $mappedParameters = array_map(function ($key, $value) use ($parameterMap) {
            if (isset($parameterMap[$key])) {
                return [$parameterMap[$key] => $value];
            }
        }, array_keys($parameters), $parameters);
       

        return array_merge(array_collapse($mappedParameters), $additional);
    }

    protected function makeRequest($type, $parameters)
    {
        
        return $this->client->request('POST', sprintf($this->endpoint, config('services.akismet.secret'), $type), [
            'form_params' => $this->mergeDefaultFormParams($parameters)
        ]);
    }

    protected function mergeDefaultFormParams($parameters)
    {
        return array_merge([
            'blog' => config('services.akismet.website'),
            'user_ip' => request()->ip(),
        ], $parameters);
    }
}
