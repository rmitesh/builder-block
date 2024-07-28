<?php

namespace Rmitesh\BuilderBlock\Traits;

use Filament\Forms;
use Rmitesh\BuilderBlock\Enums\CardType;
use Rmitesh\BuilderBlock\Resources\Components\AdditionalAttributeComponent;

trait HasBlockComponents
{
    public array $blocks = [];

    /**
     * Get the hero section with Heading on left and image is on right.
     * 
     * Heading
     * Image
     * Content
     * Button action
     */
    protected static function getHeroSectionRightBlock(): Forms\Components\Builder\Block
    {
        return Forms\Components\Builder\Block::make('hero_section_right')
            ->label('Hero Section (Right-side Image)')
            ->columns(4)
            ->icon('heroicon-m-table-cells')
            ->schema([
                AdditionalAttributeComponent::make('')
                    ->columnSpanFull(),
                
                Forms\Components\Section::make()
                    ->columnSpan(['lg' => 2])
                    ->schema([
                        static::getTextComponent('heading', placeholder: 'Heading text')
                            ->required(),
                        
                        static::getRichEditorComponent('content', placeholder: 'Write your text...')
                            ->required(),

                        Forms\Components\Toggle::make('has_action_button')
                            ->label('Has action button?')
                            ->live()
                            ->inline()
                            ->afterStateUpdated(function (Forms\Set $set) {
                                $set('button_label', null);
                                $set('button_action_url', null);
                                $set('button_classes', []);
                            }),
                    ]),

                Forms\Components\Section::make()
                    ->columnSpan(['lg' => 2])
                    ->schema([
                        static::getFileUploadComponent('image', directory: 'hero-section-images')
                            ->required()
                            ->panelAspectRatio('2:1'),
                            
                        static::getTextComponent('image_alt_text', placeholder: 'Image alt text')
                            ->required(),
                    ]),

                Forms\Components\Section::make('Button Action')
                    ->description('Add the button action here.')
                    ->compact()
                    ->columnSpanFull()
                    ->columns(3)
                    ->visible(fn(Forms\Get $get) => (bool) $get('has_action_button'))
                    ->schema([
                        static::getTextComponent('button_label', 'Label')
                            ->required(),

                        static::getTextComponent('button_action_url', 'Action URL', 'https://domain.com or #page-id')
                            ->required()
                            ->helperText('Add action URL or page fragment ID'),

                        static::getTagsInputComponent('button_classes', 'Classes')
                            ->reorderable(),
                    ]),
            ]);
    }
    
    /**
     * Get the hero section with Heading on right and image is on left.
     * 
     * Heading
     * Image
     * Content
     * Button action
     */
    protected static function getHeroSectionLeftBlock(): Forms\Components\Builder\Block
    {
        return Forms\Components\Builder\Block::make('hero_section_left')
            ->label('Hero Section (Left-side Image)')
            ->columns(4)
            ->icon('heroicon-m-table-cells')
            ->schema([
                AdditionalAttributeComponent::make('')
                    ->columnSpanFull(),
                    
                Forms\Components\Section::make()
                    ->columnSpan(['lg' => 2])
                    ->schema([
                        static::getFileUploadComponent('image', directory: 'hero-section-images')
                            ->required()
                            ->panelAspectRatio('2:1'),
                            
                        static::getTextComponent('image_alt_text', placeholder: 'Image alt text')
                            ->required(),
                    ]),
                
                Forms\Components\Section::make()
                    ->columnSpan(['lg' => 2])
                    ->schema([
                        static::getTextComponent('heading', placeholder: 'Heading text')
                            ->required(),
                        
                        static::getRichEditorComponent('content', placeholder: 'Write your text...')
                            ->required(),

                        Forms\Components\Toggle::make('has_action_button')
                            ->label('Has action button?')
                            ->live()
                            ->inline()
                            ->afterStateUpdated(function (Forms\Set $set) {
                                $set('button_label', null);
                                $set('button_action_url', null);
                                $set('button_classes', []);
                            }),
                    ]),

                Forms\Components\Section::make('Button Action')
                    ->description('Add the button action here.')
                    ->compact()
                    ->columnSpanFull()
                    ->columns(3)
                    ->visible(fn(Forms\Get $get) => (bool) $get('has_action_button'))
                    ->schema([
                        static::getTextComponent('button_label', 'Label')
                            ->required(),

                        static::getTextComponent('button_action_url', 'Action URL', 'https://domain.com or #page-id')
                            ->required()
                            ->helperText('Add action URL or page fragment ID'),

                        static::getTagsInputComponent('button_classes', 'Classes')
                            ->reorderable(),
                    ]),
            ]);
    }

    /**
     * Get the card block.
     * 
     * Card type
     * Cards
     *   - Heading
     *   - Content
     */
    protected static function getCardBlock(): Forms\Components\Builder\Block
    {
        return Forms\Components\Builder\Block::make('cards')
            ->label('Cards')
            ->columns(4)
            ->icon('heroicon-m-chart-bar-square')
            ->schema([
                AdditionalAttributeComponent::make('')
                    ->columnSpanFull(),
                
                Forms\Components\Section::make()
                    ->columnSpanFull()
                    ->schema([
                        Forms\Components\ToggleButtons::make('card_type')
                            ->inline()
                            ->required()
                            ->options(CardType::class),
        
                        Forms\Components\Repeater::make('cards')
                            ->grid()
                            ->defaultItems(2)
                            ->live(onBlur: true)
                            ->itemLabel(function ($state) {
                                return $state['heading'] ?? null;
                            })
                            ->schema([
                                static::getTextComponent('heading', placeholder: 'Heading text')
                                    ->required(),
                            
                                static::getRichEditorComponent('content', placeholder: 'Write your text...')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    /**
     * Get the mini states block.
     * 
     * Mini states
     *   - Title
     *   - State
     */
    protected static function getMiniStateBlock(): Forms\Components\Builder\Block
    {
        return Forms\Components\Builder\Block::make('mini_states')
            ->label('Mini states')
            ->columns(4)
            ->icon('heroicon-m-chart-bar-square')
            ->schema([
                AdditionalAttributeComponent::make('')
                    ->columnSpanFull(),
                
                Forms\Components\Section::make()
                    ->columnSpanFull()
                    ->schema([
                        Forms\Components\Repeater::make('states')
                            ->grid(4)
                            ->defaultItems(4)
                            ->live(onBlur: true)
                            ->itemLabel(function ($state) {
                                return $state['title'] ?? null;
                            })
                            ->schema([
                                static::getTextComponent('title', placeholder: 'Title text')
                                    ->required(),

                                static::getTextComponent('state', placeholder: 'State')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    /**
     * Get the information box block.
     * 
     * Heading
     * Sub heading
     * Content
     */
    protected static function getInformationBlock(): Forms\Components\Builder\Block
    {
        return Forms\Components\Builder\Block::make('information_box')
            ->label('Information box')
            ->columns(4)
            ->icon('heroicon-m-information-circle')
            ->schema([
                AdditionalAttributeComponent::make('')
                    ->columnSpanFull(),

                Forms\Components\Repeater::make('boxes')
                    ->defaultItems(1)
                    ->live(onBlur: true)
                    ->columnSpanFull()
                    ->itemLabel(function ($state) {
                        return $state['heading'] ?? null;
                    })
                    ->schema([
                        Forms\Components\Grid::make()
                            ->columns(4)
                            ->schema([
                                Forms\Components\Section::make()
                                    ->columnSpan(['lg' => 2])
                                    ->schema([
                                        static::getTextComponent('heading', placeholder: 'Heading text')
                                            ->required(),

                                        static::getTextComponent('sub_heading', placeholder: 'Sub heading text')
                                            ->required(),
                                        
                                        static::getRichEditorComponent('content', placeholder: 'Write your text...')
                                            ->required(),
                                    ]),
        
                                Forms\Components\Section::make()
                                    ->columnSpan(['lg' => 2])
                                    ->schema([
                                        static::getFileUploadComponent('image', directory: 'information-box-images')
                                            ->required()
                                            ->panelAspectRatio('2:1'),
                                            
                                        static::getTextComponent('image_alt_text', placeholder: 'Image alt text')
                                            ->required(),
                                    ]),
                            ])
                    ]),
            ]);
    }

    /**
     * Get the FAQ block.
     * 
     * FAQs
     *   - Question
     *   - Answer
     */
    protected static function getFaqBlock(): Forms\Components\Builder\Block
    {
        return Forms\Components\Builder\Block::make('faq')
            ->label('FAQs')
            ->columns(4)
            ->icon('heroicon-m-chat-bubble-left-right')
            ->schema([
                AdditionalAttributeComponent::make('')
                    ->columnSpanFull(),
                
                Forms\Components\Repeater::make('faqs')
                    ->defaultItems(1)
                    ->minItems(1)
                    ->live(onBlur: true)
                    ->columnSpanFull()
                    ->addActionLabel('Add to FAQs')
                    ->itemLabel(function ($state) {
                        return $state['question'] ?? null;
                    })
                    ->schema([
                        static::getTextComponent('question', placeholder: 'Question')
                            ->required(),
                        
                        static::getRichEditorComponent('answer', placeholder: 'Write your answer...')
                            ->required(),
                    ]),
            ]);
    }
}
