<?php

namespace SchoolSpider\SpiderEditor\Core;

class Node
{
    protected $styles = [];

    protected $attributes = [];

    protected $classes = [];

    public function __construct(protected array $node = [])
    {
        $this->parseAttributes();
    }

    private function parseAttributes()
    {
        $attrs = $this->node['attributes'] ?? [];

        foreach ($attrs as $key => $value) {
            match ($key) {
                'style' => $this->styles = $value,
                'class' => $this->classes = explode(' ', $value),
                default => $this->attributes[$key] = $value
            };
        }
    }

    /**
     * Add an attribute to the node
     *
     * @param  mixed  $key
     * @param  mixed  $value
     */
    public function addAttribute($key, $value): self
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Remove an attribute from the node
     *
     * @param  mixed  $key
     */
    public function removeAttribute($key): self
    {
        unset($this->attributes[$key]);

        return $this;
    }

    /**
     * Get an attribute from the node
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        return $this->attributes[$key] ?? null;
    }

    /**
     * Add a class to the node
     *
     * @param  mixed  $class
     */
    public function addClass(...$class): self
    {
        $this->classes = array_merge($this->classes, $class);

        return $this;
    }

    /**
     * Remove a class from the node
     *
     * @param  mixed  $class
     */
    public function removeClass($class): self
    {
        $this->classes = array_filter($this->classes, function ($item) use ($class) {
            return $item !== $class;
        });

        return $this;
    }

    /**
     * Add a style to the node
     *
     * @param  mixed  $key
     * @param  mixed  $value
     */
    public function addStyle($key, $value): self
    {
        $this->styles[$key] = $value;

        return $this;
    }

    /**
     * Remove a style from the node
     *
     * @param  mixed  $key
     */
    public function removeStyle($key): self
    {
        unset($this->styles[$key]);

        return $this;
    }

    /**
     * Remove all the styles from the node
     *
     * @param  array  $styles
     */
    public function removeAllStyles(): self
    {
        $this->styles = [];

        return $this;
    }

    /**
     * Escape the attribute value
     *
     * @param  mixed  $value
     */
    public function escapeAttribute($value): string
    {
        return htmlentities($value);
    }

    public function renderAttributes()
    {

        $attributes = [];

        foreach ($this->attributes as $key => $value) {
            $attributes[] = $key.'="'.$this->escapeAttribute($value).'"';
        }

        if (count($this->classes) > 0) {
            $attributes[] = 'class="'.implode(' ', $this->classes).'"';
        }

        if (count($this->styles) > 0) {
            $style = [];
            foreach ($this->styles as $key => $value) {

                if ($key === 'width' || $key === 'height' && is_numeric($value)) {
                    $value = $value.'%';
                }

                $style[] = $key.': '.$value;
            }
            $attributes[] = 'style="'.implode(';', $style).'"';
        }

        if (count($attributes) === 0) {
            return '';
        }

        return ' '.implode(' ', $attributes);

    }

    public function render()
    {
        return '';
    }
}
