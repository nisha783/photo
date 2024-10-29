<?php

namespace App\Livewire;

use App\Models\Comment;
use Egulias\EmailValidator\Parser\Comment as ParserComment;
use Egulias\EmailValidator\Warning\Comment as WarningComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comments extends Component
{
   
    public $comments;    // Store the list of comments
    public $newComment;  // Store the new comment being typed

    // Fetch the latest comments when the component is rendered
    public function mount()
    {
        $this->comments =Comment::latest()->get();
    }

    // Validate and store the new comment
    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|max:255',
        ]);

        Comment::create([
            'body' => $this->newComment,
            'user_id' => Auth::id(),
        ]);

        // Refresh the comments list and clear the input field
        $this->comments = Comment::latest()->get();
        $this->newComment = '';
    }
    public function render()
    {
        return view('livewire.comments');
    }
}
