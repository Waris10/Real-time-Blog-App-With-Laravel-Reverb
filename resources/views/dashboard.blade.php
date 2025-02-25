<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <br>
    <div x-data="{showUpdateModal: null, showAddModal : false}" class="max-w-6xl mx-auto p-6 bg-white rounded-lg">
        <h3 class=" text-lg font-semibold mb-4">Your Blogs</h3>
        <button @click="showAddModal = true" class="bg-green-500 text-white rounded-lg py-2 px-4 mb-4"> Add
            Blog</button>

        <table class=" w-full border-collapse">
            <thead>
                <tr class=" bg-gray-200">
                    <th class=" border border-gray-300 px-4 py-2 text-left">Title</th>
                    <th class=" border border-gray-300 px-4 py-2 text-left">Content</th>

                    <th class=" border border-gray-300 px-4 py-2 text-left">Created At</th>
                    <th class=" border border-gray-300 px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Auth::user()->blogs as $blog)
                <tr class="bg-gray-100">
                    <td class="px-4 py-2">{{ $blog->title }}</td>
                    <td class="px-4 py-2">{{ $blog->content }}</td>
                    <td class="px-4 py-2">{{ $blog->created_at->format('M d, Y') }}</td>
                    <td class="px-4">
                        <button @click="showUpdateModal = {{ $blog->id }}" class="text-blue-500">Update</button>
                        <form action="{{route('blog.destroy', $blog)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
                <div x-show="showUpdateModal === {{$blog->id}}" x-cloak
                    class="fixed inset-0 flex items-center justify-center">
                    <div class=" bg-white p-6 rounded-lg w-96">
                        <h3 class="text-lg font-semibold"> Update Blog</h3>
                        <form action="{{route('blog.update', $blog)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="text" name="title" value="{{$blog->title}}"
                                class="rounded-lg w-full mb-2 border p-2" placeholder="Title">
                            <textarea name="content"
                                class="rounded-lg w-full mb-2 p-2 border">{{$blog->content}}</textarea>
                            <div class="flex justify-end">
                                <button type="button" @click="showUpdateModal = null"
                                    class=" bg-gray-400 px-4 rounded-lg">Cancel</button>
                                <button type="submit" class=" bg-blue-400 px-4 rounded-lg">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </tbody>
            @endforeach
        </table>

        <div x-show="showAddModal" x-cloak class="fixed inset-0 flex items-center justify-center">
            <div class=" bg-white p-6 rounded-lg w-96">
                <h3 class="text-lg font-semibold"> Add Blog</h3>
                <form action="{{route('blog.store')}}" method="POST">
                    @csrf
                    <input type="text" name="title" class="rounded-lg w-full mb-2 border p-2" placeholder="Title">
                    <textarea name="content" class="rounded-lg w-full mb-2 p-2 border"></textarea>
                    <div class="flex justify-end">
                        <button type="button" @click="showUpdateModal = null"
                            class=" bg-gray-400 px-4 rounded-lg">Cancel</button>
                        <button type="submit" class=" bg-blue-400 px-4 rounded-lg">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>