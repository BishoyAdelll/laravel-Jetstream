<div class="max-w-6xl mx-auto">
    <div class="flex justify-end m-2 p-2">
        <x-button wire:click="showPostModal">create</x-button>
    </div>
    <div class="m-2 p-2" >
        <div class="my-2 overflow-x-auto sm:mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
              <div class="shadow overflow-hidden border border-gray-200 sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200 ">
                  <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                    <tr>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-100">ID
                      </th>
                      <th
                       scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-100">TITLE
                      </th>
                      
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-100">IMAGE
                      </th>
                      <th scope="col" class="px-6 py-3 relative">EDIT
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr></tr>
                    @foreach ($posts as $post)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap ">{{ $post->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap ">{{ $post->title }}</td>
                        
                         <td class="px-6 py-4 whitespace-nowrap ">
                           <img src="{{Storage::url( $post->image) }}" class="w-8 h-8 rounded-full " alt="">
                         </td>
                         <td class="px-6 py-4 text-right text-sm ">
                            <div class="flex space-x-2 float-right">
                                <x-button class="bg-teal-500 hover:bg-teal-600"  wire:click="showEditModel({{ $post->id  }})">edit</x-button>
                                <x-button class="bg-red-400 hover:bg-red-600" wire:click="deletePost({{ $post->id  }})">Delete</x-button>
                            </div>
                            </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table> 
                <div class="m-2 p-2"> Pagination</div>
              </div>
            </div>
          </div>
    </div>
    <div>
        <x-dialog-modal wire:model="showingPostModal">
            @if($isEditMode)
             <x-slot name="title">update Post</x-slot>
            @else
            <x-slot name="title">Create Post</x-slot>
            @endif
           
            <x-slot name="content">
            <div class="space-y-8 divide-y divide-gray-200  mt-10">
                <form enctype="multipart/form-data">
                <div class="sm:col-span-6">
                  <label for="title" class="block text-sm font-medium text-gray-700 ">postTitle</label>
                  <div class="mt-1">
                    <input type="text" id="title" wire:model.lazey="title" name="title" class="block w-full  appearance-none bg-white border border-gray-400 py-2 rounded-md px-1">
                        @error('title')<span class="text-red-400">{{ $message }}</span>@enderror                    
                  </div>
                </div>
                <div class="sm:col-span-6">
                  <label for="image" class="block text-sm font-medium text-gray-700 ">Post image</label>
                  @if($oldImage)
                  Photo Preview:
                  <img src="{{Storage::url( $oldImage) }}" alt="">
                  @endif
                  @if($newImage)
                  Photo Preview:
                  <img src="{{ $newImage->temporaryUrl() }}" alt="">
                  @endif
                  <div class="mt-1">
                    <input type="file" id="image" wire:model="newImage" name="image" class="block w-full appearance-none bg-white border border-gray-400 py-2 rounded-md px-1">
                        @error('newImage')<span class="text-red-400">{{ $message }}</span>@enderror
                  </div>
                </div>
                <div class="sm:col-span-6">
                  <label for="body" class="block text-sm font-medium text-gray-700 ">Post Body</label>
                  <div class="mt-1">
                    <textarea rows="3" id="body" wire:model.lazey="body" name="body" class="block w-full  appearance-none bg-white border border-gray-400 rounded-md"></textarea>
                        @error('body')<span class="text-red-400">{{ $message }}</span>@enderror
                  </div>
                </div>
                </form>
              </div>
            </x-slot>
            <x-slot name="footer">
                @if ($isEditMode)
                    <x-button wire:click="updatePost">update</x-button>
                    @else
                    <x-button wire:click="storePost">save</x-button>
                @endif
                
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
