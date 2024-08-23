@php
     use App\Models\ProductCategory;
@endphp
    <button id="sidebar-toggle">☰</button>
    <nav class="sidebar-outerdiv" id="sidebar">
        <div class="sidebar-innerdiv">
            <div class="sidebar-category">
                <li>Category's   ☰</li>
            </div>
            <ul>
                @php
                $obj =ProductCategory::all();
                @endphp
@foreach ($obj as $item)
    
<li><a href="/category/{{$item->category}}">{{$item->category}}</a></li>
@endforeach

            </ul>
        </div>
    </nav>
   