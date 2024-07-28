<?php

namespace Rmitesh\BuilderBlock\Traits;

use Filament\Forms;

trait HasFormComponents
{
    public static function getTextComponent(string $name, string | null $label = null, string | null $placeholder = null): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make($name)
            ->label($label ?? str($name)->headline()->lower()->ucfirst())
            ->placeholder($placeholder);
    }

    public static function getTagsInputComponent(string $name, string | null $label = null, string | null $placeholder = null): Forms\Components\TagsInput
    {
        return Forms\Components\TagsInput::make($name)
            ->label($label ?? str($name)->headline()->lower()->ucfirst())
            ->separator()
            ->splitKeys(['Tab', ' '])
            ->placeholder($placeholder);
    }

    public static function getRichEditorComponent(string $name, string | null $label = null, string | null $placeholder = null, array $disableToolbarButtons = []): Forms\Components\RichEditor
    {
        return Forms\Components\RichEditor::make($name)
            ->label($label ?? str($name)->headline()->lower()->ucfirst())
            ->placeholder($placeholder)
            ->disableToolbarButtons($disableToolbarButtons ?: static::getDisableToolbars());
    }

    public static function getFileUploadComponent(string $name, string | null $label = null, string | null $directory = null): Forms\Components\FileUpload
    {
        return Forms\Components\FileUpload::make($name)
            ->label($label ?? str($name)->headline()->lower()->ucfirst())
            ->directory($directory)
            ->image();
    }
}
