<?php

namespace Rmitesh\BuilderBlock;

use ReflectionClass;
use ReflectionMethod;
use Filament\Forms;
use Rmitesh\BuilderBlock\Traits\HasBlockComponents;
use Rmitesh\BuilderBlock\Traits\HasFormComponents;

class BuilderBlock
{
    use HasBlockComponents, HasFormComponents;
    
    private array $disableToolbars = [
        'attachFiles', 'blockquote', 'orderedList', 'bulletList',
        'codeBlock', 'h2', 'h3', 'link', 'strike',
    ];

    public static function make(): static
    {
        $static = app(static::class);

        $static->addBlocks($static->getDefaultBlocks());
        
        return $static;
    }

    public function getDefaultBlocks(): array
    {
        $reflection = new ReflectionClass($this);

        return collect(array_map(
                fn (ReflectionMethod $method): string => $method->getName(),
                $reflection->getMethods(ReflectionMethod::IS_PROTECTED),
            ))
            ->map(function ($method) use ($reflection) {
                return $reflection->getName()::$method();
            })
            ->merge($this->get())
            ->toArray();
    }

    public static function getDisableToolbars(): array
    {
        return (new self)->disableToolbars;
    }

    public function setDisableToolbars(array $disableToolbars): self
    {
        $this->disableToolbars = $disableToolbars;

        return $this;
    }
    
    public function addBlock(Forms\Components\Builder\Block $block): self
    {
        $this->blocks[] = $block;
        
        return $this;
    }
    
    public function addBlocks(array $blocks): self
    {
        $this->blocks = array_merge($this->blocks, $blocks);

        return $this;
    }
    
    public function get(): array
    {
        return $this->blocks;
    }
}
