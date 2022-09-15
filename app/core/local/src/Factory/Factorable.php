<?php

namespace QSoft\Factory;

abstract class Factorable
{
    protected int $count;
    protected array $additionalInfo;

    public function __construct()
    {
        $this->count = 1;
        $this->additionalInfo = [];
    }

    /**
     * @return static
     */
    public static function create(): self
    {
        return new static();
    }

    /**
     * @param  int  $count
     * @return Factorable
     */
    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param  string|array  $key
     * @param  mixed $value
     * @return Factorable
     */
    public function setAdditionalInfo($key, $value): self
    {
        if (is_array($key)) {
            $this->additionalInfo = array_merge($this->additionalInfo, $key);
        } else {
            $this->additionalInfo[$key] = $value;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function make(): array
    {
        $result = [];
        for ($i = 0; $i < $this->count; $i++) {
            $result[] = $this->makeOne();
        }

        return $result;
    }

    abstract protected function makeOne(): array;
}
