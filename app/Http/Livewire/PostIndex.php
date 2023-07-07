<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostIndex extends Component
{
    use WithFileUploads;
    public $showingPostModal = false;
    public $title;
    public $newImage;
    public $post;
    public $oldImage;
    public $isEditMode=false;
    public $body;
    public function showPostModal()
    {
        $this->reset();
        $this->showingPostModal = true;
    }
    public function storePost(){
        $this->validate([
            'newImage'=>'required|max:1024',
            'title'=>'string'
        ]);
        $image=$this->newImage->store('public/posts');
        Post::create([
            'title'=>$this->title,
            'image'=>$image,
            'body'=>$this->body,
        ]);
        $this->reset();
    }
    public function showEditModel($id){
        $this->post=Post::findOrfail($id);
        $this->title=$this->post->title;
        $this->body=$this->post->body;
        $this->oldImage=$this->post->image;
        $this->isEditMode=true;
        $this->showingPostModal = true;
    }
    public function updatePost(){
        $this->validate([
            'title'=>'string|required',
            'body'=>'string|required',
        ]);
        $image=$this->post->image;
        if($this->newImage){
            $image=$this->newImage->store('public/posts');
        }
        $this->post->update([
            'title'=>$this->title,
            'image'=> $image,
            'body'=>$this->body,
        ]);
        $this->reset();
    }
    public function deletePost($id){
        $this->post=Post::findOrFail($id);
        Storage::delete($this->post->image);
        $this->post->delete();
        $this->reset();
    }
    public function render()
    {
        return view('livewire.post-index',[
            'posts'=>Post::all()
        ]);
    }
}
