<?php

namespace App\Http\Livewire;

use App\Models\Meet;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadMeet extends Component
{
    use WithFileUploads;

    public $file;

    public function save()
    {
        $this->validate([
            'file' => 'mimes:pdf|max:4096', // 4MB Max
        ]);

        $file = $this->file->store('programs');

        try {
            $meet = Meet::createFromPdf($file);
            $this->redirect(route('meets.show', $meet));
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
            $this->redirect(route('meets.upload'));
        }
    }

    public function render()
    {
        return view('livewire.upload-meet');
    }
}
