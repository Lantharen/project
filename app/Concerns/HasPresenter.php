<?php

namespace App\Concerns;

use DomainException;
use Illuminate\Support\Str;
use Orchid\Support\Presenter;

trait HasPresenter
{
    /**
     * The cache of presenter instances.
     *
     * @var array<string, Presenter>
     */
    private static array $presenterCache = [];

    /**
     * Returns the model's presenter instance.
     *
     * @return \Orchid\Support\Presenter<$this>
     */
    public function presenter(): Presenter
    {
        $key = $this->cacheKey();

        if (!isset(self::$presenterCache[$key])) {
            self::$presenterCache[$key] = $this->newPresenter();
        }

        return self::$presenterCache[$key];
    }

    /**
     * Returns a new instance of the model's presenter.
     *
     * @return \Orchid\Support\Presenter<$this>
     */
    public function newPresenter(): Presenter
    {
        $className = $this->presenterFullyQualifiedClassName();

        if (!is_a($className, Presenter::class, true)) {
            throw new DomainException(
                sprintf(
                    'The presenter class "%s" must be an instance of "%s"',
                    $className,
                    Presenter::class
                )
            );
        }

        return new $className($this);
    }

    /**
     * Returns the key used for caching the model's presenter.
     *
     * @return string
     */
    private function cacheKey(): string
    {
        if (true === $this->exists) {
            return $this->getQualifiedKeyName().':'.$this->getKey();
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the fully qualified class name of the model's presenter.
     *
     * This method can be overridden to return a custom presenter.
     *
     * @return class-string<Presenter>
     */
    private function presenterFullyQualifiedClassName(): string
    {
        return Str::of(class_basename(static::class))
            ->append('Presenter')
            ->prepend('App\\Orchid\\Presenters\\')
            ->toString();
    }
}
