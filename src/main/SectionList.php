<?php

namespace Gam\Estafeta\Command;

use Gam\Estafeta\Command\Model\LocationSection;

class SectionList implements \Countable
{
    /**
     * @var LocationSection[]
     */
    private array $sections;

    /**
     * The constructor.
     *
     * @param LocationSection ...$sections The sections
     */
    public function __construct(LocationSection ...$sections)
    {
        $this->sections = $sections;
    }

    /**
     * Add SectionInfo to list.
     *
     * @param LocationSection $section The user
     *
     * @return void
     */
    public function add(LocationSection $section): void
    {
        $this->sections[] = $section;
    }

    /**
     * Filter list items by Suburb name.
     * @param string $suburb
     * @param bool $like
     * @return self
     */
    public function findBySuburb(string $suburb, bool $like = false): self
    {
        return $this->findBy('suburb', $suburb, $like);
    }

    /**
     * Filter list items by State name.
     * @param string $state
     * @param bool $like
     * @return SectionList
     */
    public function findbyState(string $state, bool $like = false): self
    {
        return $this->findBy('state', $state, $like);
    }

    /**
     * Filter the list by the given attribute and value.
     * @param string $attribute the attribute to filter to.
     * @param string $value the value to filter to.
     * @param bool $like if true, the comparison is no strict.
     * @return SectionList
     */
    public function findBy(string $attribute, string $value, bool $like = false): self
    {
        return new self(...array_filter($this->sections, function ($section) use ($attribute, $value, $like) {
            if (! $like) {
                return $section->{'get' . $attribute}() === $value;
            }
            return false !== stripos($section->{'get' . $attribute}(), $value);
        }));
    }

    /**
     * Get all Sections.
     *
     * @return LocationSection[] The sections
     */
    public function all(): array
    {
        return $this->sections;
    }

    public function first(): ?LocationSection
    {
        $first = reset($this->sections);
        return false === $first? null : $first;
    }

    public function last(): ?LocationSection
    {
        $last = end($this->sections);
        return false === $last? null : $last;
    }

    public function isEmpty(): bool
    {
        return 0 === $this->count();
    }

    public function count(): int
    {
        return count($this->sections);
    }

    /**
     * @return LocationSection[]
     */
    public function toArray(): array
    {
        return $this->sections;
    }
}
