@props(['type' => 'link'])
@php 
  $default  = "py-1.5 px-4 text-sm transition-colors font-medium text-gray-100 bg-blue-700  border active:bg-blue-800  border-blue-800   rounded-lg hover:bg-blue-900  hover:text-white disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-blue-900";
  $danger   = "py-1.5 px-4 text-sm transition-colors font-medium text-gray-100 bg-red-700   border active:bg-red-800   border-red-800    rounded-lg hover:bg-red-800   hover:text-white disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-red-900";
  $dark     = "py-1.5 px-4 text-sm transition-colors font-medium text-gray-100 bg-gray-900  border active:bg-gray-200  border-gray-200   rounded-lg hover:bg-gray-700  hover:text-white disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-gray-900";
  $light    = "py-1.5 px-4 text-sm transition-colors font-medium text-gray-900 bg-gray-50   border active:bg-gray-200  border-gray-200   rounded-lg hover:bg-gray-100  hover:text-black disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-gray-200";
  $green    = "py-1.5 px-4 text-sm transition-colors font-medium text-white    bg-green-700 border active:bg-green-900 border-green-800  rounded-lg hover:bg-green-800 hover:text-white disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-green-900";
  $odefault = "py-1.5 px-4 text-sm transition-colors font-medium text-blue-600 bg-gray-50   border                     border-gray-200   rounded-lg hover:bg-blue-600  hover:text-white disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-blue-900 hover:border-blue-700";
  $odanger  = "py-1.5 px-4 text-sm transition-colors font-medium text-red-600  bg-gray-50   border                     border-gray-200   rounded-lg hover:bg-red-600   hover:text-white disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-red-900 hover:border-red-700";
  $link     = "py-1.5 px-4 text-sm transition-colors font-medium text-gray-700 hover:text-bold hover:text-black hover:underline";

  $classes = $link;
  if ($type == 'default') $classes = $default;
  if ($type == 'danger') $classes = $danger;
  else if ($type == 'dark') $classes = $dark;
  else if ($type == 'light') $classes = $light;
  else if ($type == 'green') $classes = $green;
  else if ($type == 'link') $classes = $link;
  else if ($type == 'odefault') $classes = $odefault;
  else if ($type == 'odanger') $classes = $odanger;
@endphp

<a {{$attributes->merge(["class" => $classes ]) }} >
   {{ $slot }}
</a>    
