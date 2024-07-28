<?php

namespace Rmitesh\BuilderBlock\Resources\Components;

use Filament\Forms;
use Illuminate\Support\HtmlString;

class AdditionalAttributeComponent extends Forms\Components\Field
{
    protected string $view = 'filament-forms::components.group';

    public function getChildComponents(): array
    {
        return [
            Forms\Components\Repeater::make('additional_attributes')
                ->label('')
                ->collapsed()
                ->deletable(false)
                ->reorderable(false)
                ->addable(false)
                ->columns(3)
                ->defaultItems(1)
                ->columnSpanFull()
                ->itemLabel(function () {
                    return new HtmlString('
                        <div class="grid flex-1 gap-y-1">
                            <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">Additional attributes</h3>
                            <p class="fi-section-header-description overflow-hidden break-words text-sm text-gray-500 dark:text-gray-400">You can add your custom attributes here if you want for this block.</p>
                        </div>
                    ');
                })
                ->schema([
                    Forms\Components\TextInput::make('id')
                        ->label('ID')
                        ->placeholder('Block ID')
                        ->columnSpan(['lg' => 1])
                        ->helperText('ID should be unique for this block.'),
                        
                    Forms\Components\TagsInput::make('classes')
                        ->label('Classes')
                        ->separator()
                        ->placeholder('Add class...')
                        ->columnSpan(['lg' => 2])
                        ->splitKeys(['Tab', ','])
                        ->helperText('Add your custom classes here.'),
                        
                    Forms\Components\KeyValue::make('data_attributes')
                        ->columnSpanFull()
                        ->label('Data attributes')
                        ->keyLabel('Data')
                        ->keyPlaceholder('data-')
                        ->valueLabel('Value')
                        ->valuePlaceholder('value')
                        ->addActionLabel('Add')
                        ->helperText('Add your custom data attributes here.'),
                ]),
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
    }
}