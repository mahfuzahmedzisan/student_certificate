<?php

use Livewire\Component;
use Illuminate\Support\Facades\Log;

new class extends Component
{
    public $student;

    public function mount($foundStudent)
    {
        $this->student = $foundStudent;
        Log::info('dsg');
    }
    
};
?>

<div>

    dsgd;sldsjflkdsjlfjlklkkl
</div>