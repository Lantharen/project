<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HttpLog>
 */
class HttpLogFactory extends Factory
{
    /** {@inheritDoc} */
    public function definition(): array
    {
        $method = $this->fakeRequestMethod();

        return [
            'method' => $method,
            'path' => parse_url($this->faker->url, PHP_URL_PATH),
            'ip' => $this->faker->ipv4,
            'headers' => $this->fakeHeaders(),
            'attributes' => $this->fakeAttributes($method),
            'status_code' => $this->fakeStatusCode(),
        ];
    }

    /**
     * Returns a random HTTP request method.
     *
     * @return string
     */
    private function fakeRequestMethod(): string
    {
        return $this->faker->randomElement([
            Request::METHOD_GET,
            Request::METHOD_POST,
        ]);
    }

    /**
     * Returns a fake HTTP request headers.
     *
     * @return array<string, string>
     */
    private function fakeHeaders(): array
    {
        return [
            'Host' => parse_url(config('app.url'), PHP_URL_HOST),
            'User-Agent' => $this->faker->userAgent,
        ];
    }

    /**
     * Returns a fake HTTP request attributes.
     *
     * @param  string  $method
     * @return array|null
     */
    private function fakeAttributes(string $method): ?array
    {
        if ($method === Request::METHOD_GET) {
            return null;
        }

        return [
            'numeric' => $this->faker->randomNumber(),
            'string' => $this->faker->sentence(),
            'boolean' => $this->faker->boolean(),
        ];
    }

    /**
     * Returns a fake HTTP response status code.
     *
     * @return int
     */
    private function fakeStatusCode(): int
    {
        return $this->faker->randomElement(array_keys(Response::$statusTexts));
    }
}
