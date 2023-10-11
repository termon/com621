<table class="min-w-full text-left">
    <thead>
        <tr class="border-b border-gray-300 uppercase text-sm">          
            <th class="px-2 py-3">Name</th>
            <th class="px-2 py-3">Rate</th>
            <th class="px-2 py-3">Reviewed</th>
            <th class="px-2 py-3">Comment</th>
            <th class="px-2 py-3 text-right">Actions</th>
        </tr>
    </thead>

    <tbody class="divide-y">
        @foreach ($book->reviews as $review )
            <tr class="text-xs">
                <td class="px-2 py-3">{{$review->name}}</td>
                <td class="px-2 py-3">{{$review->rating}}</td>
                <td class="px-2 py-3">{{$review->reviewed_on_for_humans}}</td>
                <td class="px-2 py-3">{{$review->short_comment}}</td>
                <td class="px-2 py-3 text-right flex gap-2 justify-end">
                     <x-ui.link href="{{route('reviews.show',['review'=>$review])}}" class="flex gap-1">
                        <span>View</span>
                        <x-ui.svg.eye/> 
                    </x-ui.link>                  
                </td>
            </tr>
        @endforeach
    </tbody>
</table> 
       