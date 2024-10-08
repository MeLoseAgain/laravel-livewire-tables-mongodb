<?php

namespace KaitoSaikyo\LaravelLivewireTables\Views;

use Illuminate\Support\Str;
use KaitoSaikyo\LaravelLivewireTables\Views\Traits\IsColumn;

class Column
{
    use IsColumn;

    protected bool $displayColumnLabel = true;

    protected string $view = '';

    public function __construct(string $title, ?string $from = null)
    {
        $this->title = trim($title);

        if ($from) {
            $this->from = trim($from);
            $this->hash = md5($this->from);
            $this->field = $this->from;
        } else {
            $this->field = Str::snake($title);
            $this->hash = md5($this->field);
        }
    }

    /**
     * @return static
     */
    public static function make(string $title, ?string $from = null): Column
    {
        return new static($title, $from);
    }
}
