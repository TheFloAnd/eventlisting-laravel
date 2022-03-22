<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{

    /**
     * The alert type.
     *
     * @var string
     */
    public $type;
    public $icon;

    /**
     * The alert message.
     *
     * @var string
     */
    public $message;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $message)
    {
        switch($type){
            case 'error':
                $this->type = 'danger';
                $this->icon = 'exclamation-triangle-fill';
                break;
            case 'warning':
                $this->type = 'warning';
                $this->icon = 'exclamation-triangle-fill';
                break;
            case 'success':
                $this->type = 'success';
                $this->icon = 'check-circle-fill';
                break;
            default:
                $this->type = 'info';
                $this->icon = 'info-fill';
                break;
        }
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
