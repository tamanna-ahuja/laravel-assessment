<?php

namespace App\Livewire\Pages\Skills;

use Livewire\Component;
use App\Models\Skill;

class Index extends Component
{
    public $skills, $name, $editId;

    protected $rules = [
        'name' => 'required|string|max:255|unique:skills,name',
    ];

    public function mount()
    {
        $this->loadSkills();
    }

    public function loadSkills()
    {
        $this->skills = Skill::orderBy('name')->get();
    }

    public function save()
    {
        $this->validate();

        if ($this->editId) {
            // Update Skill
            $skill = Skill::find($this->editId);
            if ($skill) {
                $skill->update(['name' => $this->name]);
            }
            $this->editId = null;
        } else {
            // Create Skill
            Skill::create(['name' => $this->name]);
        }

        $this->name = ''; // Clear input field
        $this->loadSkills(); // Refresh skill list

        session()->flash('message', 'Skill saved successfully.');
    }

    public function edit($id)
    {
        $skill = Skill::find($id);
        if ($skill) {
            $this->editId = $skill->id;
            $this->name = $skill->name;
        }
    }

    public function delete($id)
    {
        Skill::find($id)?->delete();
        $this->loadSkills();
    }

    public function cancelEdit()
    {
        $this->editId = null;
        $this->name = '';
    }

    public function render()
    {
        return view('livewire.pages.skills.index');
    }
}