@props(['type' => 'default'])
@php 
  $default  = "py-1.5 px-4 text-sm transition-colors font-medium bg-blue-700  border active:bg-blue-800  border-blue-800  text-gray-100 rounded-lg hover:bg-blue-900  hover:text-white disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-blue-900";
  $danger   = "py-1.5 px-4 text-sm transition-colors font-medium bg-red-700   border active:bg-red-800   border-red-800   text-gray-100 rounded-lg hover:bg-red-800   hover:text-white disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-red-900";
  $dark     = "py-1.5 px-4 text-sm transition-colors font-medium bg-gray-900  border active:bg-gray-200  border-gray-200  text-gray-100 rounded-lg hover:bg-gray-700  hover:text-white disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-gray-900";
  $light    = "py-1.5 px-4 text-sm transition-colors font-medium bg-gray-50   border active:bg-gray-200  border-gray-200  text-gray-900 rounded-lg hover:bg-gray-100  hover:text-black disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-gray-200";
  $green    = "py-1.5 px-4 text-sm transition-colors font-medium bg-green-700 border active:bg-green-900 border-green-800 text-white    rounded-lg hover:bg-green-800 hover:text-white disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-green-900";
  $odefault = "py-1.5 px-4 text-sm transition-colors font-medium bg-gray-50   border                     border-gray-200  text-blue-600 rounded-lg hover:bg-blue-600  hover:text-white disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-blue-900 hover:border-blue-700";
  $odanger  = "py-1.5 px-4 text-sm transition-colors font-medium bg-gray-50   border                     border-gray-200  text-red-600  rounded-lg hover:bg-red-600   hover:text-white disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-red-900 hover:border-red-700";
  $link     = "py-1.5 px-4 text-sm transition-colors font-medium hover:text-bold hover:text-black hover:underline";

  $classes = $default;
  if ($type == 'danger') $classes = $danger;
  else if ($type == 'dark') $classes = $dark;
  else if ($type == 'light') $classes = $light;
  else if ($type == 'green') $classes = $green;
  else if ($type == 'odefault') $classes = $odefault;
  else if ($type == 'odanger') $classes = $odanger;
  else if ($type == 'link') $classes = $link;
@endphp

<button {{$attributes->merge(["class" => $classes, "type" => "submit" ]) }} >
   {{ $slot }}
</button>    
