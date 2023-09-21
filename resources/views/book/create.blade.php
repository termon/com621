<x-layout>

    <div class="flex justify-between items-center border-b border-gray-700 pb-1 mb-3">
        <h1 class="text-3xl text-blue-900">Create Book</h1>       
    </div>
       
    <x-ui.card>
        {{-- <x-slot:title>Create Book</x-slot:title> --}}

        <form  method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data"  x-data="formData()">
            @csrf
        
            <div class="p-3  rounded-lg">           
                
                @include("book._inputs")

                <div class="p-3 border rounded shadow">
                    <template x-for="(field, index) in fields" :key="index" class="flex gap-1">  
                        <div class="flex gap-1">
                            <x-ui.form.select-group name x-bind:name="getFieldName(index)" x-model="fields[index]" :options="$authors" />                            
                            <x-ui.button type="button" x-on:click="removeField(index)">Remove Author</x-ui.button>
                        </div>
                    </template>
                    <x-ui.button type="button" x-on:click="addField()">Add Author</x-ui.button>
                </div>
                     
                <div class="flex items-center gap-2">
                    <x-ui.button mode="dark">Create</x-ui.button>             
                    <x-ui.link mode="light" href="{{ route('books.index') }}">Cancel</x-ui.link>
                </div>
                
            </div>
        </form>
    </x-ui.card>
</x-layout>


<script>
    function formData() {
      return {
        fields: [],
        
        addField() {
          this.fields.push('') 
        },
        
        removeField(index) {
          this.fields.splice(index, 1)
        },

        getFieldName(index) {
            return 'authors[' + index + ']0';
        }
      }
    }  
</script>


